<?php

namespace App\Http\Controllers\formula;

use Illuminate\Http\Request;
use App\devnf\panel;
use App\devnf\hasilpanel;
use App\dev\Formula;
use App\Http\Controllers\Controller;
use Auth;
use Redirect;

class panelController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
        $this->middleware('rule:user_rd_proses' || 'rule:user_produk');
    }

    public function hasil(Request $request)
    {
        $add_panel = new hasilpanel;
        $add_panel->id_wb=$request->idf;
        $add_panel->id_formula=$request->wb;
        $add_panel->panel=$request->panel;
        $add_panel->tgl_panel=$request->date;
        $add_panel->hus=$request->hus;
        $add_panel->kesimpulan=$request->kesimpulan;
        $add_panel->save();

        return redirect()->back()->with('status', 'panel '.' Telah Ditambahkan!');
    }

    public function panel($formulas,$id){
        $myFormula = Formula::where('id',$id)->first();
        //dd($myFormula);
        $formula = Formula::where('id',$id)->first();
        $idfor = $formula->workbook_id;
        $fo=formula::where('id',$id)->first();
        $panel =panel::all();
        $pn = hasilpanel::where('id_formula',$id)->where('id_wb',$formulas)->get();
        $idf = $formula->id;
        $cek_panel =hasilpanel::where('id_formula',$id)->where('id_wb',$formulas)->count();
        return view('formula.panel')->with([
            'fo' => $fo,
            'myFormula' => $myFormula,
            'idf' => $idf,
            'id' => $id,
            'idfor' => $idfor,
            'pn' => $pn,
            'panel' => $panel,
            'cek_panel' => $cek_panel,
            'formula' => $formula
            ]);
    }

    public function hapuspanel($id){
        $panel = hasilpanel::where('id',$id)->delete();

        return redirect::back()->with('status', 'panel '.' Telah Dihapus!');
    }

    public function editpanel(Request $request,$id)
    {
        $add_panel = hasilpanel::where('id',$id)->first();
        $add_panel->id_formula=$request->idf;
        $add_panel->panel=$request->panel;
        $add_panel->tgl_panel=$request->date;
        $add_panel->formula=$request->formula;
        $add_panel->nilai=$request->nilai;
        $add_panel->hasil=$request->hasil;
        $add_panel->rata_rata=$request->rata;
        $add_panel->panelis=$request->panelis;
        $add_panel->serving=$request->panelis;
        $add_panel->hus=$request->hus;
        $add_panel->komentar=$request->komentar;
        $add_panel->kesimpulan=$request->kesimpulan;
        $add_panel->save();

        return redirect()->back()->with('status', 'panel '.' Telah Ditambahkan!');
    }

    public function ajukanpanel($id_formula){
        $formula = Formula::where('id',$id_formula)->first();
        $formula->status_panel='sent';
        $formula->save();

        return redirect()->back();
    }
}