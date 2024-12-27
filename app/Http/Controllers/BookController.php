<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Resources\BookResource;
use App\Http\Requests\StoreBookRequest;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'id');
        $order = $request->input('order', 'asc');
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');

        $query = Book::query();
        $query->with(['subject', 'collection', 'author', 'publisher']);

        if ($search) {
            $query->where('title', 'like', '%' . $search . '%');

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%');
                $q->orWhereHas('subject', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                });
                $q->orWhereHas('collection', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                });
                $q->orWhereHas('author', function ($q) use ($search) {
                    $q->where('full_name', 'like', '%' . $search . '%');
                });
                $q->orWhereHas('publisher', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                });
                $q->orWhereHas('bookType', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                });
            });

        }

        $books = $query->orderBy($sort, $order)->paginate($perPage);

        return response()->json($books);
    }

    public function store(StoreBookRequest $request)
    {
        $book = Book::create($request->validated());
        return new BookResource($book);
    }

    public function show(Book $book)
    {
        return $book;
    }

    public function update(StoreBookRequest $request, Book $book)
    {
        $book->update($request->validated());
        return new BookResource($book);
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return response(null, 204);
    }
}
