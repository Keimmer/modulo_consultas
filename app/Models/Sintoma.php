<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_sintoma
 * @property string $sintoma
 * @property TblSintomasConsultum[] $tblSintomasConsultas
 */
class Sintoma extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'tbl_sintomas';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_sintoma';

    /**
     * @var array
     */
    protected $fillable = ['sintoma'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tblSintomasConsultas()
    {
        return $this->hasMany('App\TblSintomasConsultum', 'id_sintoma', 'id_sintoma');
    }
}
