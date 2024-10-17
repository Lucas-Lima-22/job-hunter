<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CompanyPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Company $company): bool
    {
        return $company->is_active || $company->user_id === $user->id;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function manage(User $user, Company $company): bool
    {
        return $company->is_active && $company->user_id === $user->id ;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Company $company): bool
    {
        return $company->user_id === $user->id;
    }
}
