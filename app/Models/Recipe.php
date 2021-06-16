<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_recipes
 * @property int $id_tipo_medicamento
 * @property string $indicaciones
 * @property string $fecha_expedicion
 * @property TblTipoMedicamento $tblTipoMedicamento
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
    protected $primaryKey = 'id_recipes';

    /**
     * @var array
     */
    protected $fillable = ['id_tipo_medicamento', 'indicaciones', 'fecha_expedicion'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tblTipoMedicamento()
    {
        return $this->belongsTo('App\TblTipoMedicamento', 'id_tipo_medicamento', 'id_tipo_medicamento');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tblRecipesTratamientos()
    {
        return $this->hasMany('App\TblRecipesTratamiento', 'id_recipes', 'id_recipes');
    }
}
