<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        $project = Task::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'user_id'=>$request->user_id,
            'project_id'=>$request->project_id,
            'due_date'=>$request->due_date,
            'status'=>$request->status,
        ]);
        return response()->json($project->load('user','project'));
    }
    public function delete(Request $request)
    {
        $user = Task::find($request->id);
        if ($user) {
            $user->delete();
            return response()->json(['message' => 'تم الحذف بنجاح']);
        }
        return response()->json(['message' => 'المهمة غير موجود'], 404);
    }
    public function update(Request $request, $id)
    {
        $user = Task::find($id);
        if ($user) {
            $user->update([
                'title' => $request->title,
                'description' => $request->description,
                'project_id' => $request->project_id,
                'user_id'=> $request->user_id,
                'due_date'=> $request->due_date,
                'status'=> $request->status,
            ]);
            return response()->json($user);
        }
        return response()->json(['message' => 'المستخدم غير موجود'], 404);
    }
    public function getall(Request $request)
    {
        $project = Task::all();
        return response()->json([
            'data' => $project,
            'status' => 200,
            'message' => 'get all projects successfully'
        ]);
    }
    public function getuser($id)
    {
        $user = Task::with('user')->find($id);
        if ($user) {
            return response()->json($user);
        }
        return response()->json(['message' => 'العلاقة غير موجودة'], 404);
    }
    public function getproject($id)
    {
        $user = Task::with('project')->find($id);
        if ($user) {
            return response()->json($user);
        }
        return response()->json(['message' => 'العلاقة غير موجودة'], 404);
    }
}
