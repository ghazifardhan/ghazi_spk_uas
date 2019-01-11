<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model {

    protected $table = 'alternatif';
    
    protected $fillable = [
        'alternatif',
    ];

    public $validate = [
        'alternatif' => 'required',
    ];

    public $message = [
        'alternatif.required' => 'Alternatif is required',
    ];

    public function altToKriteria() {
        return $this->hasMany(AlternatifToKriteria::class, 'alternatif_id', 'id');
    }
}