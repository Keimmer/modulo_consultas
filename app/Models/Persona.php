<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id_persona
 * @property int $roles_id
 * @property string $nombre
 * @property string $apellido
 * @property int $cedula
 * @property string $direccion
 * @property string $telefono
 * @property Role $role
 * @property AntecedentesPersonale[] $antecedentesPersonales
 * @property Cita[] $citas
 * @property TblConsultum[] $tblConsultas
 * @property TblHistorium[] $tblHistorias
 * @property TblHistorium[] $tblHistorias
 * @property TblResultadosExamene[] $tblResultadosExamenes
 */
class Persona extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'persona';

    /**
     * The primary key for the model.
     * 
     * @var string
     */

    protected $primaryKey = 'id_persona';

    /**
     * @var array
     */

    use HasFactory;

    protected $fillable = ['nombre', 'apellido', 'cedula', 'direccion', 'telefono'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo('App\Role', 'roles_id', 'id_rol');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function antecedentesPersonales()
    {
        return $this->hasMany('App\AntecedentesPersonale', 'persona_id_persona', 'id_persona');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function citas()
    {
        return $this->hasMany('App\Cita', 'id_persona', 'id_persona');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tblConsultas()
    {
        return $this->hasMany('App\TblConsultum', 'id_medico', 'id_persona');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tblHistorias()
    {
        return $this->hasMany('App\Models\Historias', 'id_paciente', 'id_persona');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
/*     public function tblHistorias()
    {
        return $this->hasMany('App\Models\Historias', 'id_medico', 'id_persona');
    } */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tblResultadosExamenes()
    {
        return $this->hasMany('App\TblResultadosExamene', 'id_paciente', 'id_persona');
    }
}
