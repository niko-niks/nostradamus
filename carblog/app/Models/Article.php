<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

/**
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string|null $excerpt
 * @property string $category
 * @property string|null $image
 * @property int $user_id
 * @property int $views
 * @property int $likes
 * @property bool $hot
 * @property bool $published
 */
class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'excerpt',
        'category',
        'image',
        'user_id',
        'views',
        'likes',
        'hot',
        'published',
    ];

    protected $casts = [
        'hot' => 'boolean',
        'published' => 'boolean',
    ];

    /**
     * Get the user that owns the article.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the categories that belong to this article.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Get the users who liked this article.
     */
    public function likedBy()
    {
        return $this->belongsToMany(User::class, 'article_likes');
    }

    /**
     * Check if a user has liked this article.
     */
    public function isLikedBy($user)
    {
        if (!$user) {
            return false;
        }
        
        return $this->likedBy()->where('user_id', $user->id)->exists();
    }

    /**
     * Safely get categories, ensuring they're loaded.
     */
    public function getCategoriesAttribute()
    {
        if (!$this->relationLoaded('categories')) {
            $this->load('categories');
        }
        return $this->getRelation('categories');
    }

    /**
     * Get the primary category (first one) for backward compatibility.
     */
    public function getPrimaryCategoryAttribute()
    {
        // Check if categories are loaded, if not, load them
        if (!$this->relationLoaded('categories')) {
            $this->load('categories');
        }
        return $this->categories->first();
    }

    /**
     * Get the primary category name for backward compatibility.
     */
    public function getCategoryAttribute()
    {
        $primaryCategory = $this->primary_category;
        return $primaryCategory ? $primaryCategory->name : 'Uncategorized';
    }

    /**
     * Get the primary category slug for backward compatibility.
     */
    public function getCategorySlugAttribute()
    {
        $primaryCategory = $this->primary_category;
        return $primaryCategory ? $primaryCategory->slug : 'uncategorized';
    }

    /**
     * Get the author name.
     */
    public function getAuthorAttribute()
    {
        return $this->user ? $this->user->name : 'Unknown Author';
    }

    /**
     * Get the formatted date.
     */
    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('M j, Y');
    }

    /**
     * Get the excerpt, generating one if not set.
     */
    public function getExcerptAttribute($value)
    {
        if ($value) {
            return $value;
        }

        // Generate excerpt from content
        $excerpt = Str::limit(strip_tags($this->content), 150);
        return $excerpt;
    }

    /**
     * Get a random car image URL.
     */
    public static function getRandomCarImage()
    {
        $carImages = [
            'https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?w=800&h=600&fit=crop',
            'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?w=800&h=600&fit=crop',
            'https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=800&h=600&fit=crop',
            'https://images.unsplash.com/photo-1494976388531-d1058494cdd8?w=800&h=600&fit=crop',
            'https://images.unsplash.com/photo-1502877338535-766e1452684a?w=800&h=600&fit=crop',
            'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&h=600&fit=crop',
            'https://images.unsplash.com/photo-1582639510494-c80b5de9f148?w=800&h=600&fit=crop',
            'https://images.unsplash.com/photo-1603584173870-7f23fdae1b7a?w=800&h=600&fit=crop',
            'https://images.unsplash.com/photo-1617814076367-b759c7d7e738?w=800&h=600&fit=crop',
        ];

        return $carImages[array_rand($carImages)];
    }

    /**
     * Get the image URL.
     */
    public function getImageUrlAttribute()
    {
        if ($this->image && Storage::disk('public')->exists($this->image)) {
            return Storage::disk('public')->url($this->image);
        }

        return $this->image ?: self::getRandomCarImage();
    }

    /**
     * Scope to get only published articles.
     */
    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    /**
     * Scope to get only hot articles.
     */
    public function scopeHot($query)
    {
        return $query->where('hot', true);
    }

    /**
     * Scope to get articles by category.
     */
    public function scopeByCategory($query, $categorySlug)
    {
        return $query->whereHas('categories', function ($q) use ($categorySlug) {
            $q->where('slug', $categorySlug);
        });
    }

    /**
     * Increment the view count.
     */
    public function incrementViews()
    {
        $this->increment('views');
    }

    /**
     * Toggle like for a user.
     */
    public function toggleLike($user)
    {
        if (!$user) {
            return false;
        }

        if ($this->isLikedBy($user)) {
            // Unlike
            $this->likedBy()->detach($user->id);
            $this->decrement('likes');
            return false;
        } else {
            // Like
            $this->likedBy()->attach($user->id);
            $this->increment('likes');
            return true;
        }
    }

    /**
     * Get the current like count.
     */
    public function getLikeCountAttribute()
    {
        return $this->likedBy()->count();
    }
}
