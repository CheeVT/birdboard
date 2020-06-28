<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];

    public function path() {
        return "/projects/{$this->id}";
    }

    public function owner() {
        return $this->belongsTo('App\User', 'owner_id');
    }

    public function tasks() {
        return $this->hasMany(Task::class);
    }

    public function addTask($body) {
        return $this->tasks()->create(compact('body'));
    }

    public function recordActivity($description) {
        $this->activity()->create(compact('description'));
    }

    public function activity() {
        return $this->hasMany(Activity::class)->latest();
    }
}
