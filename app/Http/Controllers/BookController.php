<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = $request->input('title');
        $filter = $request->input('filter', '');
        $perPage = $request->input('per_page', 5);

        $books = Book::when(
            $title,
            fn($query, $title) => $query->title($title)
        );

        $books = match ($filter) {
            'popular_last_month' => $books->popularLastMonth(),
            'popular_last_6months' => $books->popularLast6Months(),
            'highest_rated_last_month' => $books->highestRatedLastMonth(),
            'highest_rated_last_6months' => $books->highestRatedLast6Months(),
            default => $books->latest()->withAvgRating()->withReviewsCount()
        };

        $cacheKey = 'books:' . $filter . ':' . $title;
        $cacheKey = "books:{$filter}:{$title}:page:{$request->page}:perPage:{$perPage}"; 
        $books =
            cache()->remember(
                $cacheKey,
                3600,
                fn() =>
                $books->simplePaginate($perPage)
                // $books->get()
            );

        return view('books.index', ['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $cacheKey = 'book:' . $id;

        $book = cache()->remember(
            $cacheKey,
            3600,
            fn() =>
            Book::with([
                'reviews' => fn($query) => $query->latest()
            ])->withAvgRating()->withReviewsCount()->findOrFail($id)
        );

        return view('books.show', ['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }
}
