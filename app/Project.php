<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use RecordsActivity;

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

    public function invite(User $user) {
        $this->members()->attach($user);
    }

    public function members() {
        return $this->belongsToMany(User::class, 'project_members');
    }

}
