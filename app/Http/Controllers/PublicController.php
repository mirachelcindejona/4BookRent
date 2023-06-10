<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $books = Book::all();
        return view('home', ['books' => $books, 'categories' => $categories]);
    }

    public function bookList(Request $request)
    {
        $categories = Category::all();

        if ($request->category || $request->title) {
            $books = Book::where('title', 'like', '%'.$request->title.'%')->get();
        }
        else {
            $books = Book::all();
        }
        return view('book-list', ['books' => $books, 'categories' => $categories]);
    }
}