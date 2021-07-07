<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_sintomas_consulta
 * @property int $id_consulta
 * @property int $id_sintoma
 * @property TblConsultum $tblConsultum
 * @property TblSintoma $tblSintoma
 */
class SintomXConsulta extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'tbl_sintomas_consulta';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_sintomas_consulta';

    /**
     * @var array
     */
    protected $fillable = ['id_consulta', 'id_sintoma'];

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
    public function tblSintoma()
    {
        return $this->belongsTo('App\TblSintoma', 'id_sintoma', 'id_sintoma');
    }
}
