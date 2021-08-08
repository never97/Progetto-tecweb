<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int  $created_at
 * @property int  $updated_at
 * @property Date $data_assegnazione
 */
class Assegnazione extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'assegnazioni';

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
        'created_at', 'updated_at', 'data_assegnazione', 'user_id', 'progetto_id'
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
        'created_at' => 'timestamp', 'updated_at' => 'timestamp', 'data_assegnazione' => 'date'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at', 'data_assegnazione'
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
}
