<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Database\Eloquent;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $emailVerified = $request->input('email_verified');

        $query = User::query(); // Use query builder

        if ($search) {
            $search = strtolower($search); // Convert search term to lowercase

            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"])
                    ->orWhereRaw('LOWER(email) LIKE ?', ["%{$search}%"]);
            });
        }

        if ($emailVerified === 'unverified') {
            $query->whereNull('email_verified_at');
        } elseif ($emailVerified === 'verified') {
            $query->whereNotNull('email_verified_at');
        }

        $users = $query->paginate(6); // Paginate on the query builder

        return view('users.index', [
            'users' => $users,
            'search' => $search,
        ]);
    }

}
