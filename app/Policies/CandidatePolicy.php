<?php

namespace App\Policies;

use App\Models\Candidate;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CandidatePolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Candidate $candidate): bool
    {
        return $user->id === $candidate->user_id;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function manage(User $user, Candidate $candidate): bool
    {
        return $user->id === $candidate->user_id && $candidate->is_active;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Candidate $candidate): bool
    {
        return $user->id === $candidate->user_id;
    }
}
