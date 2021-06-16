<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_consulta
 * @property int $id_medico
 * @property int $id_especialidad
 * @property int $id_resultados_examen
 * @property string $fecha_consulta
 * @property string $sintomas
 * @property string $habitos
 * @property string $alergias
 * @property string $estado
 * @property Persona $persona
 * @property TblEspecialidad $tblEspecialidad
 * @property TblResultadosExamene $tblResultadosExamene
 * @property ProcedimientoMedicoXConsultum[] $procedimientoMedicoXConsultas
 * @property TblDiagnosticosConsultum[] $tblDiagnosticosConsultas
 * @property TblHistorium[] $tblHistorias
 */
class Consultas extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'tbl_consulta';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_consulta';

    /**
     * @var array
     */
    protected $fillable = ['id_medico', 'id_especialidad', 'id_resultados_examen', 'fecha_consulta', 'sintomas', 'habitos', 'alergias', 'estado'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function persona()
    {
        return $this->belongsTo('App\Persona', 'id_medico', 'id_persona');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tblEspecialidad()
    {
        return $this->belongsTo('App\TblEspecialidad', 'id_especialidad', 'id_especialidad');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tblResultadosExamene()
    {
        return $this->belongsTo('App\TblResultadosExamene', 'id_resultados_examen', 'id_resultados_examen');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function procedimientoMedicoXConsultas()
    {
        return $this->hasMany('App\ProcedimientoMedicoXConsultum', 'id_consulta', 'id_consulta');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tblDiagnosticosConsultas()
    {
        return $this->hasMany('App\TblDiagnosticosConsultum', 'id_consulta', 'id_consulta');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tblHistorias()
    {
        return $this->hasMany('App\TblHistorium', 'id_motivo', 'id_consulta');
    }
}
