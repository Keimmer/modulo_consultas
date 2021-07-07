<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_recipes_tratamiento
 * @property int $id_tratamientos
 * @property int $id_recipe
 * @property TblRecipe $tblRecipe
 * @property TblTratamiento $tblTratamiento
 */
class RecipeXTratamiento extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'tbl_recipes_tratamiento';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_recipes_tratamiento';

    /**
     * @var array
     */
    protected $fillable = ['id_tratamientos', 'id_recipe'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tblRecipe()
    {
        return $this->belongsTo('App\TblRecipe', 'id_recipe', 'id_recipe');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tblTratamiento()
    {
        return $this->belongsTo('App\TblTratamiento', 'id_tratamientos', 'id_tratamientos');
    }
}
