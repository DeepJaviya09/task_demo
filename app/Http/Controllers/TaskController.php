<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;


class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::query();
    
        if ($request->has('status')) {
            $query->where('status', $request->input('status'));
        }
        
        if ($request->has('priority')) {
            $query->where('priority', $request->input('priority'));
        }
    
        $page = $request->input('page', 1); // Default page 1
        $perPage = $request->input('per_page', 10); // Default 10 items per page
    
        $total = $query->count(); // Get total items after filtering
        $tasks = $query
            ->offset(($page - 1) * $perPage)
            ->limit($perPage)
            ->get();
    
        return response()->json([
            'data' => $tasks,
            'current_page' => (int) $page,
            'per_page' => (int) $perPage,
            'total' => $total,
            'last_page' => ceil($total / $perPage),
        ]);
    }
    

    public function store(StoreTaskRequest $request)
    {
        $task = Task::create($request->validated());
        return response()->json($task, 201);
    }

    public function show($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        return response()->json($task);
    }

    public function update(UpdateTaskRequest $request, $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        $task->update($request->validated());

        return response()->json($task);
    }

    public function destroy($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        $task->delete();

        return response()->json(['message' => 'Task deleted successfully']);
    }
}
