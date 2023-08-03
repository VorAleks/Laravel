<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\NewsStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $fillable = [
        'title',
        'author',
        'status',
        'description',
        'pubDate'
    ];

    /* Relations */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_has_news',
            'news_id', 'category_id');
    }

    public function sources(): BelongsToMany
    {
        return $this->belongsToMany(Source::class, 'news_sources',
            'news_id', 'source_id');
    }



    /* Scopes's */
    public function scopeActive(Builder $query): void
    {
        $query->where('status', NewsStatus::ACTIVE->value);
    }

    public function scopeDraft(Builder $query): void
    {
        $query->where('status', NewsStatus::DRAFT->value);
    }

    public function scopeBlocked(Builder $query): void
    {
        $query->where('status', NewsStatus::BLOCKED->value);
    }
}
