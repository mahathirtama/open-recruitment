<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;

class EventController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Event::with('perusahaan_daftar_event')->get();
        $decodeData = json_decode(json_encode($data));
        foreach($decodeData as $key =>$value){
 
            $dataTransform[] = [
                 "judul" => $value->judul,
                "deskripsi" => $value->deskripsi,
                "status" => $value->status,
                "alamat" => $value->alamat,
                "waktu_mulai" => $value->waktu_mulai,
                "waktu_berakhir" => $value->waktu_berakhir,
                "perusahaan_daftar_events" => $value->perusahaan_daftar_events,
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
    public function store(StoreEventRequest $request)
    {
        try {
            $isValidateData = $request->validate([
                "id_perusahaan_daftar_events" => 'required',
                "alamat" => 'required',
                "deskripsi" => 'required',
                "waktu_mulai" => 'required',
                "waktu_berakhir" => 'required',
                "status" => 'required',
                "judul" => 'required',
            ]);
            Event::create($isValidateData);
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
       $checkData  = Event::find($id);
         if (!$checkData == []) {
              $setData = [
                "judul" => $checkData->judul,
                "deskripsi" => $checkData->deskripsi,
                "status" => $checkData->status,
                "alamat" => $checkData->alamat,
                "waktu_mulai" => $checkData->waktu_mulai,
                "waktu_berakhir" => $checkData->waktu_berakhir,
                "perusahaan_daftar_events" => $checkData->perusahaan_daftar_events,
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
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        try {
            $isValidateData = $request->validate([
                "id_perusahaan_daftar_events" => 'required',
                "alamat" => 'required',
                "deskripsi" => 'required',
                "waktu_mulai" => 'required',
                "waktu_berakhir" => 'required',
                "status" => 'required',
                "judul" => 'required',
            ]);
            $event->update($isValidateData);
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
    public function destroy(Event $event)
    {
        try {
            $event->delete();
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
