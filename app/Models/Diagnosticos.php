<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_diagnosticos
 * @property int $patologias_id
 * @property string $estado_de_salud
 * @property string $fecha_diag
 * @property TblPatologia $tblPatologia
 * @property TblDiagnosticosConsultum[] $tblDiagnosticosConsultas
 * @property TblTratamientoDiagnostico[] $tblTratamientoDiagnosticos
 */
class Diagnosticos extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'tbl_diagnostico';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_diagnosticos';

    /**
     * @var array
     */
    protected $fillable = ['patologia_id', 'estado_de_salud', 'fecha_diag'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tblPatologia()
    {
        return $this->belongsTo('App\TblPatologia', 'patologia_id', 'id_patologias');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tblDiagnosticosConsultas()
    {
        return $this->hasMany('App\TblDiagnosticosConsultum', 'id_diagnosticos', 'id_diagnosticos');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tblTratamientoDiagnosticos()
    {
        return $this->hasMany('App\TblTratamientoDiagnostico', 'id_diagnosticos', 'id_diagnosticos');
    }
}
