<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Models\Project;

class task extends Model
{
    use HasFactory;

    //protected $table = 'tasks';

    protected $fillable = [
        'id_project',  'task', 'description', 'dead_line', 'complete', 'finished_at', 
    ];   
    
    public function project(){
        return $this->belongsTo(Project::class, 'id_project', 'id');
    }
}
