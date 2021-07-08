<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consulta;
use App\Models\Historia;
use App\Models\Especialidad;
use App\Models\Sintoma;
use App\Models\Habito;
use App\Models\ProcedimientoXConsulta;
use App\Models\Procesos;
use App\Models\Persona;
use App\Models\HabitosXConsulta;
use App\Models\SintomXConsulta;
use Illuminate\Support\Facades\Log;

class ConsultaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->selectedPersona) {
            return Consulta::select(
                'tbl_consulta.id_consulta',
                'tbl_consulta.fecha_consulta',
                'persona.nombre',
                'persona.apellido',
                'tbl_especialidad.nombre_especialidad',
                Consulta::raw('count(tbl_procedimiento.id_procesos) as procedimientos'),
            )
                ->join('tbl_historia', 'tbl_consulta.id_consulta', '=', 'tbl_historia.id_consulta')
                ->join('persona', 'tbl_consulta.id_medico', '=', 'persona.id_persona')
                ->join('tbl_especialidad', 'tbl_consulta.id_especialidad', '=', 'tbl_especialidad.id_especialidad')
                ->join('tbl_procedimiento', 'tbl_consulta.id_consulta', '=', 'tbl_procedimiento.id_consulta')
                ->where('tbl_historia.id_paciente', '=', $request->selectedPersona)
                ->groupBy('id_consulta')
                ->get();
        }

        if($request->selectedCons){
            return Consulta::select(
                'tbl_consulta.id_consulta', 
                'tbl_consulta.fecha_consulta',
                'tbl_especialidad.nombre_especialidad',
                'tbl_procesos.proceso',
                'tbl_procedimiento.resultado',
                'tbl_sintomas.sintoma',
                'tbl_habitos.habito'
            )
                ->join('tbl_especialidad', 'tbl_consulta.id_especialidad', '=', 'tbl_especialidad.id_especialidad')
                ->join('tbl_procedimiento', 'tbl_consulta.id_consulta', '=', 'tbl_procedimiento.id_consulta')
                ->join('tbl_procesos', 'tbl_procedimiento.id_procesos', '=', 'tbl_procesos.id_procesos')
                ->join('tbl_sintomas_consulta', 'tbl_consulta.id_consulta', '=', 'tbl_sintomas_consulta.id_consulta')
                ->join('tbl_sintomas', 'tbl_sintomas_consulta.id_sintoma', '=', 'tbl_sintomas.id_sintoma')
                ->join('tbl_habitos_consulta', 'tbl_consulta.id_consulta', '=', 'tbl_habitos_consulta.id_consulta')
                ->join('tbl_habitos', 'tbl_habitos_consulta.id_habito', '=', 'tbl_habitos.id_habito')
                ->where('tbl_consulta.id_consulta', '=', $request->selectedCons)
                ->get();
        }
    }

    public function especialidadIndex()
    {
        return Especialidad::get();
    }

    public function habitosIndex()
    {
        return Habito::get();
    }

    public function sintomasIndex()
    {
        return Sintoma::get();
    }

    public function procesosIndex()
    {
        return Procesos::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Sintoma $sintomatb, Habito $habitotb, Especialidad $especialidadtb, Procesos $proceduretb, ProcedimientoXConsulta $procXCons,)
    {

        if($request->edit) {
            foreach ($request->procesos as $proceso) {
                $id_proceso = $proceduretb::where('proceso', 'LIKE', '%' . $proceso['value'] . '%')->first()->id_procesos;
    
    
                $resultPxC = ProcedimientoXConsulta::insert([
                    'id_procesos' => $id_proceso,
                    'id_consulta' => $request->id_consulta,
                    'resultado' => $proceso['resultado']
                ]);
            }
            return;
        }

        //getting the specialty ID
        $id_especialidad = $especialidadtb::where('nombre_especialidad', 'LIKE', '%' . $request->especialidad . '%')->first()->id_especialidad;
        //in this line of code i insert the consulta row i use the insertGetId to get the id as a result
        $idLastCon = Consulta::insertGetId([
            'fecha_consulta' => Consulta::raw('CURDATE()'),
            'id_medico' => Persona::where(Persona::raw('concat(nombre, " ", apellido)'), 'LIKE', '%'.auth()->user()->name.'%' )->first()->id_persona,
            'id_especialidad' => $id_especialidad
        ]);
        // whith this command i get the last inserted id


        Historia::insert([
            'id_paciente' => $request['id_paciente'],
            'id_tipo_motivo' => 1,
            'id_consulta' => $idLastCon
        ]);

        ////////////////////////////////
        //inserting sintomas by consulta
        ////////////////////////////////
        foreach ($request->sintomas as $sintoma) {
            $sintoma_id = $sintomatb::where('sintoma', 'LIKE', '%' . $sintoma['value'] . '%')->first()->id_sintoma;
            $resultSxC = SintomXConsulta::insert([
                'id_consulta' => $idLastCon,
                'id_sintoma' => $sintoma_id,
            ]);
        }
        foreach ($request->habitos as $habito) {
            $habito_id = $habitotb::where('habito', 'LIKE', '%' . $habito['value'] . '%')->first()->id_habito;

            $resultHxC = HabitosXConsulta::insert([
                'id_consulta' => $idLastCon,
                'id_habito' => $habito_id
            ]);
        }
        foreach ($request->procesos as $proceso) {
            $id_proceso = $proceduretb::where('proceso', 'LIKE', '%' . $proceso['value'] . '%')->first()->id_procesos;


            $resultPxC = ProcedimientoXConsulta::insert([
                'id_procesos' => $id_proceso,
                'id_consulta' => $idLastCon,
                'resultado' => $proceso['resultado']
            ]);
        }
    }

    public function getProcedures($req, Procesos $procedure)
    {
        return $procedure::where('proceso', 'LIKE', '%' . $req . '%')->first()->id_procesos;
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
