<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_procesos
 * @property string $proceso
 * @property string $descripcion
 * @property TblProcedimiento[] $tblProcedimientos
 */
class Procesos extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'tbl_procesos';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_procesos';

    /**
     * @var array
     */
    protected $fillable = ['proceso', 'descripcion'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tblProcedimientos()
    {
        return $this->hasMany('App\TblProcedimiento', 'id_procesos', 'id_procesos');
    }
}
