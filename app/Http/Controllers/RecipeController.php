<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicamentosXRecipe;
use App\Models\Recipe;
use App\Models\RecipeXTratamiento;
use App\Models\Medicamento;
use Illuminate\Support\Facades\Log;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->id_recipe) {
            return MedicamentosXRecipe::select(
                'tbl_medicamentos.medicamento', 
                'tbl_medicamentos.tipo_medicamento', 
                'tbl_mediacamentos_recipe.indicaciones'
                )
                ->join('tbl_medicamentos', 'tbl_mediacamentos_recipe.id_tipo_medicamento', '=', 'tbl_medicamentos.id_tipo_medicamento')
                ->where('id_recipes', '=', $request->id_recipe)->get();
        }

        return RecipeXTratamiento::select(
            'tbl_recipes_tratamiento.id_tratamientos',
            'tbl_recipe.id_recipe',
            'tbl_recipe.fecha_expedicion',
            RecipeXTratamiento::raw('count(tbl_mediacamentos_recipe.id_recipes) as medicamentos'))
            ->join('tbl_recipe', 'tbl_recipes_tratamiento.id_recipe', '=', 'tbl_recipe.id_recipe')
            ->join('tbl_mediacamentos_recipe', 'tbl_recipes_tratamiento.id_recipe', '=', 'tbl_mediacamentos_recipe.id_recipes')
            ->where('tbl_recipes_tratamiento.id_tratamientos', '=', $request->id_tratamiento)
            ->groupBy('id_recipe')
            ->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Medicamento $medicamentotb)
    {
        //

        if ($request->edit) {
            foreach ($request->medicamentosInd as $medicamento) {
                Log::info($medicamento);
                $id_medicamento = $medicamentotb::where('medicamento', 'LIKE', '%' . $medicamento['value'] . '%')->first()->id_tipo_medicamento;
    
    
                $resultPxC = MedicamentosXRecipe::insert([
                    'id_recipes' => $request->id_recipe,
                    'id_tipo_medicamento' => $id_medicamento,
                    'indicaciones' => $medicamento['indicaciones']
                ]);
            }
            return;
        }

        Log::info($request);
        $lastid_recipe = Recipe::insertGetId([
            'fecha_expedicion' => Recipe::raw('CURDATE()')
        ]);

        RecipeXTratamiento::insert([
            'id_tratamientos' => $request->id_tratamiento,
            'id_recipe' => $lastid_recipe
        ]);

        foreach ($request->medicamentosInd as $medicamento) {
            Log::info($medicamento);
            $id_medicamento = $medicamentotb::where('medicamento', 'LIKE', '%' . $medicamento['value'] . '%')->first()->id_tipo_medicamento;


            $resultPxC = MedicamentosXRecipe::insert([
                'id_recipes' => $lastid_recipe,
                'id_tipo_medicamento' => $id_medicamento,
                'indicaciones' => $medicamento['indicaciones']
            ]);
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
