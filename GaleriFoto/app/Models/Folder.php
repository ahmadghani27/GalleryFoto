<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;

    protected $appends = ['thumbnail']; // Agar bisa diakses sebagai attribute
    protected $primaryKey = 'id_folder';
    protected $fillable = ['user_id', 'name_folder'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function getThumbnailAttribute()
    {
        return $this->photos()
            ->orderBy('created_at') // Urutkan dari yang paling lama (gambar pertama)
            ->first(); // Ambil gambar pertama
    }


    public function photos()
    {
        return $this->hasMany(Photo::class, 'folder', 'id_folder');
    }
}
