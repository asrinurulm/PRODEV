<?php

namespace App\pkp;

use Illuminate\Database\Eloquent\Model;

class project_pdf extends Model
{
    protected $table = 'pdf_project';
    protected $primaryKey ='id_project_pdf';

    public function departement(){
        return $this->hasOne('App\users\Departement','id','tujuankirim');
    }

    public function departement2(){
        return $this->hasOne('App\users\Departement','id','tujuankirim2');
    }

    public function datappdf(){
        return $this->hasOne('App\pkp\coba','pdf_id','id_project_pdf');
    }
    public function nott(){
        return $this->hasOne('App\pkp\notulen','id_pdf','id_project_pdf');
    }

    public function users(){
        return $this->hasOne('App\User','id','userpenerima');
    }

    public function author1(){
        return $this->hasOne('App\User','id','author');
    }

    public function perevisi1(){
        return $this->hasOne('App\User','id','perevisi');
    }

    public function users2(){
        return $this->hasOne('App\User','id','userpenerima2');
    }

    public function type(){
        return $this->belongsTo('App\pkp\pkp_type','id_type','id');
    }

    public function for1(){
        return $this->hasOne('App\pkp\data_forecast','id_pdf','id_project_pdf');
    }
}