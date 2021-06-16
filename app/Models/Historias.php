<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_historia
 * @property int $id_paciente
 * @property int $id_medico
 * @property int $id_tipo_motivo
 * @property int $id_motivo
 * @property Persona $persona
 * @property Persona $persona
 * @property TblConsultum $tblConsultum
 * @property TblTipoMotivo $tblTipoMotivo
 */
class Historias extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'tbl_historia';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_historia';

    /**
     * @var array
     */
    protected $fillable = ['id_paciente', 'id_medico', 'id_tipo_motivo', 'id_motivo'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function persona()
    {
        return $this->belongsTo('App\Persona', 'id_paciente', 'id_persona');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tblConsultum()
    {
        return $this->belongsTo('App\TblConsultum', 'id_motivo', 'id_consulta');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tblTipoMotivo()
    {
        return $this->belongsTo('App\TblTipoMotivo', 'id_tipo_motivo', 'id_tipo_motivo');
    }
}
