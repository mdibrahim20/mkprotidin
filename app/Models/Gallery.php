<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Gallery extends Model
{
    use hasFactory;
    protected $fillable = ['title1', 'title2', 'title3', 'image1', 'image2', 'image3'];
}
