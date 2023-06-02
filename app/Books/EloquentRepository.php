<?php

namespace App\Books;

use App\Book;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EloquentRepository implements BooksRepository
{
    public function search(string $query = ''): LengthAwarePaginator
    {
        return Book::query()
            ->where('description', 'like', "%{$query}%")
            ->orWhere('title', 'like', "%{$query}%")
            ->paginate(Book::PAGINATION_PER_PAGE);
    }

    public function searchAjax(string $query = ''): array
    {
        return Book::query()
            ->where('description', 'like', "%{$query}%")
            ->orWhere('title', 'like', "%{$query}%")
            ->take(10)
            ->get()
            ->toArray();
    }
}
