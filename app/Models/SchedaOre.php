<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

/**
 * @property int    $created_at
 * @property int    $updated_at
 * @property Date   $data_odierna
 * @property int    $ore_unitarie
 * @property string $note
 */
class SchedaOre extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'schede_ore';

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
        'created_at', 'updated_at', 'data_odierna','ore_unitarie', 'note'
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
        'created_at' => 'timestamp', 'updated_at' => 'timestamp', 'data_odierna' => 'date', 'ore_unitarie' => 'int', 'note' => 'string'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at', 'data_odierna'
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
    public function progetto()
    {
        return $this->belongsTo('App\Models\Progetto');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}
