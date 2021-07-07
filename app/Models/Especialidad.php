<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_especialidad
 * @property string $nombre_especialidad
 * @property TblConsultum[] $tblConsultas
 */
class Especialidad extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'tbl_especialidad';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_especialidad';

    /**
     * @var array
     */
    protected $fillable = ['nombre_especialidad'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tblConsultas()
    {
        return $this->hasMany('App\TblConsultum', 'id_especialidad', 'id_especialidad');
    }
}
