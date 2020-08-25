<?php

namespace App\Http\Controllers\pv;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

use Auth;
use Redirect;
use DB;

use App\dev\formula;
use App\pkp\pkp_project;
use App\pkp\tipp;
use App\modelfn\finance;

class pengajuansampleController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:pv_lokal');
    }

    public function ajukanfs($id_project,$for){
        $pkp = pkp_project::where('id_project',$id_project)->first();
        $pkp->pengajuan_sample='approve';
        $pkp->save();

        $sample = formula::where('id',$for)->first();
        $sample->status_fisibility='proses';
        $sample->vv='approve';
        $sample->save();

        $data = tipp::where('id_pkp',$id_project)->where('status_data','=','active')->first();
        $fs = new finance;
        $fs->id_formula=$data->id_pkp;
        $fs->save();

        return redirect::back();
    }

    public function tidakajukanfs($id_project,$for){
        $pkp = pkp_project::where('id_project',$id_project)->first();
        $pkp->pengajuan_sample='approve';
        $pkp->save();

        $sample = formula::where('id',$for)->first();
        $sample->status_fisibility='not_approved';
        $sample->vv='approve';
        $sample->save();

        return redirect::back();
    }

    public function unfinalsample($for){
        $pkp = formula::where('id',$for)->first();
        $pkp->vv='approve';
        $pkp->save();

        return redirect::back();
    }

    public function finalsample($id_sample){
        $pkp = formula::where('id',$id_sample)->first();
        $pkp->vv='final';
        $pkp->save();

        return redirect::back();
    }

    public function rejectsample(Request $request,$id_sample){
        $for = formula::where('id',$id_sample)->first();
        $for->vv='reject';
        $for->catatan_pv=$request->note;
        $for->save();

        return redirect::back();
    }

    public function approvefs($id_sample){
        $for = formula::where('id',$id_sample)->first();
        $for->status_fisibility='approve';
        $for->save();

        $fs = feasibility::where('id_formula',$id_project)->first();
        $fs->status_feasibility='approve';
        $fs->save();

        return redirect::back();
    }
}
