<?php

namespace App\devnf;

use Illuminate\Database\Eloquent\Model;

class hasilpanel extends Model
{
    protected $table = "hasil_panel";
    protected $primaryKey ='id';
    protected $fillable =['panel','HUS','tgl_panel','hasil'];
}
