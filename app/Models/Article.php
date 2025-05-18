<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'content', 'category_id', 'user_id',
        'image', 'meta_title', 'meta_description',
        'status', 'views', 'published_at'
    ];

    protected $dates = ['published_at']; // Enables Carbon date handling

    // Auto-generate slug when saving an article
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($article) {
            $article->slug = Str::slug($article->title); // Generate slug
        });
    }

    // Article belongs to a category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Article belongs to a user (author)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Many-to-many relationship with tags
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function comments()
{
    return $this->hasMany(Comment::class)->where('is_approved', true)->latest();
}

public function scopeApproved($query)
{
    return $query->where('status', 'published');
}
public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
    
    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }

    public function getFormattedPublishedAtAttribute()
    {
        return $this->published_at ? Carbon::parse($this->published_at)->format('M d, Y') : 'Not Published';
    }

    public function incrementViews()
    {
        $this->increment('views');
    }
}

