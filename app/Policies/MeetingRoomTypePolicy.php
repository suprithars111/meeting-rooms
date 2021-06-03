<?php

namespace App\Policies;

use App\Models\User;
use App\Models\MeetingRoomType;
use Illuminate\Auth\Access\HandlesAuthorization;

class MeetingRoomTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the meetingRoomType can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list meetingrooms');
    }

    /**
     * Determine whether the meetingRoomType can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\MeetingRoomType  $model
     * @return mixed
     */
    public function view(User $user, MeetingRoomType $model)
    {
        return $user->hasPermissionTo('view meetingrooms');
    }

    /**
     * Determine whether the meetingRoomType can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create meetingrooms');
    }

    /**
     * Determine whether the meetingRoomType can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\MeetingRoomType  $model
     * @return mixed
     */
    public function update(User $user, MeetingRoomType $model)
    {
        return $user->hasPermissionTo('update meetingrooms');
    }

    /**
     * Determine whether the meetingRoomType can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\MeetingRoomType  $model
     * @return mixed
     */
    public function delete(User $user, MeetingRoomType $model)
    {
        return $user->hasPermissionTo('delete meetingrooms');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\MeetingRoomType  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete meetingrooms');
    }

    /**
     * Determine whether the meetingRoomType can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\MeetingRoomType  $model
     * @return mixed
     */
    public function restore(User $user, MeetingRoomType $model)
    {
        return false;
    }

    /**
     * Determine whether the meetingRoomType can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\MeetingRoomType  $model
     * @return mixed
     */
    public function forceDelete(User $user, MeetingRoomType $model)
    {
        return false;
    }
}
