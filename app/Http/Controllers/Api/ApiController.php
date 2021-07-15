<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getAll()
    {
        return Todo::all();
    }

    public function createTodo(Request $request)
    {
        $this->validate($request, [
            'body' => 'required|max:100'
        ]);

        $todo = new Todo();
        $todo->text = $request->body;
        return $todo->save();


    }

    public function deleteTodo($id)
    {
        $todo = Todo::findOrFail($id);
        return $todo->delete();
    }

    public function changeStatus($id, $status)
    {
        $todo = Todo::findOrFail($id);
        $todo->status = $status;
        return $todo->save();
    }
}
