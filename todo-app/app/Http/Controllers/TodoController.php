<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    //

    public function index() {
        return Todo::all();
    }

    public function show($id) {
        $todo = Todo::findOrFail($id);
        return response()->json($todo);
    }

    public function store(Request $request) {
        $validated = $request->validate(
            [
                'title'=>'required|string|max:255',
                'description'=>'nullable|string',
                'completed'=>'boolean'
            ]
        );
        $todo = Todo::create($validated);
        return response()->json($todo);
    }

    public function update(Request $request, $id){
        $todo = Todo::findOrFail($id);
        $validated = $request->validate(
            [
                'titile'=>'sometimes|string|max:255',
                'description'=>'nullable|string',
                'completed'=>'boolean'
            ]
        );
        $todo->update($validated);
        return response()->json($todo);
    }

    public function destroy($id) {
        $todo = Todo::findOrFail($id);
        $todo->delete();
        return response()->json($todo);
    }
}
