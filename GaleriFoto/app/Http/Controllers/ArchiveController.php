<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class ArchiveController extends Controller
{
    public function show()
    {
        return view('photo.arsip');
    }

    public function verify(Request $request): JsonResponse
    {
        $request->validate([
            'password' => 'required|string'
        ]);

        if (!Hash::check($request->password, Auth::user()->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Kata sandi yang Anda masukkan salah'
            ], 401);
        }

        session(['archive_verified' => true]);

        return response()->json([
            'success' => true,
            'redirect' => route('arsip.content')
        ]);
    }

    public function content(): RedirectResponse|\Illuminate\View\View
    {
        if (!session('archive_verified')) {
            return redirect()->route('arsip')->withErrors('Silakan verifikasi password terlebih dahulu');
        }

        $userId = Auth::id();
        $sortOrder = request('sort', 'desc');
        $search = request('search');

        $query = Photo::with(['folder'])
            ->where('user_id', $userId)
            ->where('is_archive', true);

        if (!empty($search)) {
            $query->where('photo_title', 'like', '%' . $search . '%');
        }

        $arsipFoto = $query->orderBy('created_at', $sortOrder)
            ->get()
            ->groupBy(function ($photo) {
                $date = Carbon::parse($photo->created_at);

                if ($date->isToday()) return 'Hari ini';
                if ($date->isYesterday()) return 'Kemarin';
                return $date->translatedFormat('d M Y');
            });

        return view('photo.arsip-content', [
            'arsipFoto' => $arsipFoto,
            'search' => $search,
            'currentSort' => $sortOrder
        ]);
    }
}
