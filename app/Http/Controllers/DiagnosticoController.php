<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diagnosticos;
use App\Models\DiagnosticosXConsulta;
use Illuminate\Support\Facades\Log;
use App\Models\Patologia;

class DiagnosticoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Diagnosticos::select(
            'tbl_diagnostico.id_diagnosticos',
            'tbl_diagnostico.fecha_diag',
            'tbl_diagnostico.estado_de_salud',
            'tbl_patologias.nombre_patologia',
            'tbl_patologias.codigo_cie'
        )
        ->join('tbl_diagnosticos_consulta', 'tbl_diagnostico.id_diagnosticos', '=', 'tbl_diagnosticos_consulta.id_diagnostico')
        ->join('tbl_patologias', 'tbl_diagnostico.patologia_id', '=', 'tbl_patologias.id_patologia')
        ->where('tbl_diagnosticos_consulta.id_consulta', '=', $request->selectedConsulta)
        ->get(); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Patologia $patologiaTB, DiagnosticosXConsulta $diagXC)
    {
        //getting the patologia id
        $id_patologia = $patologiaTB::where('nombre_patologia', 'LIKE', '%' . $request->patologia . '%')->first()->id_patologia;
        //inserting diagnostico on tbl_diagnosticos and getting the insert id
        $idLastDiag = Diagnosticos::insertGetId([
            'fecha_diag' => Diagnosticos::raw('NOW()'),
            'patologia_id' => $id_patologia,
            'estado_de_salud' => $request->estadoDeSalud
        ]);

        $diagXC::insert([
            'id_consulta' => $request->id_consulta,
            'id_diagnostico' => $idLastDiag
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
