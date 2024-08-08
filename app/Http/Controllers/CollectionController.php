<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Like;
use App\Models\Dislike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class CollectionController extends Controller
{
     public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Books::query()->with('author')->with('like')->with('dislike'); // Use query builder

        //Filter Nama Author & Tittle
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($query) use ($searchTerm) {
                $query->where('title', 'like', '%' . strtolower($searchTerm) . '%')
                    ->orWhereHas('author', function ($q) use ($searchTerm) {
                        $q->where('name', 'like', '%' . strtolower($searchTerm) . '%');
            });
        });
        }

        // Rating filter
        if ($request->filled('rating')) {
            $query->where('rating', $request->input('rating'));
        }

        // Date uploaded filter
        if ($request->filled('date_uploaded')) {
            $query->whereDate('created_at', $request->input('date_uploaded'));
        }

        $books = $query->paginate(10); // Paginate on the query builder

        return view('collection.index', [
            'books' => $books,
            'search' => $search,
        ]);
    }

    public function like($id)
    {
    $user = auth()->user();
    $book = Books::findOrFail($id);

    // Check if the user has already liked the book
    $existingLike = Like::where('user_id', $user->id)
                        ->where('book_id', $id)
                        ->first();
         if ($existingLike) {
    // If already liked, remove the like
    $existingLike->delete();
    } else {
        // Otherwise, add the like
        Like::create([
            'user_id' => $user->id,
            'book_id' => $id,
        ]);
    }

    return redirect()->back();
    }

    public function dislike($bookId)
    {
        $user = auth()->user();
        $book = Books::findOrFail($bookId);

        // Check if the user has already disliked the book
        $existingDislike = Dislike::where('user_id', $user->id)
                                ->where('book_id', $bookId)
                                ->first();

        if ($existingDislike) {
            // If already disliked, remove the dislike
            $existingDislike->delete();
        } else {
            // Otherwise, add the dislike
            Dislike::create([
                'user_id' => $user->id,
                'book_id' => $bookId,
            ]);
        }

        return redirect()->back();
    }
}

