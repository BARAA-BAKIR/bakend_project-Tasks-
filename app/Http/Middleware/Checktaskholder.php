<?php

namespace App\Http\Middleware;

use App\Models\Task;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Checktaskholder
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
    //     $taskId = $request->route('task'); 
    //     $task = Task::find($taskId);

    $user_id = $request->input('user_id');
    $task_id = $request->input('task_id');
    $user_task=Task::where('user_id',$user_id)
    ->where('id',  $task_id)
    ->first();
        if ($user_task==null) {
            return response()->json(['error' => 'انت لست صاحب المهمة'], 403);
        }

        return $next($request);
    }
}

