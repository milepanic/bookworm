<?php

namespace App\Books;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface BooksRepository
{
    public function search(string $query = ''): LengthAwarePaginator;

    public function searchAjax(string $query = ''): array;
}
