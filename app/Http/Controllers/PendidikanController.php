<?php

namespace App\Http\Controllers;

use App\Models\Pendidikan;
use App\Http\Requests\StorePendidikanRequest;
use App\Http\Requests\UpdatePendidikanRequest;

class PendidikanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Pendidikan::with('pencaker')->get();
        $decodeData = json_decode(json_encode($data));
        foreach($decodeData as $key =>$value){
 
            $dataTransform[] = [
                "id" => $value->id,
                "pencaker" => $value->pencaker,
                "institusi" => $value->institusi,
                "jurusan" => $value->jurusan,
                "tahun_lulus" => $value->tahun_lulus,
                "ijasah" => $value->ijasah,
                "ipk" => $value->ipk,
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
    public function store(StorePendidikanRequest $request)
    {
        try {
            $isValidateData = $request->validate([
                "id_pencaker" => 'required',
                "institusi" => 'required',
                "jurusan" => 'required',
                "tahun_lulus" => 'required',
                "ijasah" => 'required',
                "ipk" => 'required',
            ]);
            Pendidikan::create($isValidateData);
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
         $checkData  = Pendidikan::find($id);
         if (!$checkData == []) {
              $setData = [
                "id" => $checkData->id,
                "pencaker" => $checkData->pencaker,
                "institusi" => $checkData->institusi,
                "jurusan" => $checkData->jurusan,
                "tahun_lulus" => $checkData->tahun_lulus,
                "ijasah" => $checkData->ijasah,
                "ipk" => $checkData->ipk,
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
    public function edit(Pendidikan $pendidikan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePendidikanRequest $request, Pendidikan $pendidikan)
    {
        try {
            $isValidateData = $request->validate([
                "id_pencaker" => 'required',
                "institusi" => 'required',
                "jurusan" => 'required',
                "tahun_lulus" => 'required',
                "ijasah" => 'required',
                "ipk" => 'required',
            ]);
            $pendidikan->update($isValidateData);
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
    public function destroy(Pendidikan $pendidikan)
    {
        try {
            $pendidikan->delete();
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
