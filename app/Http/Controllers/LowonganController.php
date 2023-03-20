<?php

namespace App\Http\Controllers;

use App\Models\Lowongan;
use App\Http\Requests\StoreLowonganRequest;
use App\Http\Requests\UpdateLowonganRequest;

class LowonganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $data = Lowongan::with('user', 'perusahaan', 'perusahaan_daftar_event', 'event')->get();
        $decodeData = json_decode(json_encode($data));
        foreach($decodeData as $key =>$value){
 
            $dataTransform[] = [
                "id" => $value->id,
                "perushaan" => $value->perushaan,
                "perusahaan_daftar_event" => $value->perusahaan_daftar_event,
                "posisi" => $value->posisi,
                "kuota" => $value->kuota,
                "tugas" => $value->tugas,
                "gaji" => $value->gaji,
                "fasilitas" => $value->fasilitas,
                "deskripsi" => $value->deskripsi,
                "jenis_kelamin" => $value->jenis_kelamin,
                "usia_minimal" => $value->usia_minimal,
                "usai_maximal" => $value->usai_maximal,
                "kualifikasi" => $value->kualifikasi,
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
    public function store(StoreLowonganRequest $request)
    {
        try {
            $isValidateData = $request->validate([
                "id_perusahaan" => 'required',
                "id_perusahaan_daftar_event" => 'required',
                "posisi" => 'required',
                "kuota" => 'required',
                "tugas" => 'required',
                "gaji" => 'required',
                "fasilitas" => 'required',
                "deskripsi" => 'required',
                "jenis_kelamin" => 'required',
                "usia_minimal" => 'required',
                "usai_maximal" => 'required',
                "kualifikasi" => 'required',
            ]);
            Lowongan::create($isValidateData);
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
         $checkData  = Lowongan::find($id);
         if (!$checkData == []) {
              $setData = [
               "id" => $checkData->id,
                "perushaan" => $checkData->perushaan,
                "perusahaan_daftar_event" => $checkData->perusahaan_daftar_event,
                "event" => $checkData->event,
                "user" => $checkData->user,
                "posisi" => $checkData->posisi,
                "kuota" => $checkData->kuota,
                "tugas" => $checkData->tugas,
                "gaji" => $checkData->gaji,
                "fasilitas" => $checkData->fasilitas,
                "deskripsi" => $checkData->deskripsi,
                "jenis_kelamin" => $checkData->jenis_kelamin,
                "usia_minimal" => $checkData->usia_minimal,
                "usai_maximal" => $checkData->usai_maximal,
                "kualifikasi" => $checkData->kualifikasi,
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
    public function edit(Lowongan $lowongan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLowonganRequest $request, Lowongan $lowongan)
    {
        try {
            $isValidateData = $request->validate([
                "id_perusahaan" => 'required',
                "id_perusahaan_daftar_event" => 'required',
                "posisi" => 'required',
                "kuota" => 'required',
                "tugas" => 'required',
                "gaji" => 'required',
                "fasilitas" => 'required',
                "deskripsi" => 'required',
                "jenis_kelamin" => 'required',
                "usia_minimal" => 'required',
                "usai_maximal" => 'required',
                "kualifikasi" => 'required',
            ]);
            $lowongan->update($isValidateData);
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
    public function destroy(Lowongan $lowongan)
    {
        try {
            $lowongan->delete();
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
