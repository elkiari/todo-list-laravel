<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Http\Request;

class TaskManager extends Controller
{
    public function addTask()
    {
        return view('tasks.add');
    }

    public function listTask()
    {
        $tasks = Tasks::where('user_id', auth()->user()->id)->where('status', NULL)->paginate(4);
        return view('home', compact('tasks'));
    }

    public function addTaskPost(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'deadline' => 'required',
            'description' => 'required'
        ]);

        $task = new Tasks();
        $task->title = $request->title;
        $task->deadline = $request->deadline;
        $task->description = $request->description;
        $task->user_id = auth()->user()->id;

        if($task->save()){
            return redirect(route('home'))->with('success', 'Task added successfully');
        }

        return redirect(route('task.add'))->with('error', 'Task not added');
    }

    public function updateTaskStatus($id)
    {
        if (Tasks::where('user_id', auth()->user()->id)->where('id', $id)->update(['status' => 'completed'])){
            return redirect(route('home'))->with('success', 'Task completed');
        }
        return redirect(route('home'))->with('error', 'error occurred updating try again');
    }

    public function deleteTask($id)
    {
        if (Tasks::where('user_id', auth()->user()->id)->where('id', $id)->delete()){
            return redirect(route('home'))->with('success', 'Task deleted');
        }
        return redirect(route('home'))->with('error', 'error occurred deleting try again');
    }


}
