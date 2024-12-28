<?php

namespace App\Policies;

use App\Models\CarRentalCategory;
use App\Models\User;

class CarRentalCategoryPolicy
{
    public function modify(User $user, CarRentalCategory $carRentalCategory)
    {
        return $user->id === $carRentalCategory->user_id;
    }
    // /**
    //  * Determine whether the user can view any models.
    //  */
    // public function viewAny(User $user): bool
    // {
    //     return false;
    // }

    // /**
    //  * Determine whether the user can view the model.
    //  */
    // public function view(User $user, CarRentalCategory $carRentalCategory): bool
    // {
    //     return false;
    // }

    // /**
    //  * Determine whether the user can create models.
    //  */
    // public function create(User $user): bool
    // {
    //     return false;
    // }

    // /**
    //  * Determine whether the user can update the model.
    //  */
    // public function update(User $user, CarRentalCategory $carRentalCategory): bool
    // {
    //     return false;
    // }

    // /**
    //  * Determine whether the user can delete the model.
    //  */
    // public function delete(User $user, CarRentalCategory $carRentalCategory): bool
    // {
    //     return false;
    // }

    // /**
    //  * Determine whether the user can restore the model.
    //  */
    // public function restore(User $user, CarRentalCategory $carRentalCategory): bool
    // {
    //     return false;
    // }

    // /**
    //  * Determine whether the user can permanently delete the model.
    //  */
    // public function forceDelete(User $user, CarRentalCategory $carRentalCategory): bool
    // {
    //     return false;
    // }
}
