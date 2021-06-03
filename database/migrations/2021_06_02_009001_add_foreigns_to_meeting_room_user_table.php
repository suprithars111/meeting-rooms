<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignsToMeetingRoomUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meeting_room_user', function (Blueprint $table) {
            $table
                ->foreign('meeting_room_id')
                ->references('id')
                ->on('meeting_rooms');

            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('meeting_room_user', function (Blueprint $table) {
            $table->dropForeign(['meeting_room_id']);
            $table->dropForeign(['user_id']);
        });
    }
}
