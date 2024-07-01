<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskComms extends Model
{
    use HasFactory;
    protected $fillable = [
        'comment',
        'task_id',
        'user_id',
        
    ];
    public function prject_comm(){
        return $this->belongsTo(User::class, 'user_projects');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function tasks(){
        return $this->belongsTo(Task::class);
    }
}
