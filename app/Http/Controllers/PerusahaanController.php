<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use App\Http\Requests\StorePerusahaanRequest;
use App\Http\Requests\UpdatePerusahaanRequest;

class PerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          $data = Perusahaan::with('user', 'bidang', 'provinsi')->get();
        $decodeData = json_decode(json_encode($data));
        foreach($decodeData as $key =>$value){
 
            $dataTransform[] = [
                "id" => $value->id,
                "user" => $value->user,
                "bidang" => $value->bidang->nama_bidang,
                "nama_perushaan" => $value->nama_perushaan,
                "alamat" => $value->alamat,
                "provinsi" => $value->provinsi->provinsi,
                "website" => $value->website,
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
    public function store(StorePerusahaanRequest $request)
    {
        try {
            $isValidateData = $request->validate([
                "id_user" => 'required',
                "id_bidang" => 'required',
                "id_provinsi" => 'required',
                "nama_perushaan" => 'required',
                "alamat" => 'required',
                "website" => 'required',
            ]);
            Perusahaan::create($isValidateData);
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
          $checkData  = Perusahaan::find($id);
         if (!$checkData == []) {
              $setData = [
              "id" => $checkData->id,
                "user" => $checkData->user,
                "bidang" => $checkData->bidang->nama_bidang,
                "nama_perushaan" => $checkData->nama_perushaan,
                "alamat" => $checkData->alamat,
                "provinsi" => $checkData->provinsi->provinsi,
                "website" => $checkData->website,
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
    public function edit(Perusahaan $perusahaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePerusahaanRequest $request, Perusahaan $perusahaan)
    {
        try {
            $isValidateData = $request->validate([
                "id_user" => 'required',
                "id_bidang" => 'required',
                "id_provinsi" => 'required',
                "nama_perusahaan" => 'required',
                "alamat" => 'required',
                "website" => 'required',
            ]);
            $perusahaan->update($isValidateData);
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
    public function destroy(Perusahaan $perusahaan)
    {
        try {
            $perusahaan->delete();
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
