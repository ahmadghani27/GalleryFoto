<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use App\Models\Photo;

class AlbumController extends Controller
{

    // app/Http/Controllers/AlbumController.php
    public function index(Request $request)
    {
        $userId = Auth::id();
        $sort = $request->query('sort', 'desc');
        $search = $request->query('search');

        $query = Folder::with(['thumbnailPhoto', 'photos' => function ($query) {
            $query->where('is_archive', 0)->orderBy('created_at', 'desc')->limit(1);
        }])
            ->where('user_id', $userId);

        if ($search) {
            $query->where('name_folder', 'like', '%' . $search . '%');
        }

        $albums = $query->orderBy('created_at', $sort)->get();

        return view('photo.album', [
            'album' => $albums,
            'search' => $search
        ]);
    }
    public function show($id_folder)
    {
        $userId = Auth::id();
        $sort = request()->query('sort', 'desc'); // default: terbaru

        // Fetch the folder with photo count
        $folder = Folder::withCount(['photos' => function ($query) {
            $query->where('is_archive', 0);
        }])
            ->where('id_folder', $id_folder)
            ->where('user_id', $userId)
            ->firstOrFail();

        // Fetch photos for the current album
        $photos = Photo::where('folder', $id_folder)
            ->where('user_id', $userId)
            ->where('is_archive', 0)
            ->orderBy('created_at', $sort)
            ->get();

        // Fetch all non-archived photos for the user, excluding those in the current album
        $allPhotos = Photo::where('user_id', $userId)
            ->where('is_archive', 0)
            ->where(function ($query) use ($id_folder) {
                $query->where('folder', '!=', $id_folder)
                    ->orWhereNull('folder');
            })
            ->orderBy('created_at', $sort)
            ->get();

        return view('photo.photo-album', [
            'folder' => $folder,
            'photos' => $photos,
            'allPhotos' => $allPhotos,
            'currentSort' => $sort
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

    public function addPhotos(Request $request, $id_folder)
    {
        $request->validate([
            'selected_photos' => 'required|string'
        ]);

        $photoIds = explode(',', $request->selected_photos);

        Photo::whereIn('id_photo', $photoIds)
            ->where('user_id', Auth::id())
            ->update(['folder' => $id_folder]);

        return redirect()->route('album.show', $id_folder)
            ->with('status', 'Foto berhasil ditambahkan ke album');
    }
}
