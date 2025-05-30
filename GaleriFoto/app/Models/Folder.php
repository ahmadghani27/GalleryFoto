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
    public function getThumbnailAttribute()
    {
        return $this->photos->first(); // Karena sudah pakai limit(1) di eager load
    }
    public function thumbnail()
    {
        return $this->hasOne(Photo::class, 'folder', 'id_folder')
            ->where('is_thumbnail', true);
    }
}
