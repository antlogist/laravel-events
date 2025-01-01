<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ParticipantResource;
use App\Models\Participant;
use App\Models\Event;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Event $event)
    {
        return ParticipantResource::collection(
            $event->participants()->latest()->paginate()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Event $event)
    {
        $participant = $event->participants()->create([
            'user_id' => 1
        ]);

        return new ParticipantResource($participant);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event, Participant $participant)
    {
        return new ParticipantResource($participant);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Participant $participant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $event, Participant $participant)
    {
        $participant->delete();

        return response(status: 204);
    }
}
