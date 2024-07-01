<?php

namespace App\Http\Controllers;

use App\Models\TaskComms;
use Illuminate\Http\Request;

class TaskCommsController extends Controller
{
    public function store(Request $request){
        $project = TaskComms::create([
            'comment' => $request->comment,
            'user_id'=>$request->user_id,
            'task_id'=>$request->task_id,
        ]);
       return response()->json($project);
    }
    public function delete(Request $request){
        $user = TaskComms::find($request->id);
        if ($user) {
            $user->delete();
            return response()->json(['message' => 'تم الحذف بنجاح']);
        }
        return response()->json(['message' => 'المستخدم غير موجود'], 404);
    }
    public function update(Request $request, $id)
    {
        $user = TaskComms::find($id);
        if ($user) {
            $user->update([
                'comment' => $request->comment,
                'task_id' => $request->task_id,
                'user_id' => $request->user_id,
            ]);
            return response()->json($user);
        }
        return response()->json(['message' => 'المستخدم غير موجود'], 404);
    }
    public function getall(){
        $project = TaskComms::all();
        return response()->json([
            'data' => $project,
            'status' => 200,
            'message' => 'get all task_comm successfully'
        ]);
    }
    public function getproject($id){
        $user = TaskComms::with('project')->find($id);
        if ($user) {
            return response()->json($user);
        }
        return response()->json(['message' => 'العلاقة غير موجودة'], 404);
    }
    public function getuser($id)
    {
        $user = TaskComms::with('user')->find($id);
        if ($user) {
            return response()->json($user);
        }
        return response()->json(['message' => 'العلاقة غير موجودة'], 404);
    }
}
