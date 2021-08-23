<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

/**
 * @property int    $created_at
 * @property int    $updated_at
 * @property int    $data_fine_effettiva
 * @property string $nome
 * @property string $descrizione
 * @property string $note
 * @property Date   $data_inizio_prevista
 * @property Date   $data_fine_prevista
 * @property float  $costo_orario
 */
class Progetto extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'progetti';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'created_at', 'updated_at','nome', 'descrizione', 'note', 'data_inizio_prevista', 'data_fine_prevista', 'data_fine_effettiva', 'costo_orario',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'timestamp', 'updated_at' => 'timestamp','nome' => 'string', 'descrizione' => 'string', 'note' => 'string', 'data_inizio_prevista' => 'date', 'data_fine_prevista' => 'date', 'data_fine_effettiva' => 'date', 'costo_orario' => 'double'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at', 'data_inizio_prevista', 'data_fine_prevista'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = false;

    // Scopes...

    // Functions ...

    // Relations ...

    public function cliente()
    {
        return $this->belongsTo('App\Models\Cliente');
    }
    public function schedaore()
    {
        return $this->hasMany('App\Models\SchedaOre');
    }
    public function assegnazione()
    {
        return $this->hasMany('App\Models\Assegnazione');
    }

}
