<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use App\Models\RentLogs;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $bookCount = Book::count();
        $categoryCount = Category::count();
        $userCount = User::count();
        $rentlogs = RentLogs::with(['user', 'book'])->get();
        $books = Book::all();
        $categories = Category::all();
        $users = User::where('role_id', 2)->where('status', 'active')->get();
        return view('dashboard', ['book_count' => $bookCount, 'category_count' => $categoryCount, 'user_count' => $userCount, 'rent_logs' => $rentlogs, 'book' => $books, 'categories' => $categories, 'users' => $users]);
    }
}