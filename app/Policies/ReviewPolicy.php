<?php

namespace App\Policies;

use App\Models\Review;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReviewPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        // Add your logic here for determining if the user can view any reviews
    }

    public function view(User $user, Review $review)
    {
        // Add your logic here for determining if the user can view the review
    }

    public function create(User $user)
    {
        // Add your logic here for determining if the user can create a review
    }

    public function update(User $user, Review $review)
    {
        return $user->id === $review->user_id;
    }

    public function delete(User $user, Review $review)
    {
        return $user->id === $review->user_id;
    }

    // Uncomment the remaining methods if needed

    // public function restore(User $user, Review $review)
    // {
    //     //
    // }

    // public function forceDelete(User $user, Review $review)
    // {
    //     //
    // }
}
