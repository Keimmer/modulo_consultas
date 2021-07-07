<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tratamiento;
use App\Models\EspecialidadMedico;
use App\Models\EspecialidadTratamiento;
use App\Models\TipoTratamiento;
use App\Models\TratamientosXDiagnostico;
use Illuminate\Support\Facades\Log;

class TratamientosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        return Tratamiento::select(
            'tbl_tratamiento.id_tratamientos',
            'tbl_tratamiento.fecha_inicio',
            'tbl_tratamiento.fecha_fin',
            'tbl_tratamiento.objetivo',
            'tbl_tratamiento.riesgos',
            'tbl_tipo_tratamiento.tipo_tratamiento',
            'persona.nombre as mednombre',
            'persona.apellido as medapellido',
            'persona.cedula as medcedula'
            )
            ->join('tbl_tipo_tratamiento', 'tbl_tratamiento.id_tipo_tratamiento', '=', 'tbl_tipo_tratamiento.id_tipo_tratamiento')
            ->join('persona', 'tbl_tratamiento.id_medico', '=', 'persona.id_persona')
            ->join('tbl_tratamiento_diagnostico', 'tbl_tratamiento.id_tratamientos', '=', 'tbl_tratamiento_diagnostico.id_tratamientos')
            ->where('tbl_tratamiento_diagnostico.id_diagnosticos', '=', $request->selectedDiag)
            ->get();
    }

    public function especialidadesTratamientos(Request $request) {
        $id = EspecialidadTratamiento::select('tbl_especialidad.id_especialidad')
        ->join('tbl_tipo_tratamiento', 'tbl_especialidad_tratamientos.id_tipo_tratamiento', '=', 'tbl_tipo_tratamiento.id_tipo_tratamiento')
        ->join('tbl_especialidad', 'tbl_especialidad_tratamientos.id_especialidad', '=', 'tbl_especialidad.id_especialidad')
        ->where('tbl_tipo_tratamiento.tipo_tratamiento', 'LIKE', '%'.$request->tipo_tratamiento.'%')
        ->get();

        Log::info($id[0]->id_especialidad);

        return EspecialidadMedico::select('persona.id_persona as idmed', 'persona.nombre as mednom', 'persona.apellido as medap', 'persona.cedula as medced')
        ->join('persona', 'tbl_especialidad_medicos.id_medico', '=', 'persona.id_persona')
        ->where('tbl_especialidad_medicos.id_especialidad', '=', $id[0]->id_especialidad)
        ->get();
    }

    public function getTratamientos() {
        return TipoTratamiento::select('tbl_tipo_tratamiento.id_tipo_tratamiento', 'tbl_tipo_tratamiento.tipo_tratamiento')->get();
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
        //getting the tipo trat id
        $id_tipo_trat = TipoTratamiento::where('tipo_tratamiento', 'LIKE', '%' . $request->nombre_tratamiento . '%')->first()->id_tipo_tratamiento;
        //inserting diagnostico on tbl_diagnosticos and getting the insert id
        $idLastTrat = Tratamiento::insertGetId([
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'objetivo' => $request->objetivo,
            'riesgos' => $request->riesgos,
            'id_tipo_tratamiento' => $id_tipo_trat,
            'id_medico' => $request->id_medico
        ]);

        TratamientosXDiagnostico::insert([
            'id_tratamientos' => $idLastTrat,
            'id_diagnosticos' => $request->id_diagnostico
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
    public function update(Request $request, $id)
    {
        //
        Log::info($id);
        Log::info($request['data']['fecha_inicio']);
        Tratamiento::where('id_tratamientos', $id)
        ->update([
            'fecha_inicio' => $request['data']['fecha_inicio'],
            'fecha_fin' => $request['data']['fecha_fin']
        ]);
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
