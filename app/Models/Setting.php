<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['meta_title', 'meta_description', 'meta_keywords', 'og_image', 'canonical_url'];
}
