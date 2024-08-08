<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class BooksController extends Controller
{
    //
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Books::query()->where('author_id', Auth::id()); // Use query builder

        if ($search) {
            $search = strtolower($search); // Convert search term to lowercase

            $query->where(function ($q) use ($search) {
                $q->
                    orWhereRaw('LOWER(title) LIKE ?', ["%{$search}%"]);
            });
        }

        $books = $query->paginate(6); // Paginate on the query builder

        return view('books.index', [
            'books' => $books,
            'search' => $search,
        ]);
    }

        /**
     * Show the form for creating a new book.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created book in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
     public function store(Request $request)
    {
        $currentDate = Carbon::now();

        $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|integer|max:10',
            'description' => 'required|string|max:255',
            'rating' => 'required|integer',
            'thumbnail' => ['required', 'file', 'mimes:jpg,png,jpeg', 'max:2048'],
        ]);

        $thumbnailName = Str::random(10) . '.' . $request->file('thumbnail')->getClientOriginalExtension();
        $path = $request->file('thumbnail')->move('data', $thumbnailName, 'public');
        $thumbnail = $path;

        $book = Books::create([
            'title' => $request->title,
            'author_id' => $request->author_id,
            'description' => $request->description,
            'rating' => $request->rating,
            'thumbnail' => $thumbnail,
            'updated_at' => $currentDate,
            'created_at' => $currentDate
        ]);

        return redirect()->route('books.index')
            ->with('success', 'Book created successfully.');
    }

    /**
     * Display the specified book.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\View\View
     */
    public function show(Books $book)
    {
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified book.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\View\View
     */
    public function edit(Books $book)
    {
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified book in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\RedirectResponse
     */
   public function update(Request $request, Books $book)
    {
        $currentDate = Carbon::now();

        $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|integer|max:10',
            'description' => 'required|string|max:255',
            'rating' => 'required|integer',
            'thumbnail' => ['nullable', 'file', 'mimes:jpg,png,jpeg', 'max:2048'],
        ]);

        // Handle the new thumbnail upload
        if ($request->hasFile('thumbnail')) {
            // Delete the old thumbnail if it exists
            $oldThumbnailPath = public_path($book->thumbnail);
            if (File::exists($oldThumbnailPath)) {
                File::delete($oldThumbnailPath);
            }

            // Store the new thumbnail
            $thumbnailName = Str::random(10) . '.' . $request->file('thumbnail')->getClientOriginalExtension();
            $request->file('thumbnail')->move(public_path('data'), $thumbnailName);
            $thumbnail = 'data/' . $thumbnailName; // Ensure the path is correctly stored
        } else {
            // Use the old thumbnail if no new thumbnail is provided
            $thumbnail = $book->thumbnail;
        }

        // Update the book with new data
        $book->update([
            'title' => $request->title,
            'author_id' => $request->author_id,
            'description' => $request->description,
            'rating' => $request->rating,
            'thumbnail' => $thumbnail,
            'updated_at' => $currentDate,
        ]);

        return redirect()->route('books.index')
            ->with('success', 'Book updated successfully.');
    }


    /**
     * Remove the specified book from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Books $book)
    {
        // Delete the image file from public/data directory
        $imagePath = public_path($book->thumbnail);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Book deleted successfully.');
    }
}
