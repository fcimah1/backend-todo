<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskModel;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }
    public function all()
    {
        return response()->json([Task::all()]);
    }
    public function getTaskBtId($id)
    {
        return response()->json([Task::findOrFail($id)]);
    }
    public function createTask(Request $request)
    {
        $task = $request->validate([
            'Task' => 'required',
            'is_done' => 'required',
            'Description' => 'required'
        ]);
        Task::create([
            'Task' => $task['Task'],
            'is_done' => $task['is_done'],
            'Description' => $task['Description']
        ]);
        return response()->json(['message'=>'Task Created successfully'], 201);
    }
    public function updateTask(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $data = $request->validate([
            'Task' => 'required',
            'is_done' => 'required',
            'Description' => 'required'
        ]);
        $task->Task = $data['Task'];
        $task->is_done = $data['is_done'];
        $task->Description = $data['Description'];
        $task->save();
        return response()->json(['message'=>'Task Updated successfully'], 201);
    }

    public function deleteTask($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json(['message'=>'Task Deleted successfully'], 201);
    }

    public function doneTasks($is_done){
        return response()->json([Task::where('is_done', $is_done)->get()]);
    }


    public function getAllTasksByUserId($user_id){
        return response()->json([Task::where('user_id', $user_id)->get()]);
    }
}
