<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'summary',
        'content',
        'status',
        'published_at',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    // Local Scope for Search & Filtering
    public function scopeFilter(Builder $query, array $filters): Builder
    {
        return $query
            // Search title or content
            ->when($filters['search'] ?? null, function ($q, $search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('title', 'ilike', '%' . $search . '%')
                        ->orWhere('content', 'ilike', '%' . $search . '%');
                });
            })
            // Filter by category slug
            ->when($filters['category'] ?? null, function ($q, $categorySlug) {
                $q->whereHas('category', function ($catQuery) use ($categorySlug) {
                    $catQuery->where('slug', $categorySlug);
                });
            })
            // Filter by tag slug
            ->when($filters['tag'] ?? null, function ($q, $tagSlug) {
                $q->whereHas('tags', function ($tagQuery) use ($tagSlug) {
                    $tagQuery->where('slug', $tagSlug);
                });
            });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}