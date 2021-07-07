<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_mediacamentos_recipe
 * @property int $id_recipes
 * @property int $id_tipo_medicamento
 * @property string $indicaciones
 * @property TblRecipe $tblRecipe
 * @property TblMedicamento $tblMedicamento
 */
class MedicamentosXRecipe extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'tbl_mediacamentos_recipe';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_mediacamentos_recipe';

    /**
     * @var array
     */
    protected $fillable = ['id_recipes', 'id_tipo_medicamento', 'indicaciones'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tblRecipe()
    {
        return $this->belongsTo('App\TblRecipe', 'id_recipes', 'id_recipe');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tblMedicamento()
    {
        return $this->belongsTo('App\TblMedicamento', 'id_tipo_medicamento', 'id_tipo_medicamento');
    }
}
