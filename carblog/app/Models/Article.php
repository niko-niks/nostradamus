<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string|null $image
 * @property int $user_id
 */
class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'image',
        'user_id',
    ];

    /**
     * Get the user that owns the article.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
