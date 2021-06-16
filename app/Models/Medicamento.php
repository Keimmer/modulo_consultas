<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_tipo_medicamento
 * @property string $medicamento
 * @property string $tipo_medicamento
 * @property TblMediacamentosRecipe[] $tblMediacamentosRecipes
 */
class Medicamento extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'tbl_medicamentos';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_tipo_medicamento';

    /**
     * @var array
     */
    protected $fillable = ['medicamento', 'tipo_medicamento'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tblMediacamentosRecipes()
    {
        return $this->hasMany('App\TblMediacamentosRecipe', 'id_tipo_medicamento', 'id_tipo_medicamento');
    }
}
