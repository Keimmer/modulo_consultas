<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_consulta
 * @property int $id_medico
 * @property int $id_especialidad
 * @property int $id_resultados_examen
 * @property string $fecha_consulta
 * @property Persona $persona
 * @property TblEspecialidad $tblEspecialidad
 * @property TblResultadosExamene $tblResultadosExamene
 * @property ProcedimientoMedicoXConsultum[] $procedimientoMedicoXConsultas
 * @property TblDiagnosticosConsultum[] $tblDiagnosticosConsultas
 * @property TblHabitosConsultum[] $tblHabitosConsultas
 * @property TblHistorium[] $tblHistorias
 * @property TblSintomasConsultum[] $tblSintomasConsultas
 */
class Consulta extends Model
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
    protected $fillable = ['id_medico', 'id_especialidad', 'id_resultados_examen', 'fecha_consulta'];

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
    public function tblHabitosConsultas()
    {
        return $this->hasMany('App\TblHabitosConsultum', 'id_consulta', 'id_consulta');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tblHistorias()
    {
        return $this->hasMany('App\TblHistorium', 'id_consulta', 'id_consulta');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tblSintomasConsultas()
    {
        return $this->hasMany('App\TblSintomasConsultum', 'id_consulta', 'id_consulta');
    }
}
