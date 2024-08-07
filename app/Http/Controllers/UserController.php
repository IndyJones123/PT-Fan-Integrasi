<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::all(); // Fetch all users from the 'users' table
        return view('users.index', compact('users')); // Pass the users to the view
    }
}
