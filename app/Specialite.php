<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialite extends Model
{
    public function medecin()
    {
        return $this->hasMany('App\Medecin');
    }
}
