<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Http\Resources\CollectionResource;
use App\Http\Requests\StoreCollectionRequest;
use Illuminate\Http\Request;

class CollectionController extends Controller
{

    public function index(Request $request)
    {
        $sort = $request->input('sort', 'name');
        $order = $request->input('order', 'asc');
        $search = $request->input('search');

        $query = Collection::query();

        if($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $collections = $query->orderBy($sort, $order)->get();

        return CollectionResource::collection($collections);
    }

    public function paginate(Request $request)
    {
        $sort = $request->input('sort', 'id');
        $order = $request->input('order', 'asc');
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');

        $query = Collection::query();

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $collections = $query->orderBy($sort, $order)->paginate($perPage);

        return response()->json($collections);
    }
    public function store(StoreCollectionRequest $request)
    {
        $collection = Collection::create($request->validated());
        return new CollectionResource($collection);
    }

    public function show(Collection $collection)
    {
        return $collection;
    }

    public function update(StoreCollectionRequest $request, Collection $collection)
    {
        $collection->update($request->validated());
        return new CollectionResource($collection);
    }

    public function destroy(Collection $collection)
    {
        $collection->delete();
        return response(null, 204);
    }
}
