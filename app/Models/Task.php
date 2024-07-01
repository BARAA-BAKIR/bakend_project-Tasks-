<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'project_id',
        'user_id',
        'due_date',
        'status',
    ];
    public function project(){
        return $this->belongsTo(Project::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function task_comm(){
        return $this->hasMany(TaskComms::class);
    }
    use HasFactory;
}
