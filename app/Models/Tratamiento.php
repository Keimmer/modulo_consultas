<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_tratamientos
 * @property int $id_tipo_tratamiento
 * @property string $fecha_inicio
 * @property string $fecha_fin
 * @property TblTipoTratamiento $tblTipoTratamiento
 * @property TblRecipesTratamiento[] $tblRecipesTratamientos
 * @property TblTratamientoDiagnostico[] $tblTratamientoDiagnosticos
 */
class Tratamiento extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'tbl_tratamiento';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_tratamientos';

    /**
     * @var array
     */
    protected $fillable = ['id_tipo_tratamiento', 'fecha_inicio', 'fecha_fin'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tblTipoTratamiento()
    {
        return $this->belongsTo('App\TblTipoTratamiento', 'id_tipo_tratamiento', 'id_tipo_tratamiento');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tblRecipesTratamientos()
    {
        return $this->hasMany('App\TblRecipesTratamiento', 'id_tratamientos', 'id_tratamientos');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tblTratamientoDiagnosticos()
    {
        return $this->hasMany('App\TblTratamientoDiagnostico', 'id_tratamientos', 'id_tratamientos');
    }
}
