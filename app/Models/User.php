<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role',
        'email',
        'password',
        'nome',
        'cognome'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email' => 'string',
        'email_verified_at' => 'datetime',

        'nome' => 'string',
        'cognome' => 'string',
        'created_at' => 'timestamp', 'updated_at' => 'timestamp',

        'is_admin' => 'boolean'
    ];

    public function isAdmin()
    {
        return $this->is_admin;
    }
    public function schedaore()
    {
        return $this->hasMany('App\Models\SchedaOre');
    }
    public function assegnazione()
    {
        return $this->hasMany('App\Models\Assegnazione');
    }

    public function progetti() {
        return $this->belongsToMany("App\Models\Progetto", "assegnazioni", "user_id", "progetto_id");
    }
}
