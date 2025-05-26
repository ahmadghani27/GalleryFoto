<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_folder';
    protected $fillable = ['user_id', 'name_folder'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
