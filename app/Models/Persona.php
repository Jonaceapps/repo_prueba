<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    protected $hidden = ['padre', 'madre','domicilio_id', 'updated_at', 'created_at'];
    public function domicilio(){
        return $this -> belongsTo(Domicilio::class);
    }
}
