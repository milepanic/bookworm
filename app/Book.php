<?php

namespace App;

use App\Search\Searchable;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use Searchable;

    public function searchableFields()
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'author' => optional($this->author)->name ?? null,
            'published_at' => $this->published_at,
            'price' => $this->price,
        ];
    }

    const PAGINATION_PER_PAGE = 10;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'google_id',
        'title',
        'description',
        'published_at',
        'price',
        'preview_link',
        'author_id',
        'page_count',
        'thumbnail',
        'language',
        'pdf',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'price' => 'decimal:2',
        'author_id' => 'integer',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'published_at',
    ];



    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
