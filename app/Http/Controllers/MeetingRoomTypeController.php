<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MeetingRoomType;
use App\Http\Requests\MeetingRoomTypeStoreRequest;
use App\Http\Requests\MeetingRoomTypeUpdateRequest;

class MeetingRoomTypeController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', MeetingRoomType::class);

        $search = $request->get('search', '');

        $meetingRooms = MeetingRoomType::search($search)
            ->latest()
            ->paginate(5);

        return Inertia::render(
            'app.meeting_rooms.index',
            compact('meetingRooms', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', MeetingRoomType::class);

        return Inertia::render('app.meeting_rooms.create');
    }

    /**
     * @param \App\Http\Requests\MeetingRoomTypeStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(MeetingRoomTypeStoreRequest $request)
    {
        $this->authorize('create', MeetingRoomType::class);

        $validated = $request->validated();

        $meetingRoomType = MeetingRoomType::create($validated);

        return redirect()
            ->route('meeting-rooms.edit', $meetingRoomType)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\MeetingRoomType $meetingRoomType
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, MeetingRoomType $meetingRoomType)
    {
        $this->authorize('view', $meetingRoomType);

        return Inertia::render('app.meeting_rooms.show', compact('meetingRoomType'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\MeetingRoomType $meetingRoomType
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, MeetingRoomType $meetingRoomType)
    {
        $this->authorize('update', $meetingRoomType);

        return Inertia::render('app.meeting_rooms.edit', compact('meetingRoomType'));
    }

    /**
     * @param \App\Http\Requests\MeetingRoomTypeUpdateRequest $request
     * @param \App\Models\MeetingRoomType $meetingRoomType
     * @return \Illuminate\Http\Response
     */
    public function update(
        MeetingRoomTypeUpdateRequest $request,
        MeetingRoomType $meetingRoomType
    ) {
        $this->authorize('update', $meetingRoomType);

        $validated = $request->validated();

        $meetingRoomType->update($validated);

        return redirect()
            ->route('meeting-rooms.edit', $meetingRoomType)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\MeetingRoomType $meetingRoomType
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, MeetingRoomType $meetingRoomType)
    {
        $this->authorize('delete', $meetingRoomType);

        $meetingRoomType->delete();

        return redirect()
            ->route('meeting-rooms.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
