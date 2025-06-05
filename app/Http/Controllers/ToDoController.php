<?php

namespace App\Http\Controllers;

use App\Filters\TodoFilter;
use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Http\Resources\TodoResource;
use App\Models\Todo;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ToDoController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       $user=Auth::user();
       $query=$user->role == 'owner' ? $user->todos():Todo::query();
       $query->with(['priority','category']);
       $dataAfterSearchFilter=(new TodoFilter($request))->searchAndFilter($query);
       
       $todos=$dataAfterSearchFilter->latest()->paginate(10);
        return response()->json([
        'data'=> TodoResource::collection($todos),
        'meta' => [
            'current_page' => $todos->currentPage(),
            'last_page' => $todos->lastPage(),
            'per_page' => $todos->perPage(),
            'total' => $todos->total(),
        ],
        'links' => [
            'first' => $todos->url(1),
            'last' => $todos->url($todos->lastPage()),
            'next' => $todos->nextPageUrl(),
            'prev' => $todos->previousPageUrl(),
        ],
            'message'=>'get all todos successfully',
        ],
            200);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTodoRequest $request)
    {
        $data=$request->validated();
        $data['user_id']=Auth::id();
        $todo=Todo::create($data);
        return response()->json([
            'data'=>new TodoResource($todo->load(['priority','category'])),
            'message'=>'created successfully',
        ],
            201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        $this->authorize('view', $todo);
           return response()->json([
            'data'=>new TodoResource($todo->load(['priority','category'])),
            'message'=>'showed successfully',
        ],
            200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTodoRequest $request, Todo $todo)
    {
        $this->authorize('update',$todo);

        $todo->update($request->validated());
            return response()->json([
            'data'=>new TodoResource($todo->load(['priority','category'])),
            'message'=>'updated successfully',
        ],
            200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $this->authorize('delete', $todo);
        $todo->delete();
        return response()->json(['message'=>'deleted successfully'],200);
    }
    
    public function Completed(Todo $todo){

        $this->authorize('update',$todo);
        $todo->is_completed = !$todo->is_completed;
        $todo->save();
        return response()->json(['message'=>'todo completion status updated'],200);
    }

}
