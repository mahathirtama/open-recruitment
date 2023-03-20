<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use App\Http\Requests\StoreProvinsiRequest;
use App\Http\Requests\UpdateProvinsiRequest;

class ProvinsiController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            "message" => "success",
            'statusCode' => 200,
            "data" => Provinsi::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProvinsiRequest $request)
    {
        try {
            $isValidateData = $request->validate([
                "provinsi" => 'required',
            ]);
            Provinsi::create($isValidateData);
            return response()->json([
                "message" => "success",
                'statusCode' => 200,
                "data" => $isValidateData,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th->getMessage(),
                'statusCode' => 400,
                "data" => null
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Provinsi $provinsi)
    {
        try {
            return response()->json([
                "message" => "success",
                'statusCode' => 200,
                "data" => Provinsi::find($provinsi)
            ]);;
        } catch (\Throwable $th) {
            return response()->json([
                "message" => 'error data tidak di temukan',
                'statusCode' => 404,
                "data" => null
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Provinsi $provinsi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProvinsiRequest $request, Provinsi $provinsi)
    {
        try {
            $isValidateData = $request->validate([
                "provinsi" => 'required',
            ]);
            $provinsi->update($isValidateData);
            return response()->json([
                "message" => "success",
                'statusCode' => 200,
                "data" => $isValidateData,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th->getMessage(),
                'statusCode' => 400,
                "data" => null
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Provinsi $provinsi)
    {
        try {
            $provinsi->delete();
            return response()->json([
                "message" => "success",
                'statusCode' => 200,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th->getMessage(),
                'statusCode' => 400,
            ]);
        }
    }
}
