<?php

namespace App\dev;

use Illuminate\Database\Eloquent\Model;

class Fortail extends Model
{
    protected $table = 'fortails';

    public function Formula(){
        return $this->belongsTo('App\dev\Formula');
    }

    public function Premix(){
        return $this->hasMany('App\dev\Premix');
    }

    public function Bahan(){return $this->belongsTo('App\dev\Bahan','nama_sederhana','id');}
    public function alternatif1(){return $this->belongsTo('App\dev\Bahan','alternatif','id');}
    public function alternatifke2(){return $this->belongsTo('App\dev\Bahan','alternatif2','id');}
    public function alternatifke3(){return $this->belongsTo('App\dev\Bahan','alternatif3','id');}
    public function alternatifke4(){return $this->belongsTo('App\dev\Bahan','alternatif4','id');}
    public function alternatifke5(){return $this->belongsTo('App\dev\Bahan','alternatif5','id');}
    public function alternatifke6(){return $this->belongsTo('App\dev\Bahan','alternatif6','id');}
    public function alternatifke7(){return $this->belongsTo('App\dev\Bahan','alternatif7','id');}

    // Alternatif relationship

    public function k2(){
        return $this->belongsTo('App\dev\Fortail','kode_komputer2','id');
    }

    public function k3(){
        return $this->belongsTo('App\dev\Fortail','kode_komputer3','id');
    }

    public function k4(){
        return $this->belongsTo('App\dev\Fortail','kode_komputer4','id');
    }

    public function k5(){
        return $this->belongsTo('App\dev\Fortail','kode_komputer5','id');
    }

    protected $fillable = [
        'formula_id',
        'kode_komputer',
        'nama_sederhana',
        'kode_oracle',
        'bahan_id',
        'nama_bahan',
        'per_batch',
        'per_serving',
        'jenis_timbangan',
        'alternatif',
        'kode_komputer2',
        'kode_komputer3',
        'kode_komputer4',
        'kode_komputer5',
        'granulasi',
    ];



}
