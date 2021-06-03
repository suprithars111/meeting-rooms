<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MeetingRoomType extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'icon'];

    protected $searchableFields = ['*'];

    protected $table = 'meeting_rooms';

    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'meeting_room_user',
            'meeting_room_id'
        );
    }
}
