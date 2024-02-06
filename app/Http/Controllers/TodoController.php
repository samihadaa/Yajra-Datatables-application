<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;

class TodoController extends Controller
{
    public function index(){
        $todos = Todo::orderBy('created_at', 'DESC')->get();
        return response()->json([
            'todos' => $todos,
            'status' => 200,
        ]);
    }
    public function show(Todo $todo){
        return response()->json([
            'todo' => $todo,
            'status' => 200,
        ]);
    }
    public function store(TodoRequest $request)
    {
        $todoData = $request->validated();
        $todo = Todo::create($todoData);
        return response()->json([
        'todo' => $todo,
        'status' => 201,
        ]);
    }
    public function update(Todo $todo, TodoRequest $request){
        $todo->update($request->validated());
        return response()->json([
            'todo' => $todo,
            'status' => 200,
            ]);
    }
    public function destroy(Todo $todo){
        $todo->delete();
        return response()->json([
            'message' => 'todo deleted successfully',
            'status' => 200,
            ]);
    }
}
