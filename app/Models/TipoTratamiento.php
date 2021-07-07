<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_tipo_tratamiento
 * @property string $tipo_tratamiento
 * @property TblEspecialidadTratamiento[] $tblEspecialidadTratamientos
 * @property TblTratamiento[] $tblTratamientos
 */
class TipoTratamiento extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'tbl_tipo_tratamiento';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_tipo_tratamiento';

    /**
     * @var array
     */
    protected $fillable = ['tipo_tratamiento'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tblEspecialidadTratamientos()
    {
        return $this->hasMany('App\TblEspecialidadTratamiento', 'id_tipo_tratamiento', 'id_tipo_tratamiento');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tblTratamientos()
    {
        return $this->hasMany('App\TblTratamiento', 'id_tipo_tratamiento', 'id_tipo_tratamiento');
    }
}
