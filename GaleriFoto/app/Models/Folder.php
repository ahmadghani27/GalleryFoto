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
    // Folder.php
    public function photos()
    {
        return $this->hasMany(Photo::class, 'folder', 'id_folder');
    }
    public function photosCount()
    {
        return $this->photos()->count();
    }
    public function thumbnail()
    {
        return $this->hasOne(Photo::class, 'folder', 'id_folder')
            ->whereNotNull('folder_updated_at')
            ->latest('folder_updated_at');
    }
}
