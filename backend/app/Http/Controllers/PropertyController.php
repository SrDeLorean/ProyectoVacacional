<?php

namespace App\Http\Controllers;
use App\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Contructor que se encarga de limitar los permisos a este controlador
     */
    public function __construct()
    {
        $this->middleware(['permission:read property'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:create property'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:update property'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete property'], ['only' => 'delete']);
        //$this->middleware(['permission:restore user'], ['only' => 'disabled', 'restore']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $properties = Property::all();
            return response()->json([
                'success' => true,
                'message' => "Se a listado propiedades con exito",
                'data' => ['properties'=>$properties]
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
        //
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
