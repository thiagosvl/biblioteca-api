<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use App\Http\Resources\PublisherResource;
use App\Http\Requests\StorePublisherRequest;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'name');
        $order = $request->input('order', 'asc');
        $search = $request->input('search');

        $query = Publisher::query();

        if($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $publishers = $query->orderBy($sort, $order)->get();

        return PublisherResource::collection($publishers);
    }

    public function paginate(Request $request)
    {
        $sort = $request->input('sort', 'id');
        $order = $request->input('order', 'asc');
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');

        $query = Publisher::query();

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $publishers = $query->orderBy($sort, $order)->paginate($perPage);

        return response()->json($publishers);
    }

    public function store(StorePublisherRequest $request)
    {
        $publisher = Publisher::create($request->validated());
        return new PublisherResource($publisher);
    }

    public function show(Publisher $publisher)
    {
        return $publisher;
    }

    public function update(StorePublisherRequest $request, Publisher $publisher)
    {
        $publisher->update($request->validated());
        return new PublisherResource($publisher);
    }

    public function destroy(Publisher $publisher)
    {
        $publisher->delete();
        return response(null, 204);
    }
}
