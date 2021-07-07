<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_procedimiento
 * @property int $id_consulta
 * @property int $id_procesos
 * @property string $resultado
 * @property TblProceso $tblProceso
 * @property TblConsultum $tblConsultum
 */
class ProcedimientoXConsulta extends Model
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
    protected $fillable = ['id_consulta', 'id_procesos', 'resultado'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tblProceso()
    {
        return $this->belongsTo('App\TblProceso', 'id_procesos', 'id_procesos');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tblConsultum()
    {
        return $this->belongsTo('App\TblConsultum', 'id_consulta', 'id_consulta');
    }
}
