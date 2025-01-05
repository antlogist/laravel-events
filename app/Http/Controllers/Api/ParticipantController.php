<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ParticipantResource;
use App\Models\Participant;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ParticipantController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Event $event)
    {
        if (!Gate::allows('viewAny', Event::class)) {
            abort(403);
        }

        return ParticipantResource::collection(
            $event->participants()->latest()->paginate()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Event $event)
    {
        if (!Gate::allows('create', Event::class)) {
            abort(403);
        }

        $participant = $event->participants()->create([
            'user_id' => $request->user()->id,
        ]);

        return new ParticipantResource($participant);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event, Participant $participant)
    {
        if (!Gate::allows('view', Event::class)) {
            abort(403);
        }

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
    public function destroy(Event $event, Participant $participant)
    {
        if (! Gate::allows('delete-participant', [$event, $participant])) {
            return response()->json([
                'message' => 'Not allowed'
            ], 403);
        }

        $participant->delete();

        return response(status: 204);
    }
}
