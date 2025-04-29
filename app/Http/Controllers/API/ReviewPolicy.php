<?php

namespace App\Policies;

use App\Models\Review;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReviewPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the review.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Review $review)
    {
        return $user->id === $review->user_id;
    }

    /**
     * Determine whether the user can delete the review.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Review $review)
    {
        return $user->id === $review->user_id;
    }
}