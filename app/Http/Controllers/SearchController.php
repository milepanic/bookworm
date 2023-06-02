<?php

namespace App\Http\Controllers;

use App\Books\BooksRepository;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request, BooksRepository $repository)
    {
        if ($request->ajax()) {
            return response()->json($repository->searchAjax((string) $request->input('term')));
        }

        return view('all-books', [
            'books' => $repository->search((string) $request->input('term')),
        ]);
    }
}
