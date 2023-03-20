<?php

namespace App\Http\Controllers;

use App\Models\Pengalaman;
use App\Http\Requests\StorePengalamanRequest;
use App\Http\Requests\UpdatePengalamanRequest;

class PengalamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Pengalaman::with('pencaker')->get();
        $decodeData = json_decode(json_encode($data));
        foreach($decodeData as $key =>$value){
 
            $dataTransform[] = [
                "id" => $value->id,
                "pencaker" => $value->pencaker,
                "nama_perusahaan" => $value->nama_perusahaan,
                "jabatan" => $value->jabatan,
                "tahun_masuk" => $value->tahun_masuk,
                "tahun_keluar" => $value->tahun_keluar,
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
    public function store(StorePengalamanRequest $request)
    {
        try {
            $isValidateData = $request->validate([
                "id_pencaker" => 'required',
                "nama_perusahaan" => 'required',
                "jabatan" => 'required',
                "tahun_masuk" => 'required',
                "tahun_keluar" => 'required',
            ]);
            Pengalaman::create($isValidateData);
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
         $checkData  = Pengalaman::find($id);
         if (!$checkData == []) {
              $setData = [
                "id" => $checkData->id,
                "pencaker" => $checkData->pencaker,
                "nama_perusahaan" => $checkData->nama_perusahaan,
                "jabatan" => $checkData->jabatan,
                "tahun_masuk" => $checkData->tahun_masuk,
                "tahun_keluar" => $checkData->tahun_keluar,
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
    public function edit(Pengalaman $pengalaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePengalamanRequest $request, Pengalaman $pengalaman)
    {
        try {
            $isValidateData = $request->validate([
                "id_pencaker" => 'required',
                "nama_perusahaan" => 'required',
                "jabatan" => 'required',
                "tahun_masuk" => 'required',
                "tahun_keluar" => 'required',
            ]);
            $pengalaman->update($isValidateData);
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
    public function destroy(Pengalaman $pengalaman)
    {
        try {
            $pengalaman->delete();
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
