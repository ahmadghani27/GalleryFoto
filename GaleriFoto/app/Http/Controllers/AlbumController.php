<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;

class AlbumController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $album = Folder::where('user_id', $userId)->get();

        return view('photo.album', compact('album'));
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

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'Nama baru album wajib diisi.',
            'name.string'   => 'Nama harus berupa teks.',
            'name.max'      => 'Nama album maksimal 255 karakter.',
        ]);

        $decryptedId = Crypt::decryptString($id);

        $album = Folder::where('id_folder', $decryptedId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $album->update([
            'name_folder' => $request->name,
        ]);

        return Redirect::back()->with('status', 'Nama album berhasil diubah!');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $decryptedId = Crypt::decryptString($request->id_album);

        $album = Folder::where('id_folder', $decryptedId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $album->delete();

        return Redirect::route('album')->with('status', 'Album berhasil dihapus!');
    }
}
