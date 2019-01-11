<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model {

    protected $table = 'kriteria';
    
    protected $fillable = [
        'kriteria',
        'bobot',
        'atribut'
    ];

    public $validate = [
        'kriteria' => 'required',
        'bobot' => 'required',
        'atribut' => 'required',
    ];

    public $message = [
        'kriteria.required' => 'Kriteria is required',
        'bobot.required' => 'Bobot is required',
        'atribut.required' => 'Atribut is required',
    ];
}