<?php

namespace App\Http\Controllers;

use App\Models\Book;

class PerpustakaanController extends Controller
{
    public function index()
    {
        $books = Book::latest()->paginate(12);

        return view('perpustakaan', compact('books'));
    }

    public function show(Book $book)
    {
        return view('detail-buku', compact('book'));
    }
}