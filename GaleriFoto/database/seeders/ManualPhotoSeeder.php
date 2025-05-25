<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Photo;

class ManualPhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Buat user manual terlebih dahulu jika belum ada
        User::firstOrCreate([
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin123')
        ]);

        User::firstOrCreate([
            'username' => 'user1',
            'email' => 'user1@example.com',
            'password' => bcrypt('password123')
        ]);

        // Data foto manual
        $photos = [
            [
                'user_username' => 'admin',
                'archive_id' => null, // Gunakan null bukan 0
                'file_path' => 'pixelora/sample-photo.jpg',
                'file_name' => 'sample-photo.jpg',
                'mime_type' => 'image/jpeg',
                'file_size' => 1024,
                'caption' => 'Kisanak ini mengundang gelak tawa',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        foreach ($photos as $photoData) {
            Photo::firstOrCreate(
                ['file_path' => $photoData['file_path']], // Cek berdasarkan file_path
                $photoData
            );
        }
    }
}
