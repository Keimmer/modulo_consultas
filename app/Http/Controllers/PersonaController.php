<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->cedula){
            return Persona::select(
                'persona.id_persona',
                'persona.nombre',
                'persona.apellido',
                'persona.cedula',
                'persona.direccion',
                'persona.telefono',
                Persona::raw('YEAR(CURDATE()) - YEAR(fecha_nacimiento) AS edad'),
                'generos.nombre_genero AS genero')
                ->join('generos', 'persona.id_genero', '=', 'generos.idgenero')
                ->where('persona.roles_id', '=', '2')
                ->where('cedula', 'like', '%'. $request->cedula.'%')
                ->get();

        }

        return Persona::select(
            'persona.id_persona',
            'persona.nombre',
            'persona.apellido',
            'persona.cedula',
            'persona.direccion',
            'persona.telefono',
            Persona::raw('YEAR(CURDATE()) - YEAR(fecha_nacimiento) AS edad'),
            'generos.nombre_genero AS genero')
            ->join('generos', 'persona.id_genero', '=', 'generos.idgenero')
            ->where('persona.roles_id', '=', '2')
            ->get();
    }

    public function getMedicos(Request $request) {
        $name = explode(' ', $request->nombre);
        Log::info($name[0]);
        return Persona::where('persona.nombre', 'LIKE', '%'.$name[0].'%')->first()->id_persona;
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
        error_log($request->cedula);
        $res = Persona::insert([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'cedula' => $request->cedula,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono
        ]);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Persona $persona)
    {
        $persona->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function destroy(Persona $persona)
    {        
        $persona->delete();
    }
}
