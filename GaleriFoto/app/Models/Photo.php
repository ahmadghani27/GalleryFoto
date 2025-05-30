<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Photo extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_photo';

    protected $fillable = [
        'user_id',
        'folder',
        'is_archive',
        'is_favorite',
        'file_path',
        'photo_title',
        'created_at',
        'updated_at',
        'thumbnail_updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function folder()
    {
        return $this->belongsTo(Folder::class, 'folder', 'id_folder');
    }
}
