<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ChargingStation;
use App\Http\Requests\StoreChargingStationRequest;
use App\Http\Requests\UpdateChargingStationRequest;
use Symfony\Component\HttpFoundation\Request;

class ChargingStationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stations = ChargingStation::all();
        return response()->json($stations, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChargingStationRequest $request)
    {
        $data = $request->validated();
        ChargingStation::create($data);
        return response()->json([
            'message' => 'created successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ChargingStation $chargingStation)
    {
        return response()->json($chargingStation, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChargingStationRequest $request, ChargingStation $chargingStation)
    {
        $data = $request->validated();
        $chargingStation->update($data);
        return response()->json([
            'message' => 'updated successfully'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ChargingStation $chargingStation)
    {
        $chargingStation->delete();
        return response()->json([
            'message' => 'deleted successfully'
        ], 200);
    }

    /**
     * Search for charging stations based on location and filters.
     */
    public function search(Request $request)
    {
        $status = $request->query('status');
        $connector = $request->query('connector');
        $power = $request->query('power');

        $stations = ChargingStation::query();

        if ($status) {
            $stations->where('status', $status);
        }

        if ($connector) {
            $stations->where('connector_type', $connector);
        }

        if ($power) {
            $stations->where('power_kw', '>=', $power);
        }

        return response()->json([
            'stations' => $stations->get()
        ], 200);
    }
}
