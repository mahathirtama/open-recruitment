<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Http\Requests\StoreArtikelRequest;
use App\Http\Requests\UpdateArtikelRequest;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $data = Artikel::with('pencaker')->get();
        $decodeData = json_decode(json_encode($data));
        return response()->json([
            "message" => "success",
            'statusCode' => 200,
            "data" => $decodeData,
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
    public function store(StoreArtikelRequest $request)
    {
        try {
            $isValidateData = $request->validate([
                "id_pencaker" => 'required',
                "judul" => 'required',
                "isi" => 'required',
            ]);
            Artikel::create($isValidateData);
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
    public function show($id)
    {
        $checkData  = Artikel::find($id);
         if (!$checkData == []) {
              $setData = [
                "judul" => $checkData->judul,
                "isi" => $checkData->isi,
                "pencaker" => $checkData->pencaker,
            ];
            return response()->json([
                "message" => "success",
                'statusCode' => 200,
                "data" => $setData
            ]);
        } else {
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
    public function edit(Artikel $artikel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArtikelRequest $request, Artikel $artikel)
    {
        try {
            $isValidateData = $request->validate([
                "id_pencaker" => 'required',
                "judul" => 'required',
                "isi" => 'required',
            ]);
            $artikel->update($isValidateData);
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
    public function destroy(Artikel $artikel)
    {
        try {
            $artikel->delete();
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
