<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();
        $sort = $request->query('sort', 'desc');

        $albums = Folder::with(['thumbnail' => function ($query) {
            $query->select('id_photo', 'file_path', 'folder');
        }])
            ->where('user_id', $userId)
            ->orderBy('created_at', $sort)
            ->get();

        return view('photo.album', compact('albums'));
    }

    public function show($id_album)
    {
        $userId = Auth::id();
        $sort = request()->query('sort', 'desc');

        $folder = Folder::withCount('photos')
            ->where('id_folder', $id_album)
            ->where('user_id', $userId)
            ->firstOrFail();

        $photos = Photo::where('folder', $id_album)
            ->where('user_id', $userId)
            ->orderBy('created_at', $sort)
            ->get();

        return view('photo.photo-album', [
            'folder' => $folder,
            'photos' => $photos,
            'currentSort' => $sort
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ], [
            'title.required' => 'Nama album wajib diisi.',
            'thumbnail.image' => 'File harus berupa gambar.',
            'thumbnail.mimes' => 'Format gambar harus jpeg, png, atau jpg.',
            'thumbnail.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        $album = Folder::create([
            'user_id'     => Auth::id(),
            'name_folder' => $request->title,
        ]);

        // Proses thumbnail jika ada
        if ($request->hasFile('thumbnail')) {
            $this->processThumbnail($request->file('thumbnail'), $album->id_folder);
        }

        return Redirect::back()->with('status', 'Album berhasil dibuat!');
    }

    public function update(Request $request, $id_folder): RedirectResponse
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $album = Folder::where('id_folder', $id_folder)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $album->name_folder = $request->username;
        $album->save();

        // Update thumbnail jika ada
        if ($request->hasFile('thumbnail')) {
            $this->processThumbnail($request->file('thumbnail'), $id_folder);
        }

        return redirect()->route('album')->with('status', 'Album berhasil diperbarui!');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $decryptedId = Crypt::decryptString($request->id_album);

        $album = Folder::where('id_folder', $decryptedId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        Photo::where('folder', $decryptedId)
            ->where('user_id', Auth::id())
            ->update(['folder' => null]);

        $album->delete();

        return redirect()->route('album')->with('status', 'Album berhasil dihapus!');
    }

    public function getActiveAlbum($id)
    {
        $items = Folder::where('id_folder', '!=', $id)->get();
        return response()->json($items);
    }

    public function getAllActiveAlbum()
    {
        $items = Folder::all();
        return response()->json($items);
    }

    /**
     * Process and optimize album thumbnail
     */
    protected function processThumbnail($imageFile, $folderId)
    {
        $folderPath = "thumbnails/albums/{$folderId}";
        $fileName = 'thumbnail-' . uniqid() . '.jpg';

        // Create optimized thumbnail
        $image = Image::make($imageFile)
            ->fit(800, 600)
            ->encode('jpg', 70);

        Storage::put("{$folderPath}/{$fileName}", $image);

        // Update or create thumbnail photo record
        Photo::updateOrCreate(
            ['folder' => $folderId, 'is_thumbnail' => true],
            [
                'user_id' => Auth::id(),
                'file_path' => "{$folderPath}/{$fileName}",
                'photo_title' => 'Album Thumbnail',
                'is_thumbnail' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        );
    }
}
