<?php

namespace App\Http\Controllers;

use App\Models\UserProject;
use Illuminate\Http\Request;

class UserProjectController extends Controller
{
    public function store(Request $request){
        $project = UserProject::create([
            'project_id' => $request->project_id,
            'user_id' => $request->user_id,
            'role'=>$request->role,
            
           ]);
           return response()->json($project);
        }
        public function delete(Request $request)
        {
            $userProject = UserProject::find($request->id);
            if ($userProject) {
                $userProject->delete();
                return response()->json(['message' => 'تم الحذف بنجاح']);
            }
            return response()->json(['message' => 'العلاقة غير موجودة'], 404);
        }
        public function update(Request $request, $id)
        {
            $userProject = UserProject::find($id);
            if ($userProject) {
                $userProject->update([
                    'project_id' => $request->project_id,
                    'user_id' => $request->user_id,
                    'role'=>$request->role,
                ]);
                return response()->json($userProject);
            }
            return response()->json(['message' => 'العلاقة غير موجودة'], 404);
        }
        public function getall(Request $request){
            $project = UserProject::all();
            return response()->json([
                'data'=>$project,
                'status'=>200,
                'message'=>'get all projects successfully' 
            ]);
        }
        public function getUser($id)
        {
            $userProject = UserProject::with('user')->find($id);
            if ($userProject) {
                return response()->json($userProject);
            }
            return response()->json(['message' => 'العلاقة غير موجودة'], 404);
        }
        public function getProject($id)
        {
            $userProject = UserProject::with('project')->find($id);
            if ($userProject) {
                return response()->json($userProject);
            }
            return response()->json(['message' => 'العلاقة غير موجودة'], 404);
        }
}
