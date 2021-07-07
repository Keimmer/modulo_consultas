<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_patologia
 * @property string $nombre_patologia
 * @property string $codigo_cie
 * @property TblDiagnostico[] $tblDiagnosticos
 */
class Patologia extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'tbl_patologias';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_patologia';

    /**
     * @var array
     */
    protected $fillable = ['nombre_patologia', 'codigo_cie'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tblDiagnosticos()
    {
        return $this->hasMany('App\TblDiagnostico', 'patologia_id', 'id_patologia');
    }
}
