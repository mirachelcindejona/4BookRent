<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        $categories = Category::all();
        
        return view('books', ['book' => $books, 'categories' => $categories]);
    }

    public function addBook(Request $request)
    {
        $validated = $request->validate([
            'book_code' => 'required|unique:books|max:255',
            'title' => 'required|max:255',
        ]);

        $newName = '';
        if ($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->title.'-'.now()->timestamp.'.'.$extension;
            $request->file('image')->storeAs('cover', $newName);
        }
        
        $request['cover'] = $newName;
        $book = Book::create($request->all());
        $book->categories()->sync($request->categories);
        
		return redirect('books')->with('status', 'Book Added Successfully');
 
    }
    
    public function editBook($slug, Request $request)
    {
        if ($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->title.'-'.now()->timestamp.'.'.$extension;
            $request->file('image')->storeAs('cover', $newName);
            $request['cover'] = $newName;
        }
        
        $book = Book::where('slug', $slug)->first();
        $book->slug = null;
        $book->update($request->all());

        if($request->categories) {
            $book->categories()->sync($request->categories);
        }

        return redirect('books')->with('status', 'Book Updated Successfully');
    }
    
    public function deleteBook($slug)
    {
        $book = Book::where('slug', $slug)->first();
        $book->delete();
		return redirect('books')->with('status', 'Book Deleted Successfully');
    }

    public function deletedListBook()
    {
        $deletedBooks = Book::onlyTrashed()->get();
        return view('deleted-list-book', ['deletedBooks' => $deletedBooks]);
    }

    public function restore($slug)
    {
        $book = Book::withTrashed()->where('slug', $slug)->first();
        $book->restore();
        return redirect('books')->with('status', 'Book restored successfully');
    }
}