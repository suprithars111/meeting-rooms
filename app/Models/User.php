<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = ['name', 'profile_image', 'email', 'password'];

    protected $searchableFields = ['*'];

    protected $hidden = ['remember_token', 'password'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function meetingRooms()
    {
        return $this->belongsToMany(
            MeetingRoomType::class,
            'meeting_room_user',
            'meeting_room_id'
        );
    }

    public function isSuperAdmin()
    {
        return $this->hasRole('super-admin');
    }
}
