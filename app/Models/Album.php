<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UploadImage;

class Album extends Model
{
    use HasFactory;
    use UploadImage;

    protected $casts = [
        'images' => 'array',
    ];
}
