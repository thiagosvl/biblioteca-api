<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Http\Resources\AuthorResource;
use App\Http\Requests\StoreAuthorRequest;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'full_name');
        $order = $request->input('order', 'asc');
        $search = $request->input('search');

        $query = Author::query();

        if($search) {
            $query->where('full_name', 'like', '%' . $search . '%');
        }

        $authors = $query->orderBy($sort, $order)->get();

        return AuthorResource::collection($authors);
    }

    public function paginate(Request $request)
    {
        $sort = $request->input('sort', 'id');
        $order = $request->input('order', 'asc');
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');

        $query = Author::query();

        if ($search) {
            $query->where('full_name', 'like', '%' . $search . '%');
        }

        $authors = $query->orderBy($sort, $order)->paginate($perPage);

        return response()->json($authors);
    }

    public function store(StoreAuthorRequest $request)
    {
        $author = Author::create($request->validated());
        return new AuthorResource($author);
    }

    public function show(Author $author)
    {
        return $author;
    }

    public function update(StoreAuthorRequest $request, Author $author)
    {
        $author->update($request->validated());
        return new AuthorResource($author);
    }

    public function destroy(Author $author)
    {
        $author->delete();
        return response(null, 204);
    }
}
