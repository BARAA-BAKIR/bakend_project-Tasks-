<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\UserProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function store(Request $request){
        $project = Project::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        $user= Auth::user();
        $project->users()->attach($user->id, ['role' => 'admin']);
        return response()->json($project->load('users'));          
    }
    public function delete(Request $request){
        $user = Auth::user();
        $project = Project::find($request->id);
        $userProject = UserProject::where('user_id', $user->id)
        ->where('project_id', $project->id)
        ->first();
        if (!$project || !$userProject || $userProject->role !== 'admin') {
            
            return response()->json(['message' => 'لا يمكن حذف المشروع'], 404);
        }
        $project->delete();
        return response()->json(['message' => 'تم الحذف بنجاح']);
    }
    public function update(Request $request, $id){
        $user = Auth::user();
        $project = Project::find($request->id);
        $userProject = UserProject::where('user_id', $user->id)
        ->where('project_id', $project->id)
        ->first();
        if (!$project || !$userProject || $userProject->role !== 'admin')  {
            return response()->json(['message' => 'لا يمكن التعديل على المشروع'], 404);
        }
        $project->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return response()->json($project);
    }
    public function getall(Request $request){
        $project = Project::all();
        return response()->json([
            'data'=>$project,
            'status'=>200,
            'message'=>'get all projects successfully' 
        ]);
    }
    public function getproject($id){
        $userProjects = Project::find($id);
        if ($userProjects) {
       $userProjects->user;
            return response()->json($userProjects);
        }
        return response()->json(['message' => 'المشروع غير موجود'], 404);
    }
    
}
