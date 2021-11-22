<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona; //Declarar modelo creado

class PersonasController extends Controller
{
    public function crear(Request $req){

        $respuesta = ["status" => 1, "msg" => ""];

        $datos = $req -> getContent();

        //VALIDAR EL JSON 
        $datos = json_decode($datos); //Se puede pasar un parametro para que en su lugar lo devuelva como array
        
        //VALIDAR LOS DATOS    
        $persona = new Persona();

        $persona -> nombre = $datos->nombre;
        $persona -> primer_apellido = $datos->primer_apellido;
        $persona -> segundo_apellido = $datos->segundo_apellido;
        $persona -> fecha_nacimiento = $datos->fecha_nacimiento;
      
        //Escribir en la base de datos
        try {
            $persona->save();
            $respuesta["msg"] = "Persona Guardada";
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
        //Buscar persona
        $persona = Persona::find($id);

        if ($persona){

            if(isset($datos->nombre))
            $persona -> nombre = $datos->nombre;

            if(isset($datos->primer_apellido))
            $persona -> primer_apellido = $datos->primer_apellido;

            if(isset($datos->segundo_apellido))
            $persona -> segundo_apellido = $datos->segundo_apellido;

            if(isset($datos->fecha_nacimiento))
            $persona -> fecha_nacimiento = $datos->fecha_nacimiento;

            //Escribir en la base de datos
            try {
                $persona->save();
                $respuesta["msg"] = "Cambios realizados.";
            }catch (\Exception $e) {
                $respuesta["status"] = 0;
                $respuesta["msg"] = "Se ha producido un error".$e->getMessage();  
            }
        } else {
                $respuesta["msg"] = "Persona no encontarda"; 
                $respuesta["status"] = 0;
        }
        return response()->json($respuesta);
    }

    public function borrar($id){

        $respuesta = ["status" => 1, "msg" => ""];
        //Buscar a la persona
        $persona = Persona::find($id);

        if($persona){

            try {
                $persona->delete();
                $respuesta["msg"] = "Persona borrada";
            }catch (\Exception $e) {
                $respuesta["status"] = 0;
                $respuesta["msg"] = "Se ha producido un error".$e->getMessage();  
            }
        }else {
            $respuesta["msg"] = "Persona no encontarda"; 
            $respuesta["status"] = 0;
        }

        return response()->json($respuesta);

    }

    public function listar_personas(){

        $respuesta = ["status" => 1, "msg" => ""];

        try {
            $personas = Persona::all();
            $respuesta['datos'] = $personas;
        }catch (\Exception $e) {
            $respuesta["status"] = 0;
            $respuesta["msg"] = "Se ha producido un error".$e->getMessage();  
        }
        return response()->json($respuesta);
    }

    public function ver_persona($id){

        $respuesta = ["status" => 1, "msg" => ""];

        try {
            $persona = Persona::find($id);
            $persona->domicilio;
            //Makevisible hace visible algun dato marcado como hidden en la clase asociada.
            //$persona -> makeVisible(['domicilio_id']);
            $persona -> makeVisible(['padre']);
            $persona -> makeVisible(['madre']);
            $respuesta['datos'] = $persona;
        }catch (\Exception $e) {
            $respuesta["status"] = 0;
            $respuesta["msg"] = "Se ha producido un error".$e->getMessage();  
        }
        return response()->json($respuesta);

    }
}
