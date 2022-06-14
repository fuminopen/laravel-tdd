<?php

namespace App\Models;

use GuzzleHttp\Promise\TaskQueue;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'owner_id',
    ];

    public function owner()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function tasks()
    {
        return $this->hasMany('App\Models\Task');
    }

    /**
     * returns path to project detail page
     */
    public function path(): string
    {
        return '/projects/' . $this->id;
    }

    public function addTask(string $body): Task
    {
        return $this->tasks()->create(compact('body'));
    }
}
