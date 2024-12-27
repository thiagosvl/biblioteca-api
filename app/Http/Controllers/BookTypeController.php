<?php

namespace App\Http\Controllers;

use App\Models\BookType;
use App\Http\Resources\BookTypeResource;
use App\Http\Requests\StoreBookTypeRequest;
use Illuminate\Http\Request;

class BookTypeController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'name');
        $order = $request->input('order', 'asc');
        $search = $request->input('search');

        $query = BookType::query();

        if($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $bookTypes = $query->orderBy($sort, $order)->get();

        return BookTypeResource::collection($bookTypes);
    }

    public function paginate(Request $request)
    {
        $sort = $request->input('sort', 'id');
        $order = $request->input('order', 'asc');
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');

        $query = BookType::query();

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $bookTypes = $query->orderBy($sort, $order)->paginate($perPage);

        return response()->json($bookTypes);
    }

    public function store(StoreBookTypeRequest $request)
    {
        $bookType = BookType::create($request->validated());
        return new BookTypeResource($bookType);
    }

    public function show(BookType $bookType)
    {
        return $bookType;
    }

    public function update(StoreBookTypeRequest $request, BookType $bookType)
    {
        $bookType->update($request->validated());
        return new BookTypeResource($bookType);
    }

    public function destroy(BookType $bookType)
    {
        $bookType->delete();
        return response(null, 204);
    }
}
