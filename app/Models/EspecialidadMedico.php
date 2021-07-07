<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_esp_med
 * @property int $id_medico
 * @property int $id_especialidad
 * @property Persona $persona
 * @property TblEspecialidad $tblEspecialidad
 */
class EspecialidadMedico extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'tbl_especialidad_medicos';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_esp_med';

    /**
     * @var array
     */
    protected $fillable = ['id_medico', 'id_especialidad'];

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
}
