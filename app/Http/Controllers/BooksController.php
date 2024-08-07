<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    //
    public function index()
    {
        $users = Books::all(); // Fetch all Books from the 'books' table
        return view('users.index', compact('users')); // Pass the Books to the view
    }
}
