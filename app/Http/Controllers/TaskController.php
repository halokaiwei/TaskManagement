<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    //    
    public function viewTasksPage() {
        $tasks = Task::whereNull('picked_up_by')->get(); 
        return view('viewTasksPage', compact('tasks'));
    }

    public function createTask(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'tools_used' => 'nullable|string',
            'category' => 'required|string|in:writing articles,assignment helping,Data Entry,Graphic Design,Web Development,Marketing,Research,Translation,Content Editing,Event Planning,Video Editing',
            'due_date' => 'required|date',
        ]);

        $task = new Task();
        $task->title = $request->input('title');
        $task->content = $request->input('content');
        $task->tools_used = $request->input('tools_used');
        $task->category = $request->input('category');
        $task->due_date = $request->input('due_date');
        
        $task->posted_by = auth()->user()->id;

        $task->save();
        return redirect('/viewTasksPage')->with('success', 'Task posted successfully!');
}

public function updateTask(Request $request, $id) {
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'tools_used' => 'nullable|string',
        'category' => 'required|string|in:writing articles,assignment helping,Data Entry,Graphic Design,Web Development,Marketing,Research,Translation,Content Editing,Event Planning,Video Editing',
        'due_date' => 'required|date',
    ]);

    $task = Task::findOrFail($id);
    $task->title = $request->input('title');
    $task->content = $request->input('content');
    $task->tools_used = $request->input('tools_used');
    $task->category = $request->input('category');
    $task->due_date = $request->input('due_date');
    
    $task->save();
    return redirect('/viewTasksPage')->with('success', 'Task updated successfully!');
}

public function modifyTaskPage($id) {
    $task = Task::findOrFail($id);
    if (!$task) {
        return 'Task not found!';
    }
    return view('modifyTaskPage',compact('task'));
}

public function deleteTaskPage($id) {
    $task = Task::findOrFail($id);
    if (!$task) {
        return 'Task not found!';
    }
    return view('deleteTaskPage',compact('task'));
}

public function deleteTask($id) {
    $task = Task::findOrFail($id);
    if (!$task) {
        return 'Task not found!';
    }
    $task->delete();
    return view('/viewTasksPage');
}

public function pickUpTaskPage($id) {
    $task = Task::findOrFail($id);
    if (!$task) {
        return 'Task not found!';
    }
    return view('/pickUpTaskPage',compact('task'));
}

public function pickUpTask($id) {
    $task = Task::findOrFail($id);
    if (!$task) {
        return 'Task not found!';
    }
    $user = auth()->user();
    $task->picked_up_by = $user->id;
    $task->save();
    return redirect('/myProfilePage')->with('success', 'Task picked up successfully!');
}

public function dropTaskPage($id) {
    $task = Task::findOrFail($id);
    if (!$task) {
        return 'Task not found!';
    }
    return view('/dropTaskPage',compact('task'));
}

public function dropTask($id) {
    $task = Task::findOrFail($id);
    if (!$task) {
        return 'Task not found!';
    }
    $user = auth()->user();
    if ($task->picked_up_by !== $user->id) {
        return 'You are not authorized to drop this task!';
    }
    
    // Reset the picked_up_by field to null
    $task->picked_up_by = null;
    $task->save();

    return redirect('/myProfilePage')->with('success', 'Task dropped successfully!');
}
}
