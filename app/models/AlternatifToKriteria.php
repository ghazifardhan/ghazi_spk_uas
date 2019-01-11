<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class AlternatifToKriteria extends Model {

    protected $table = 'alternatif_to_kriteria';
    
    protected $fillable = [
        'alternatif_id',
        'kriteria_id',
        'nilai',
    ];

    // public $validate = [
    //     'alternatif' => 'required',
    // ];

    // public $message = [
    //     'alternatif.required' => 'Alternatif is required',
    // ];

    public function alternatif() {
        return $this->hasOne(Alternatif::class, 'id', 'alternatif_id');
    }

    public function kriteria() {
        return $this->hasOne(Kriteria::class, 'id', 'kriteria_id');
    }
}