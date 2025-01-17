<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Support\Facades\Gate;

class EventController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Gate::allows('viewAny', Event::class)) {
            abort(403);
        }

        return EventResource::collection(Event::with('user', 'participants')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        $data = $request->all();
        $data = [...$data, 'user_id' => $request->user()->id];

        $event = Event::create($data);

        return new EventResource($event);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $event->load('user', 'participants');
        return new EventResource($event);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        // if (! Gate::allows('update-event', $event)) {
        //     return response()->json([
        //         'message' => 'Not allowed'
        //     ], 403);
        // }

        if (!Gate::allows('update', $event)) {
            abort(403);
        }

        $event->update($request->all());

        return new EventResource($event);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        // if (! Gate::allows('delete-event', $event)) {
        //     return response()->json([
        //         'message' => 'Not allowed'
        //     ], 403);
        // }

        if (!Gate::allows('delete', $event)) {
            abort(403);
        }

        $event->delete();

        return response(status: 204);
    }
}
