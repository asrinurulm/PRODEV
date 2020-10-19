<?php

namespace App\Http\Controllers\feasibility;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modelfn\finance;
use App\Modelfn\pesan;
use App\dev\Formula;
use App\pkp\tipp;
use App\pkp\pkp_project;
use Redirect;

class ListFeasibilityController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index($wb){
        $workbook = formula::where('id',$wb)->first();
        $myFormula = tipp::where('id_pkp',$workbook->workbook_id)->first();
        $dataF = finance::where('id_wb',$workbook->workbook_id)->where('id_formula',$wb)->get();
        $dF = finance::where('id_wb',$workbook->workbook_id)->where('id_formula',$wb)->first();
        return view('feasibility.feasibility')->with([
            'myFormula' => $myFormula,
            'wb' => $wb,
            'for' => $dF,
            'dataF' => $dataF
        ]);
    }

    public function deletefs ($id){
        $fs = finance::find($id);
        $fs->delete();
        return redirect::back()->with('message', 'Data berhasil dihapus!');
    }

    public function kirimWB(Request $request,$id,$id_feasibility)
    {
        $change_status  = finance::where('kemungkinan',$request->get('dropdown'))->first();
            $change_status->status_feasibility='selesai';
            $change_status->save();

        $status  = formula::where('id',$id)->first();
            $status->status_fisibility='approved';
            $status->save();

        return redirect()->route('formula.feasibility');
    }
}
