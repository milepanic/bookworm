<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function landing()
    {
        return view('landing', [
            'books' => Book::with('author')->inRandomOrder()->take(10)->get(),
        ]);
    }

    public function singleBook(Book $book)
    {
        return view('single-book', [
            'book' => $book
        ]);
    }

    public function allBooks()
    {
        return view('all-books', [
            'books' => Book::inRandomOrder()->take(10)->get(),
        ]);
    }
}
