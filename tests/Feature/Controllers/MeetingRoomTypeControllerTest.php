<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\MeetingRoomType;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MeetingRoomTypeControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_meeting_rooms()
    {
        $meetingRooms = MeetingRoomType::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('meeting-rooms.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.meeting_rooms.index')
            ->assertViewHas('meetingRooms');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_meeting_room_type()
    {
        $response = $this->get(route('meeting-rooms.create'));

        $response->assertOk()->assertViewIs('app.meeting_rooms.create');
    }

    /**
     * @test
     */
    public function it_stores_the_meeting_room_type()
    {
        $data = MeetingRoomType::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('meeting-rooms.store'), $data);

        $this->assertDatabaseHas('meeting_rooms', $data);

        $meetingRoomType = MeetingRoomType::latest('id')->first();

        $response->assertRedirect(
            route('meeting-rooms.edit', $meetingRoomType)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_meeting_room_type()
    {
        $meetingRoomType = MeetingRoomType::factory()->create();

        $response = $this->get(route('meeting-rooms.show', $meetingRoomType));

        $response
            ->assertOk()
            ->assertViewIs('app.meeting_rooms.show')
            ->assertViewHas('meetingRoomType');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_meeting_room_type()
    {
        $meetingRoomType = MeetingRoomType::factory()->create();

        $response = $this->get(route('meeting-rooms.edit', $meetingRoomType));

        $response
            ->assertOk()
            ->assertViewIs('app.meeting_rooms.edit')
            ->assertViewHas('meetingRoomType');
    }

    /**
     * @test
     */
    public function it_updates_the_meeting_room_type()
    {
        $meetingRoomType = MeetingRoomType::factory()->create();

        $data = [
            'name' => $this->faker->word,
            'icon' => $this->faker->imageUrl($width = 640, $height = 480),
        ];

        $response = $this->put(
            route('meeting-rooms.update', $meetingRoomType),
            $data
        );

        $data['id'] = $meetingRoomType->id;

        $this->assertDatabaseHas('meeting_rooms', $data);

        $response->assertRedirect(
            route('meeting-rooms.edit', $meetingRoomType)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_meeting_room_type()
    {
        $meetingRoomType = MeetingRoomType::factory()->create();

        $response = $this->delete(
            route('meeting-rooms.destroy', $meetingRoomType)
        );

        $response->assertRedirect(route('meeting-rooms.index'));

        $this->assertSoftDeleted($meetingRoomType);
    }
}
