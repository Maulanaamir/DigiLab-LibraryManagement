<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $book = Book::with('category')->latest()->paginate(10);
        return view('books.index', compact('book'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title'          => 'required|string|max:255',
            'author'         => 'required|string|max:100',
            'published_year' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'stock'          => 'required|integer|min:0',
            'category_id'    => 'required|exists:categories,id',
        ]);

        Book::create($validatedData);

        return redirect()->route('books.index')->with('success', 'Buku baru berhasil ditambahkan!');
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }


    public function update(Request $request, Book $book)
    {
        $validatedData = $request->validate([
            'title'          => 'required|string|max:255',
            'author'         => 'required|string|max:100',
            'published_year' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'stock'          => 'required|integer|min:0',
            'category_id'    => 'required|exists:categories,id',
        ]);

        $book->update($validatedData);

        return redirect()->route('books.index')->with('success', 'Data buku berhasil diperbarui!');
    }


    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus!');
    }
}