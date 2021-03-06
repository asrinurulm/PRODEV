<?php

namespace App\pkp;

use Illuminate\Database\Eloquent\Model;

class data_klaim extends Model
{
    protected $table = 'data_klaim';
    protected $primaryKey ='id';

    public function datakp(){
        return $this->hasOne('App\pkp\komponen','id','id_komponen');
    }

    public function datakl(){
        return $this->hasOne('App\pkp\klaim','id','id_klaim');
    }

    public function datadt(){
        return $this->hasOne('App\pkp\data_detail_klaim','id_klaim','id');
    }
}
