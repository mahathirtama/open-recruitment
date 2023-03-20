<?php

namespace App\Http\Controllers;

use App\Models\Pencaker;
use App\Http\Requests\StorePencakerRequest;
use App\Http\Requests\UpdatePencakerRequest;

class PencakerController extends Controller
{
     public function index()
    {
    $data = Pencaker::with('user', 'provinsi', 'pengalaman', 'pendidikan')->get();
        $decodeData = json_decode(json_encode($data));
        foreach($decodeData as $key =>$value){
 
            $dataTransform[] = [
                 "id" => $value->id,
                 "nama" => $value->nama,
                "tangal_lahir" => $value->tangal_lahir,
                "jenis_kelamin" => $value->jenis_kelamin,
                "telpon" => $value->telpon,
                "ktp" => $value->ktp,
                "disabilitas" => $value->disabilitas,
                "provinsi" => $value->provinsi->provinsi,
                "pengalaman" => $value->pengalaman,
                "pendidikan" => $value->pendidikan,
                "user" => $value->user,
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
    public function store(StorePencakerRequest $request)
    {
        try {
            $isValidateData = $request->validate([
                "id_user" => 'required',
                "id_provinsi" => 'required',
                "nama" => 'required',
                "tangal_lahir" => 'required',
                "jenis_kelamin" => 'required',
                "telpon" => 'required',
                "ktp" => 'required',
                "disabilitas" => 'required',
            ]);
            Pencaker::create($isValidateData);
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
          $checkData  = Pencaker::find($id);
         if (!$checkData == []) {
              $setData = [
                "id" => $checkData->id,
                "nama" => $checkData->nama,
                "tangal_lahir" => $checkData->tangal_lahir,
                "jenis_kelamin" => $checkData->jenis_kelamin,
                "telpon" => $checkData->telpon,
                "ktp" => $checkData->ktp,
                "disabilitas" => $checkData->disabilitas,
                "provinsi" => $checkData->provinsi->provinsi,
                "pengalaman" => $checkData->pengalaman,
                "pendidikan" => $checkData->pendidikan,
                "user" => $checkData->user
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
    public function edit(Pencaker $pencaker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePencakerRequest $request, Pencaker $pencaker)
    {

        try {
            $isValidateData = $request->validate([
                "id_user" => 'required',
                "id_provinsi" => 'required',
                "nama" => 'required',
                "tangal_lahir" => 'required',
                "jenis_kelamin" => 'required',
                "telpon" => 'required',
                "ktp" => 'required',
                "disabilitas" => 'required',
            ]);
            $pencaker->update($isValidateData);
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
    public function destroy(Pencaker $pencaker)
    {
        try {
            $pencaker->delete();
            return response()->json([
                "message" => "success",
                'statusCode' => 200,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => "error kesalahan saat delete data",
                'statusCode' => 400,
            ]);
        }
    }
}
