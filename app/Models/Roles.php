<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_rol
 * @property string $nombre_rol
 * @property Persona[] $personas
 */
class Roles extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_rol';

    /**
     * @var array
     */
    protected $fillable = ['nombre_rol'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function personas()
    {
        return $this->hasMany('App\Persona', 'roles_id', 'id_rol');
    }
}
