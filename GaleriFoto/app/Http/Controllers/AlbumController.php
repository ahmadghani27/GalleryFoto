<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use App\Models\Photo;

class AlbumController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $album = Folder::with(['photos' => function ($query) {
            $query->orderBy('created_at')->limit(1); // Ambil 1 foto pertama
        }])
            ->where('user_id', $userId)
            ->get();

        return view('photo.album', compact('album'));
    }
    public function show($id_album)
    {
        $userId = Auth::id();

        // 1. Verifikasi bahwa album/folder tersebut milik user yang login
        $album = Folder::where('id_folder', $id_album)
            ->where('user_id', $userId)
            ->firstOrFail();

        // 2. Ambil semua foto yang berada dalam folder/album tersebut
        $photos = Photo::where('folder', $id_album)
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        // 3. Kirim kedua data ke view
        return view('photo.photo-album', [
            'album' => $album,
            'photos' => $photos
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ], [
            'title.required' => 'Nama album wajib diisi.',
            'title.string'   => 'Nama album harus berupa teks.',
            'title.max'      => 'Nama album maksimal 255 karakter.',
        ]);

        Folder::create([
            'user_id'     => Auth::id(),
            'name_folder' => $request->title,
        ]);

        return Redirect::back()->with('status', 'Album berhasil dibuat!');
    }

    public function update(Request $request, $id_folder): RedirectResponse
    {
        $request->validate([
            'username' => 'required|string|max:255',
        ]);

        $album = Folder::where('id_folder', $id_folder)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $album->name_folder = $request->username;
        $album->save();

        return redirect()->route('album')->with('status', 'Album berhasil diperbarui!');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $decryptedId = Crypt::decryptString($request->id_album);

        $album = Folder::where('id_folder', $decryptedId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $album->delete();

        return redirect()->route('album')->with('status', 'Album berhasil dihapus!');
    }
}
