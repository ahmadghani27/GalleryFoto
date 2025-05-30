<?php

// app/Models/Folder.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_folder';
    protected $fillable = ['user_id', 'name_folder', 'thumbnail_id'];
    protected $with = ['thumbnailPhoto']; // Always eager load thumbnail

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function photos()
    {
        return $this->hasMany(Photo::class, 'folder', 'id_folder');
    }

    public function thumbnailPhoto()
    {
        return $this->belongsTo(Photo::class, 'thumbnail_id')
            ->where('is_archive', 0)
            ->withDefault();
    }

    public function getThumbnailAttribute()
    {
        // First try the designated thumbnail, then fallback to latest photo
        if ($this->thumbnailPhoto && $this->thumbnailPhoto->exists) {
            return $this->thumbnailPhoto;
        }

        return $this->photos()
            ->where('is_archive', 0)
            ->orderBy('created_at', 'desc')
            ->first();
    }
}
