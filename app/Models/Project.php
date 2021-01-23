<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $fillable = [
        'project', 'description', 'dead_line', 'finished_at', 'finished', 'id_user',
    ];

    public function tasks(){
        return $this->hasMany(task::class, 'id_project ', 'id');
    }
}
