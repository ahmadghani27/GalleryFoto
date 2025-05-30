<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class FavoriteController extends Controller
{
    public function index() {
        $userId = Auth::id(); // ambil id user yang sedang login
        $sortOrder = request('sort', 'desc');
        $search = request('search');

        $query = Photo::where('user_id', $userId)
            ->where('is_archive', false)
            ->where('is_favorite', true);

        if(!empty($search)) {
            $query->where('photo_title', 'like', '%' . $search . '%');
        }

        $foto = $query->orderBy('created_at', $sortOrder)->get();

        return view('photo.favorit', compact('foto', 'search'));
    }

    public function unFavorite(Request $request) 
    {
        $photo = Photo::findOrFail($request->id_foto);
        $photo->is_favorite = false;
        $photo->save();

        return Redirect::back()->with('status',  'Foto berhasil di-unfavorit');
    }
}
