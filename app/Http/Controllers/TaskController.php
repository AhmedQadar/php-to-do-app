<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }
    
    public function add(Request $request)  
    {
        // Validate request
        $request->validate([
            'task' => 'required|string|max:255',
            'urgency' => 'required|in:low,medium,high',
            'due_date' => 'required|date',
        ]);

        // Create and save task
        Task::create([
            'task' => $request->task,
            'urgency' => $request->urgency,
            'due_date' => $request->due_date,
        ]);

        // Redirect with success message
        return redirect('/')->with('success', 'Task added successfully.');
    }

    public function index()
    {
        $tasks = Task::all(); 
        return view('tasks.index', compact('tasks'));  
    }

    public function update(Request $request, $id)
    {
        // Validate the input data
        $validated = $request->validate([
            'task' => 'required|string|max:255',
            'urgency' => 'required|string|in:low,medium,high',
            'due_date' => 'required|date',
        ]);

        // Find the task by ID
        $task = Task::find($id);

        if (!$task) {
            return redirect('/')->with('error', 'Task not found');
        }

        // Update task details
        $task->task = $request->input('task');
        $task->urgency = $request->input('urgency');
        $task->due_date = $request->input('due_date');

        // Save the task
        $task->save();

        // Redirect back with a success message
        return redirect('/')->with('success', 'Task updated successfully');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect('/')->with('success', 'Task deleted successfully.');
    }
}
