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
        $chargingStation =  ChargingStation::create($data);
        return response()->json([
            'station' => $chargingStation,
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
            'station' => $chargingStation,
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
            'station' => $chargingStation,
            'message' => 'deleted successfully'
        ], 200);
    }

    /**
     * Search for charging stations based on location and filters.
     */
    public function search(Request $request)
    {
        $status = $request->query('status');
        $connector = $request->query('connector_type');
        $power = $request->query('power');

        $stations = ChargingStation::query();

        if ($status) {
            $stations->where('status', $status);
        }

        if ($connector) {
            $stations->whereHas('connectorType', function ($query) use ($connector) {
                $query->where('name', $connector);
            });
        }

        if ($power) {
            $stations->where('power_kw', '>=', $power);
        }

        return response()->json([
            'stations' => $stations->get()
        ], 200);
    }

    public function getStats()
    {
        $stations = ChargingStation::all();



        return response()->json([
            'totalStations' => $stations->count(),
        ], 200);
    }
}
