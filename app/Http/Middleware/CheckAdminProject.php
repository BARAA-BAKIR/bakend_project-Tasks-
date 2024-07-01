<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\UserProject;
use Illuminate\Http\Request;

class CheckAdminProject
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
        if ($userProject && $userProject->role !== 'admin') {
            return response()->json(['error' => 'انت لست مشرف على المشروع لا يمكنك اجراء عمليات عليه'], 403);
        }
        return $next($request);
    }
}
