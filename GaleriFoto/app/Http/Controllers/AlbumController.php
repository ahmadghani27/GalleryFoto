<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folder;

class AlbumController extends Controller
{
    public function index()
    {
        $album = Folder::where('user_id', auth()->id())->get();
        return view('photo.album', compact('album'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        Folder::create([
            'user_id' => auth()->id(),
            'name_folder' => $request->title,
        ]);

        return redirect()->back()->with('success', 'Album berhasil dibuat!');
    }

    public function destroy($id)
    {
        $album = Folder::where('id_folder', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $album->delete();

        return redirect()->route('album')->with('success', 'Album berhasil dihapus!');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $album = Folder::where('id_folder', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $album->update([
            'name_folder' => $request->name
        ]);

        return back()->with('success', 'Nama album berhasil diubah');
    }
}
