<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChargingSessionRequest;
use App\Http\Requests\UpdateChargingSessionRequest;
use App\Models\ChargingSession;
use App\Models\Reservation;

class ChargingSessionController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sessions = ChargingSession::whereHas('reservation', function ($query) {
            $query->where('user_id', auth()->id());
        })->orderBy('start_time', 'desc')->get();

        return response()->json([
            'sessions' => $sessions
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChargingSessionRequest $request)
    {
        $data = $request->validated();
        //
        $reservation = Reservation::where('id', $data['reservation_id'])
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $data['start_time'] = now();

        $session = ChargingSession::create($data);

        return response()->json([
            'session' => $session,
            'message' => 'Session started successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ChargingSession $chargingSession)
    {
        if ($chargingSession->reservation->user_id !== auth()->id()) {
            return response()->json(['message' => 'Non autorisé'], 403);
        }
        return response()->json($chargingSession, 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChargingSessionRequest  $request, ChargingSession $chargingSession)
    {
        $data = $request->validated();

        $session = ChargingSession::findOrFail($chargingSession->id);

        if ($session->reservation->user_id !== auth()->id()) {
            return response()->json(['message' => 'Non autorisé'], 403);
        }

        $data['end_time'] = now();
        $session->update($data);

        return response()->json([
            'session' => $session,
            'message' => 'Session ended successfully'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ChargingSession $chargingSession)
    {
        if ($chargingSession->reservation->user_id !== auth()->id()) {
            return response()->json(['message' => 'Non autorisé'], 403);
        }
        $chargingSession->delete();
        return response()->json([
            'message' => 'deleted successfully'
        ], 200);
    }
}
