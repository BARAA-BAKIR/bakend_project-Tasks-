<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function delete(Request $request)
    {
        $user = User::find($request->id);
        if ($user  && $user->id == Auth::id()) {
            $user->delete();
            return response()->json(['message' => 'تم الحذف بنجاح']);
        }
        return response()->json(['message' => 'لا يمكنك الحذف'], 404);
    }
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if ($user && $user->id == Auth::id()) {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
            return response()->json($user);
        }
        return response()->json(['message' => 'لا يمكنك التعديل'], 404);
    }
    public function getall(Request $request){
        $project = User::all();
        return response()->json([
            'data'=>$project,
            'status'=>200,
            'message'=>'get all projects successfully' 
        ]);
    }
    public function getUser($id)
    {
        $userProjects = User::with('projects')->find($id);
        if ($userProjects) {
            return response()->json($userProjects);
        }
        return response()->json(['message' => 'المستخدم غير موجود'], 404);
    }
}
