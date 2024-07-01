<?php

namespace App\Http\Middleware;

use App\Models\UserProject;
use Closure;
use Illuminate\Http\Request;

class Checkprojectholder
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user_id = $request->input('user_id');
        $project_id = $request->input('project_id');
        $userProject = UserProject::where('user_id',$user_id)
        ->where('project_id',  $project_id)
        ->first();
        if (!$userProject) {
            return response()->json(['error' => 'انت لست موجود في المشروع لا يمكنك التعليق'], 403);
        }
        return $next($request);
    }
}
