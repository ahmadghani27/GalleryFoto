<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use app\Http\Requests\ArchiveRequest;
use Illuminate\Support\Facades\Crypt;
use App\Models\Photo;
use Illuminate\Support\Carbon;

class ArchiveController extends Controller
{
    public function show()
    {
        return view('photo.arsip');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'password' => 'required|string'
        ]);

        $user = Auth::user();

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Kata sandi yang Anda masukkan salah'
            ], 401);
        }

        return response()->json([
            'success' => true
        ]);
    }
    public function content()
    {
        if (!session('archive_verified')) {
            return redirect()->route('arsip');
        }

        $userId = Auth::id();
        $sortOrder = request('sort', 'desc');

        $arsipFoto = Photo::where('user_id', $userId)
            ->where('is_archive', true)
            ->orderBy('created_at', $sortOrder)
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

        return view('photo.arsip-content', compact('arsipFoto'));
    }

    public function toggleArchive(Request $request)
    {
        $request->validate([
            'photo_id' => 'required',
            'is_archive' => 'required|boolean'
        ]);

        try {
            $photoId = Crypt::decryptString($request->photo_id);
            $photo = Photo::where('id_photo', $photoId)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            $photo->is_archive = $request->is_archive;
            $photo->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false], 400);
        }
    }
}
