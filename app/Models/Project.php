<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
    ];
    public function users()
    {
        return $this->belongsToMany(User::class,'user_projects');
    }
    public function task(){
        return $this->hasMany(Task::class);

    }
    public function project_comm()
    {
        return $this->hasMany(ProjectComms::class);
    }
}
