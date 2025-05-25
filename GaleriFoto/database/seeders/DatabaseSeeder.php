<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Photo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    public function run()
    {
        $this->call([
            ManualPhotoSeeder::class,
        ]);
    }
}
