<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_tratamiento_diagnostico
 * @property int $id_tratamientos
 * @property int $id_diagnosticos
 * @property TblDiagnostico $tblDiagnostico
 * @property TblTratamiento $tblTratamiento
 */
class TratamientosXDiagnostico extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'tbl_tratamiento_diagnostico';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_tratamiento_diagnostico';

    /**
     * @var array
     */
    protected $fillable = ['id_tratamientos', 'id_diagnosticos'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tblDiagnostico()
    {
        return $this->belongsTo('App\TblDiagnostico', 'id_diagnosticos', 'id_diagnosticos');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tblTratamiento()
    {
        return $this->belongsTo('App\TblTratamiento', 'id_tratamientos', 'id_tratamientos');
    }
}
