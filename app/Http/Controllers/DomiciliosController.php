<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Domicilio; //Declarar modelo creado
use Illuminate\Support\Facades\DB;

class DomiciliosController extends Controller
{
    public function crear(Request $req){

        $respuesta = ["status" => 1, "msg" => ""];

        $datos = $req -> getContent();

        //VALIDAR EL JSON 
        $datos = json_decode($datos); //Se puede pasar un parametro para que en su lugar lo devuelva como array
        
        //VALIDAR LOS DATOS    
        $domicilio = new Domicilio();

        $domicilio -> calle = $datos->calle;
        $domicilio -> numero = $datos->numero;
        $domicilio -> CP = $datos->CP;
      
        //Escribir en la base de datos
        try {
            $domicilio->save();
            $respuesta["msg"] = "Domicilio Guardado";
        }catch (\Exception $e) {
            $respuesta["status"] = 0;
            $respuesta["msg"] = "Se ha producido un error".$e->getMessage();  
        }
        return response()->json($respuesta);
    }

    public function editar(Request $req, $id){

        $respuesta = ["status" => 1, "msg" => ""];

        $datos = $req -> getContent();

        //VALIDAR EL JSON 
        $datos = json_decode($datos); //Se puede pasar un parametro para que en su lugar lo devuelva como array
        //Buscar domicilio
        $domicilio = Domicilio::find($id);

        if ($domicilio){

            if(isset($datos->calle))
            $domicilio -> calle = $datos->calle;

            if(isset($datos->numero))
            $domicilio -> numero = $datos->numero;

            if(isset($datos->CP))
            $domicilio -> CP = $datos->CP;


            //Escribir en la base de datos
            try {
                $domicilio->save();
                $respuesta["msg"] = "Cambios realizados.";
            }catch (\Exception $e) {
                $respuesta["status"] = 0;
                $respuesta["msg"] = "Se ha producido un error".$e->getMessage();  
            }
        } else {
                $respuesta["msg"] = "Domicilio no encontrado"; 
                $respuesta["status"] = 0;
        }
        return response()->json($respuesta);
    }

    public function borrar($id){

        $respuesta = ["status" => 1, "msg" => ""];
        //Buscar a la domicilio
        $domicilio = Domicilio::find($id);

        if($domicilio){

            try {
                $domicilio->delete();
                $respuesta["msg"] = "Domicilio borrado";
            }catch (\Exception $e) {
                $respuesta["status"] = 0;
                $respuesta["msg"] = "Se ha producido un error".$e->getMessage();  
            }
        }else {
            $respuesta["msg"] = "Domicilio no encontrado"; 
            $respuesta["status"] = 0;
        }

        return response()->json($respuesta);

    }

    public function ver($id){

        $respuesta = ["status" => 1, "msg" => ""];

        try {
            $domicilio = Domicilio::find($id);
            $domicilio ->personas;
            $respuesta['datos'] = $domicilio;
        }catch (\Exception $e) {
            $respuesta["status"] = 0;
            $respuesta["msg"] = "Se ha producido un error".$e->getMessage();  
        }
        return response()->json($respuesta);

    }
    
    //Filtro por calle prueba
    public function verporNumero(Request $req){

        $respuesta = ["status" => 1, "msg" => ""];

        try {
            $domicilio = DB::table('domicilios');

            if($req -> has('calle'))
                $domicilio = $domicilio->where('calle','like','%'. $req -> input('calle').'%');
            
            if($req -> has('CP'))
            $domicilio = $domicilio->where('CP','like','%'. $req -> input('CP').'%');

            if($req -> has('numero'))
            $domicilio = $domicilio->where('numero', $req -> input('numero'));

            $domicilio = $domicilio->orderBy('created_at', 'desc');
            $domicilio = $domicilio->get();
            $respuesta['datos'] = $domicilio;
        }catch (\Exception $e) {
            $respuesta["status"] = 0;
            $respuesta["msg"] = "Se ha producido un error".$e->getMessage();  
        }
        return response()->json($respuesta);

    }
}
