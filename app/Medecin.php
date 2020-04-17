<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Medecin extends Authenticatable
{
    use Notifiable;
    protected $guard = "medecin";
    public $timestamps =false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom', 'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];
    public function specialte()
    {
        return $this->belongsTo('App\Specialite','idSpecialite');
    }

    public function planning()
    {
        return  $this->belongsTo('App\Medecin');
    }

}

