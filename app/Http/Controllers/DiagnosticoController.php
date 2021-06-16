<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diagnosticos;

class DiagnosticoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Diagnosticos::select('tbl_diagnostico.id_diagnosticos',
         'tbl_patologias.nombre_patologia',
          'tbl_patologias.codigo_cie',
           'tbl_diagnostico.estado_de_salud',
            'tbl_diagnostico.fecha_diag')
        ->join('tbl_patologias', 'tbl_diagnostico.patologia_id', '=', 'tbl_patologias.patologia_id')->get();        
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
