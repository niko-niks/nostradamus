<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
    ];

    /**
     * Get the articles that belong to this category.
     */
    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }

    /**
     * Get the articles count for this category.
     */
    public function getArticlesCountAttribute()
    {
        return $this->articles()->count();
    }

    /**
     * Get available car-related categories.
     */
    public static function getCarCategories()
    {
        return [
            'supercars' => [
                'name' => 'Supercars',
                'description' => 'High-performance exotic sports cars',
                'icon' => 'zap'
            ],
            'muscle-cars' => [
                'name' => 'Muscle Cars',
                'description' => 'American V8 power and classic style',
                'icon' => 'flame'
            ],
            'sports-cars' => [
                'name' => 'Sports Cars',
                'description' => 'Performance-focused driving machines',
                'icon' => 'trophy'
            ],
            'luxury-cars' => [
                'name' => 'Luxury Cars',
                'description' => 'Premium comfort and sophisticated technology',
                'icon' => 'crown'
            ],
            'electric-cars' => [
                'name' => 'Electric Cars',
                'description' => 'Zero-emission vehicles and EV technology',
                'icon' => 'battery'
            ],
            'classic-cars' => [
                'name' => 'Classic Cars',
                'description' => 'Vintage automobiles and restoration',
                'icon' => 'clock'
            ],
            'tuning' => [
                'name' => 'Tuning & Modifications',
                'description' => 'Performance upgrades and custom builds',
                'icon' => 'wrench'
            ],
            'racing' => [
                'name' => 'Racing',
                'description' => 'Track events, motorsports, and competition',
                'icon' => 'flag'
            ],
            'reviews' => [
                'name' => 'Car Reviews',
                'description' => 'Detailed vehicle evaluations and tests',
                'icon' => 'star'
            ],
            'maintenance' => [
                'name' => 'Maintenance & Care',
                'description' => 'Servicing, repairs, and car care tips',
                'icon' => 'tool'
            ],
            'news' => [
                'name' => 'Car News',
                'description' => 'Latest automotive industry updates',
                'icon' => 'newspaper'
            ],
            'guides' => [
                'name' => 'Buying Guides',
                'description' => 'Car shopping advice and comparisons',
                'icon' => 'book-open'
            ],
        ];
    }

    /**
     * Get the icon for the category.
     */
    public function getIconAttribute($value)
    {
        return $value ?: 'car';
    }

    /**
     * Boot method to automatically generate slug.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }
}
