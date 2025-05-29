<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
}
