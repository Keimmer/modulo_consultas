<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_habito
 * @property string $habito
 * @property TblHabitosConsultum[] $tblHabitosConsultas
 */
class Habito extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'tbl_habitos';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_habito';

    /**
     * @var array
     */
    protected $fillable = ['habito'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tblHabitosConsultas()
    {
        return $this->hasMany('App\TblHabitosConsultum', 'id_habito', 'id_habito');
    }
}
