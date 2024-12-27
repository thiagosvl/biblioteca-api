<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Http\Resources\SubjectResource;
use App\Http\Requests\StoreSubjectRequest;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'name');
        $order = $request->input('order', 'asc');
        $search = $request->input('search');

        $query = Subject::query();

        if($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $subjects = $query->orderBy($sort, $order)->get();

        return SubjectResource::collection($subjects);
    }

    public function paginate(Request $request)
    {
        $sort = $request->input('sort', 'id');
        $order = $request->input('order', 'asc');
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');

        $query = Subject::query();

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $subjects = $query->orderBy($sort, $order)->paginate($perPage);

        return response()->json($subjects);
    }

    public function store(StoreSubjectRequest $request)
    {
        $subject = Subject::create($request->validated());
        return new SubjectResource($subject);
    }

    public function show(Subject $subject)
    {
        return $subject;
    }

    public function update(StoreSubjectRequest $request, Subject $subject)
    {
        $subject->update($request->validated());
        return new SubjectResource($subject);
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return response(null, 204);
    }
}
