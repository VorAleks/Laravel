<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Source extends Model
{
    use HasFactory;

    protected $table = 'sources';

    protected $fillable = [
        'title',
        'url'
    ];

    /* Relations */
    public function news(): BelongsToMany
    {
        return $this->belongsToMany(News::class, 'news_sources',
            'sources_id', 'news_id');
    }
}
