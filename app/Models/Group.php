<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $table = 'group';    
    protected $fillable = ['name', 'project_id'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'group_user');
    }
}
