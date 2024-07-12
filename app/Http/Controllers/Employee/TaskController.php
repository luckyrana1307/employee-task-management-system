<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
class TaskController extends Controller
{
    public function assignedTasks()
    {
        $employeeId = auth()->guard('employee')->id();
        $tasks = Task::where('emp_id', $employeeId)
      
        ->get();

        
        return view('employee.tasks.assigned', compact('tasks'));
    }
    public function markComplete(Request $request)
    {
        $taskId = $request->input('task_id');
        $status = $request->input('status');
       

        $task = Task::findOrFail($taskId);
       
        // Ensure task belongs to logged-in employee (assuming employee authentication)
        // Add any additional checks as per your application logic
        if ($task->emp_id == auth()->guard('employee')->id()) {
            $task->status = $status;
            
            $task->save();

            return redirect()->route('employee.tasks.assigned')->with('success', 'Task status updated successfully.');
        }

        return redirect()->route('employee.tasks.assigned')->with('error', 'Failed to update task status.');
    }
}
