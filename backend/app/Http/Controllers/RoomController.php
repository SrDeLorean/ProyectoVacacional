<?php

namespace App\Http\Controllers;
use App\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $rooms = Room::all();
            foreach ($rooms as $room){
                $room->property_autor= $room->getPropertyAutor->name;
                $room->room_category= $room->getRoomCategory->name;
            }
            return response()->json([
                'success' => true,
                'message' => "Se a listado piesas con exito",
                'data' => ['rooms'=>$rooms]
            ], 200);
        } catch(\Illuminate\Database\QueryException $ex){  
            return response()->json([
                'success' => false,
                'message' => 'Error al solicitar peticion a la base de datos',
                'data' => ['error'=>$ex]
            ], 409);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $rooms = Room::Where('property_autor', $id)->get();
            foreach ($rooms as $room){
                $room->room_category= $room->getRoomCategory->name;
            }
            return response()->json([
                'success' => true,
                'message' => "Se a listado piesas con exito",
                'data' => ['rooms'=>$rooms]
            ], 200);
        } catch(\Illuminate\Database\QueryException $ex){  
            return response()->json([
                'success' => false,
                'message' => 'Error al solicitar peticion a la base de datos',
                'data' => ['error'=>$ex]
            ], 409);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
