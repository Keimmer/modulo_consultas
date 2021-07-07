<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_esp_trat
 * @property int $id_tipo_tratamiento
 * @property int $id_especialidad
 * @property TblTipoTratamiento $tblTipoTratamiento
 * @property TblEspecialidad $tblEspecialidad
 */
class EspecialidadTratamiento extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'tbl_especialidad_tratamientos';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_esp_trat';

    /**
     * @var array
     */
    protected $fillable = ['id_tipo_tratamiento', 'id_especialidad'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tblTipoTratamiento()
    {
        return $this->belongsTo('App\TblTipoTratamiento', 'id_tipo_tratamiento', 'id_tipo_tratamiento');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tblEspecialidad()
    {
        return $this->belongsTo('App\TblEspecialidad', 'id_especialidad', 'id_especialidad');
    }
}
