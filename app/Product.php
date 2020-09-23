<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $fillable = ['titel','omschrijving','afbeelding','leerlingen','module_id','categorie_id'];
}
