<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_procedimiento
 * @property int $id_procesos
 * @property string $resultado
 * @property TblProceso $tblProceso
 * @property ProcedimientoMedicoXConsultum[] $procedimientoMedicoXConsultas
 */
class Procedimiento extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'tbl_procedimiento';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_procedimiento';

    /**
     * @var array
     */
    protected $fillable = ['id_procesos', 'resultado'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tblProceso()
    {
        return $this->belongsTo('App\TblProceso', 'id_procesos', 'id_procesos');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function procedimientoMedicoXConsultas()
    {
        return $this->hasMany('App\ProcedimientoMedicoXConsultum', 'id_procedimiento', 'id_procedimiento');
    }
}
