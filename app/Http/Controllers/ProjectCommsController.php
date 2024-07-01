<?php

namespace App\Http\Controllers;

use App\Models\ProjectComms;
use Illuminate\Http\Request;

class ProjectCommsController extends Controller
{
    public function store(Request $request){
        $project = ProjectComms::create([
            'name' => $request->name,
            'user_id'=>$request->user_id,
            'project_id'=>$request->project_id,
        ]);
        return response()->json($project->load('project','user'));
    }
    public function delete(Request $request){
        $user = ProjectComms::find($request->id);
            if ($user) {
                $user->delete();
                return response()->json(['message' => 'تم الحذف بنجاح']);
            }
        return response()->json(['message' => 'المستخدم غير موجود'], 404);
    }
    public function update(Request $request, $id){
        $user = ProjectComms::find($id);
        if ($user) {
            $user->update([
                'comment' => $request->comment,
                'project_id' => $request->project_id,
                'user_id' => $request->user_id,
            ]);
            return response()->json($user);
        }
        return response()->json(['message' => 'المستخدم غير موجود'], 404);
    }
    public function getall(){
        $project = ProjectComms::all();
        return response()->json([
            'data' => $project,
            'status' => 200,
            'message' => 'get all project_comm successfully'
        ]);
    }
    public function getproject($id)
    {
        $user = ProjectComms::with('project')->find($id);
        if ($user) {
            return response()->json($user);
        }
        return response()->json(['message' => 'العلاقة غير موجودة'], 404);
    }
    public function getuser($id){
        $user = ProjectComms::with('user')->find($id);
        if ($user) {
            return response()->json($user);
        }
        return response()->json(['message' => 'العلاقة غير موجودة'], 404);
    }
}
