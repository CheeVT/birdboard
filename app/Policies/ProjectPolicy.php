<?php

namespace App\Policies;

use App\User;
use App\Project;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Project $project) {
        return $user->is($project->owner) || $project->members->contains($user);
    }

    public function delete(User $user, Project $project) {
        return $user->is($project->owner);
    }

    public function manage(User $user, Project $project) {
        return $user->is($project->owner);
    }
}
