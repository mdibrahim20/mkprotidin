<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class VideoGallery extends Model
{
    use hasFactory;
    protected $fillable = ['title1', 'video1'];
}
