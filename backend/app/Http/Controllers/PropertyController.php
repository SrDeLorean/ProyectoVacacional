<?php

namespace App\Http\Controllers;
use App\Property;
use Validator;
use Illuminate\Http\Request;

use Tymon\JWTAuth\Facades\JWTAuth;

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
        $credenciales = JWTAuth::parseToken()->authenticate();
        try{
            if($credenciales->role =="admin"){
                $properties = Property::all();
                foreach ($properties as $property){
                    $property->category_property= $property->getPropertyCategory->name;
                    $property->user_autor= $property->getUserAutor->name;
                }
            }else{
                $properties = Property::where("user_autor", $credenciales->id)->get();
                foreach ($properties as $property){
                    $property->category_property= $property->getPropertyCategory->name;
                }
            }
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
        return response()->json([
            'success' => false,
            'message' => 'el cliente debe usar un protocolo distinto',
            'data' => ['error'=>'El el protocolo se llama store']
        ], 426 );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $entradas = $request->only('name', 'description', 'category_property', 'valoration', 'location', 'location_description');
        $validator = Validator::make($entradas, [
            'name' => ['required','string'],
            'description' => ['required','string'], 
            'category_property'=> ['required','numeric'],
            'valoration' => ['required', 'numeric'],
            'location' => ['required', 'string'],
            'location_description' => ['required', 'string']
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error en datos ingresados',
                'data' => ['error'=>$validator->errors()]
            ], 422);
        }
        try{
            $credenciales = JWTAuth::parseToken()->authenticate();
            $property = new Property();
            $property->name=$entradas['name'];
            $property->description=$entradas['description'];
            $property->category_property=$entradas['category_property'];
            $property->valoration=$entradas['valoration'];
            $property->location=$entradas['location'];
            $property->location_description=$entradas['location_description'];
            $property->user_autor=$credenciales->id;
            $property->save();
            return response()->json([
                'success' => true,
                'message' => "Se a creado una propiedad con exito",
                'data' => ['property'=>$property]
            ], 200);
        }catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json([
                'success' => false,
                'message' => "Tenemos problemas con nuestra base de datos, intente mas tarde",
                'data' => ['error'=>$ex]
            ], 409  );
        }
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
