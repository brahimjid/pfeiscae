<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Planning extends Model
{
    public $timestamps = false;

    public function medecin()
    {
        return  $this->belongsTo('App\Medecin','idMedecin');

    }
}
