<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PhotoController extends Controller
{
    public function index()
    {
        $userId = Auth::id(); // ambil id user yang sedang login
        $sortOrder = request('sort', 'desc');
        $search = request('search');

        $query = Photo::where('user_id', $userId)
            ->where('is_archive', false);

        if(!empty($search)) {
            $query->where('photo_title', 'like', '%' . $search . '%');
        }

        $foto = $query->orderBy('created_at', $sortOrder)
            ->get()
            ->groupBy(function ($item) {
                $tanggal = Carbon::parse($item->created_at);

                if ($tanggal->isToday()) {
                    return 'Hari ini';
                } elseif ($tanggal->isYesterday()) {
                    return 'Kemarin';
                } else {
                    return $tanggal->translatedFormat('d M Y');
                }
            });
        return view('photo.index', compact('foto', 'search'));
    }

    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'photo' => 'required|file|mimes:jpg,jpeg,png|max:5048',
        ], [
            // Pesan error untuk title
            'title.required' => 'Judul foto wajib diisi.',
            'title.string'   => 'Judul foto harus berupa teks.',
            'title.max'      => 'Judul foto tidak boleh lebih dari 255 karakter.',

            // Pesan error untuk photo
            'photo.required' => 'File foto wajib diunggah.',
            'photo.file'     => 'File yang diunggah harus berupa file.',
            'photo.mimes'    => 'Format file yang diperbolehkan adalah JPG, JPEG, atau PNG.',
            'photo.max'      => 'Ukuran file maksimal adalah 5MB (5048 KB).',
        ]);


        $folder = now()->format('Y/m');
        $fileName = 'foto-' . uniqid() . '.' . $request->photo->extension();
        $path = "photos/{$folder}/{$fileName}";

        // Resize and compress image
        $image = Image::make($request->file('photo'))->encode('jpg', 80);
        Storage::disk('local')->put("{$path}", $image);
        

        Photo::create([
            'user_id'      => $request->user()->id,
            'folder'       => null,
            'is_archive'   => false,
            'is_favorite'  => false,
            'file_path'    => $path,
            'photo_title'  => $request->title,
            'created_at'   => now(),
            'update_at'    => now(),
        ]);


        return Redirect::route('foto')->with('status', 'Foto berhasil diupload');
    }

    public function massStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'photo.*' => 'required|image|mimes:jpg,jpeg,png|max:5048',
            'title.*' => 'required|string|max:255',
        ], [
            // Pesan error untuk title
            'title.*.required' => 'Judul foto wajib diisi.',
            'title.*.string'   => 'Judul foto harus berupa teks.',
            'title.*.max'      => 'Judul foto tidak boleh lebih dari 255 karakter.',

            // Pesan error untuk photo
            'photo.*.required' => 'File foto wajib diunggah.',
            'photo.*.file'     => 'File yang diunggah harus berupa file.',
            'photo.*.mimes'    => 'Format file yang diperbolehkan adalah JPG, JPEG, atau PNG.',
            'photo.*.max'      => 'Ukuran file maksimal adalah 5MB (5048 KB).',
        ]);

        if ($validator->fails()) {
            throw new HttpResponseException(response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422));
        }

        $uploadedFiles = [];
        $folder = now()->format('Y/m');
        
        foreach ($request->file('photo') as $index => $photo) {
            $judul = $request->input('title')[$index];
            $fileName = 'foto-'.uniqid().'.'.$photo->extension();
            $path = "photos/{$folder}/{$fileName}";

            // Resize and compress image
            $image = Image::make($photo)->encode('jpg', 60);
            Storage::disk('local')->put("{$path}", $image);

            Photo::create([
                'user_id'      => $request->user()->id,
                'folder'       => null,
                'is_archive'   => false,
                'is_favorite'  => false,
                'file_path'    => $path,
                'photo_title'  => $judul,
                'created_at'   => now(),
                'update_at'    => now(),
            ]);
            
            $uploadedFiles[] = [
                'title' => $judul,
                'filename' => $fileName,
            ];
        }

        session()->flash('status', 'Semua foto berhasil diupload');

        return response()->json([
            'message' => 'Semua foto berhasil diupload',
            'files' => $uploadedFiles,
            'redirect' => route('foto')
        ]);
    }

    public function destroy(Request $request)
    {
        $decryptedId = Crypt::decryptString($request->id_foto);

        $foto = Photo::findOrFail($decryptedId);
        $foto->delete();

        return redirect()->route('foto')->with('status', 'Foto berhasil dihapus.');
    }

    public function editJudul(Request $request)
    {
        $decryptedId = Crypt::decryptString($request->id_foto);

        $foto = Photo::findOrFail($decryptedId);

        $foto->update([
            'photo_title' => $request->new_judul,
        ]);

        return Redirect::route('foto')->with('status', 'Judul berhasil diperbarui');
    }

    public function arsipkan(Request $request)
    {
        $request->validate([
            'id_foto' => 'required|string'
        ]);

        try {
            $decryptedId = Crypt::decryptString($request->id_foto);

            $foto = Photo::where('id_photo', $decryptedId);

            $foto->update(['is_archive' => true]);

            return Redirect::route('foto')->with([
                'status' => 'success',
                'message' => 'Foto berhasil diarsipkan'
            ]);
        } catch (\Exception $e) {
            return Redirect::back()->with([
                'status' => 'error',
                'message' => 'Gagal mengarsipkan foto: ' . $e->getMessage()
            ]);
        }
    }



    public function toggleFavorite(Request $request)
    {
        $photo = Photo::findOrFail($request->id_foto);
        $photo->is_favorite = !$photo->is_favorite;
        $photo->save();

        return response()->json(['success' => true, 'is_favorite' => $photo->is_favorite]);
    }

    public function unarsipkan(Request $request)
    {
        $request->validate([
            'id_foto' => 'required|string'
        ]);

        try {
            $decryptedId = Crypt::decryptString($request->id_foto);

            $foto = Photo::where('id_photo', $decryptedId);

            $foto->update(['is_archive' => false]);

            return Redirect::route('arsip.content')->with([
                'status' => 'success',
                'message' => 'Foto berhasil dikeluarkan dari arsip'
            ]);
        } catch (\Exception $e) {
            return Redirect::back()->with([
                'status' => 'error',
                'message' => 'Gagal mengeluarkan dari arsip: ' . $e->getMessage()
            ]);
        }
    }

    public function pindahAlbum(Request $request)
    {
        $foto = Photo::findOrFail($request->id_foto);
        $album = Folder::findOrFail($request->folder_id);

        $foto->update([
            'folder' => $request->folder_id
        ]);

        return Redirect::route('foto')->with('status', 'Foto berhasil dipindah ke album ' . $album->name_folder);
    }

    public function access($path)
    {
        if (!Storage::disk('local')->exists($path)) {
            abort(404, 'File not found: ' . $path);
        }

        $fullPath = Storage::disk('local')->path($path);
        $mime = mime_content_type($fullPath);
        $file = file_get_contents($fullPath);

        return response($file, 200)->header('Content-Type', $mime);
    }
}
