<?php

namespace App\Http\Controllers;

use App\Models\Pencaker_Daftar_Lowongan;
use App\Http\Requests\StorePencaker_Daftar_LowonganRequest;
use App\Http\Requests\UpdatePencaker_Daftar_LowonganRequest;

class PencakerDaftarLowonganController extends Controller
{/**
     * Display a listing of the resource.
     */
    public function index()
    {
         $data = Pencaker_Daftar_Lowongan::with('pencaker', 'lowongan')->get();
        $decodeData = json_decode(json_encode($data));
        foreach($decodeData as $key =>$value){
 
            $dataTransform[] = [
                "id" => $value->id,
                "pencaker" => $value->pencaker,
                "lowongan" => $value->lowongan,
                "lamaran" => $value->lamaran,
                "cv" => $value->cv,
                "status_lamaran" => $value->status_lamaran,
            ];
        }
          return response()->json([
            "message" => "success",
            'statusCode' => 200,
            "data" => $dataTransform,
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
    public function store(StorePencaker_Daftar_LowonganRequest $request)
    {
         try {
            $isValidateData = $request->validate([
                "id_pencaker" => 'required',
                "id_lowongan" => 'required',
                "lamaran" => 'required',
                "cv" => 'required',
                "status_lamaran" => 'required',
            ]);
            Pencaker_Daftar_Lowongan::create($isValidateData);
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
          $checkData  = Pencaker_Daftar_Lowongan::find($id);
         if (!$checkData == []) {
              $setData = [
              "id" => $checkData->id,
                "pencaker" => $checkData->pencaker,
                "lowongan" => $checkData->lowongan,
                "lamaran" => $checkData->lamaran,
                "cv" => $checkData->cv,
                "status_lamaran" => $checkData->status_lamaran,
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
    public function edit(Pencaker_Daftar_Lowongan $pencaker_Daftar_Lowongan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePencaker_Daftar_LowonganRequest $request, Pencaker_Daftar_Lowongan $pencaker_Daftar_Lowongan)
    {
          try {
            $isValidateData = $request->validate([
                "id_pencaker" => 'required',
                "id_lowongan" => 'required',
                "lamaran" => 'required',
                "cv" => 'required',
                "status_lamaran" => 'required',
            ]);
            $pencaker_Daftar_Lowongan->update($isValidateData);
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
    public function destroy(Pencaker_Daftar_Lowongan $pencaker_Daftar_Lowongan)
    {
         try {
            $pencaker_Daftar_Lowongan->delete();
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
