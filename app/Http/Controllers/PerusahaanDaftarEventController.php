<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan_Daftar_Event;
use App\Http\Requests\StorePerusahaan_Daftar_EventRequest;
use App\Http\Requests\UpdatePerusahaan_Daftar_EventRequest;

class PerusahaanDaftarEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $data = Perusahaan_Daftar_Event::with('perusahaan')->get();
        $decodeData = json_decode(json_encode($data));
        foreach($decodeData as $key =>$value){
 
            $dataTransform[] = [
                "id" => $value->id,
                "perusahaan" => $value->perusahaan,
                "nama_pic" => $value->nama_pic,
                "jabatan_pic" => $value->jabatan_pic,
                "persetujuan" => $value->persetujuan,
                "alasan_ditolak" => $value->alasan_ditolak,
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
    public function store(StorePerusahaan_Daftar_EventRequest $request)
    {
         try {
            $isValidateData = $request->validate([
                "id_perusahaan" => 'required',
                "nama_pic" => 'required',
                "jabatan_pic" => 'required',
                "persetujuan" => 'required',
                "alasan_ditolak" => 'required',
            ]);
            Perusahaan_Daftar_Event::create($isValidateData);
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
        $checkData  = Perusahaan_Daftar_Event::find($id);
         if (!$checkData == []) {
              $setData = [
               "id" => $checkData->id,
                "perusahaan" => $checkData->perusahaan,
                "nama_pic" => $checkData->nama_pic,
                "jabatan_pic" => $checkData->jabatan_pic,
                "persetujuan" => $checkData->persetujuan,
                "alasan_ditolak" => $checkData->alasan_ditolak,
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
    public function edit(Perusahaan_Daftar_Event $perusahaan_Daftar_Event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePerusahaan_Daftar_EventRequest $request, Perusahaan_Daftar_Event $perusahaan_Daftar_Event)
    {
         try {
            $isValidateData = $request->validate([
                 "id_perusahaan" => 'required',
                "nama_pic" => 'required',
                "jabatan_pic" => 'required',
                "persetujuan" => 'required',
                "alasan_ditolak" => 'required',
            ]);
            $perusahaan_Daftar_Event->update($isValidateData);
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
    public function destroy(Perusahaan_Daftar_Event $perusahaan_Daftar_Event)
    {
         try {
            $perusahaan_Daftar_Event->delete();
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
