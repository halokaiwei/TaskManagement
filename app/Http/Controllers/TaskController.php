<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DropRequest;
use App\Models\Task;
use Illuminate\Support\Facades\Validator;


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
    return redirect('/modifyTaskPage',compact('task'));
}

public function deleteTaskPage($id) {
    $task = Task::findOrFail($id);
    if (!$task) {
        return 'Task not found!';
    }
    return redirect('/deleteTaskPage',compact('task'));
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
    return redirect('/pickUpTaskPage',compact('task'));
}

public function pickUpTask($id) {
    $task = Task::findOrFail($id);
    if (!$task) {
        return 'Task not found!';
    }
    $user = auth()->user();
    $task->picked_up_by = $user->id;
    $task->status = 'Ongoing';
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
    $task->status = 'Drop Pending';
    $task->save();
    $user = auth()->user();
    if ($task->picked_up_by !== $user->id) {
        return 'You are not authorized to drop this task!';
    }
    DropRequest::create([
        'task_id' => $task->id,
        'user_id' => $user->id,
        'status' => 'Pending',
    ]);
    return view('/dropTaskConfirmationPage');
}

public function dropApproved($id) {
    $dropRequest = DropRequest::findOrFail($id);
    $task= Task::findOrFail($dropRequest->task_id);
    $task->picked_up_by = null;
    $task->status = 'Drop Approved';
    $task->save();

    $dropRequest->status = 'Success';
    $dropRequest->save();
    return redirect('/myProfilePage');
}

public function dropRejected($id) {
    $task->status = 'Drop Rejected';
    $task->save();
    $dropRequest = DropRequest::findOrFail($id);
    $dropRequest->status = 'Rejected';
    $dropRequest->save();
    return view('dropApprovalPage');
}

public function dropApprovedConfirmationPage($id) {
    $dropRequest = DropRequest::findOrFail($id);
    return view('/dropApprovedConfirmationPage',compact('dropRequest'));
}

public function dropRejectedConfirmationPage($id) {
    $dropRequest = DropRequest::findOrFail($id);
    return view('dropRejectedConfirmationPage',compact('dropRequest'));
}

public function dropApprovalPage() {
    $dropRequests = DropRequest::where('status', 'Pending')->get();
    return view('dropApprovalPage', compact('dropRequests'));
}

public function submitProgressPage($id) {
    $task = Task::findOrFail($id);
    return redirect('submitProgressPage', compact('task'));
}

public function submitTaskProgress(Request $request, $id) {

}
}
