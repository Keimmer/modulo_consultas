<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_diagnosticos_consulta
 * @property int $id_consulta
 * @property int $id_diagnostico
 * @property TblConsultum $tblConsultum
 * @property TblDiagnostico $tblDiagnostico
 */
class DiagnosticosXConsulta extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'tbl_diagnosticos_consulta';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_diagnosticos_consulta';

    /**
     * @var array
     */
    protected $fillable = ['id_consulta', 'id_diagnostico'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tblConsultum()
    {
        return $this->belongsTo('App\TblConsultum', 'id_consulta', 'id_consulta');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tblDiagnostico()
    {
        return $this->belongsTo('App\TblDiagnostico', 'id_diagnostico', 'id_diagnosticos');
    }
}
