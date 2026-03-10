<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ConnectorType;
use App\Http\Requests\StoreConnectorTypeRequest;
use App\Http\Requests\UpdateConnectorTypeRequest;

class ConnectorTypeController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $connectorTypes = ConnectorType::all();
        return response()->json($connectorTypes, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreConnectorTypeRequest $request)
    {
        $data = $request->validated();
        ConnectorType::create($data);
        return response()->json([
            'message' => 'created successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ConnectorType $connectorType)
    {
        return response()->json($connectorType, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateConnectorTypeRequest $request, ConnectorType $connectorType)
    {
        $data = $request->validated();
        $connectorType->update($data);
        return response()->json([
            'message' => 'updated successfully'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ConnectorType $connectorType)
    {
        $connectorType->delete();
        return response()->json([
            'message' => 'deleted successfully'
        ], 200);
    }
}
