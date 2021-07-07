<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_recipe
 * @property string $fecha_expedicion
 * @property TblMediacamentosRecipe[] $tblMediacamentosRecipes
 * @property TblRecipesTratamiento[] $tblRecipesTratamientos
 */
class Recipe extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'tbl_recipe';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_recipe';

    /**
     * @var array
     */
    protected $fillable = ['fecha_expedicion'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tblMediacamentosRecipes()
    {
        return $this->hasMany('App\TblMediacamentosRecipe', 'id_recipes', 'id_recipe');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tblRecipesTratamientos()
    {
        return $this->hasMany('App\TblRecipesTratamiento', 'id_recipe', 'id_recipe');
    }
}
