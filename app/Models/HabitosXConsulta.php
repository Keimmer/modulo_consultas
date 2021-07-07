<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_habitos_consulta
 * @property int $id_consulta
 * @property int $id_habito
 * @property TblConsultum $tblConsultum
 * @property TblHabito $tblHabito
 */
class HabitosXConsulta extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'tbl_habitos_consulta';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_habitos_consulta';

    /**
     * @var array
     */
    protected $fillable = ['id_consulta', 'id_habito'];

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
    public function tblHabito()
    {
        return $this->belongsTo('App\TblHabito', 'id_habito', 'id_habito');
    }
}
