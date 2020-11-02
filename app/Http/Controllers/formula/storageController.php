<?php

namespace App\Http\Controllers\formula;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\devnf\storage;
use App\devnf\panel;
use App\devnf\hasilpanel;
use App\dev\Formula;
use auth;
use redirect;

class storageController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
        $this->middleware('rule:user_rd_proses' || 'rule:user_produk');
    }

    public function st($formulas,$id){
        $formula = Formula::where('id',$id)->first();;
        $fo=formula::where('id',$id)->first();;
        $panel =panel::all();
        $idfor = $formula->workbook_id;
        $pn = hasilpanel::all();
        $idf = $formula->id;
        $storage = storage::where('id_formula',$id)->where('id_wb',$formulas)->get();
        $cek_storage =storage::where('id_formula',$id)->where('id_wb',$formulas)->count();
        return view('formula.storage')->with([
            'fo' => $fo,
            'idf' => $idf,
            'id' => $id,
            'idfor' => $idfor,
            'pn' => $pn,
            'storage' => $storage,
            'panel' => $panel,
            'formula' => $formula,
            'cek_storage' =>$cek_storage
        ]);
    }

    public function hasilnya(Request $request)
    {
        $this->validate($request, [
			'filename' => 'required',
        ]);

        $file = $request->file('filename');
        $nama = $file->getClientOriginalName();
        
        $add_st = new storage;
        $add_st->id_formula=$request->wb;
        $add_st->id_wb=$request->idf;
        $add_st->no_PST=$request->spt;
        $add_st->suhu=$request->suhu;
        $add_st->estimasi_selesai=$request->estimasi;
        $add_st->data_file=$nama;
        $add_st->save();

        $tujuan_upload = 'data_file';
    	$file->move($tujuan_upload,$file->getClientOriginalName());
    
        return redirect()->back();
    }

    public function proses(Request $request)
    {
        $add_proses= new hasilstorage;
        $add_proses->id_formula=$request->idf;
        $add_proses->id_storage=$request->storage;
        $add_proses->tgl_input=$request->input;
        $add_proses->proses=$request->progres;
        $add_proses->save();

        return redirect()->back()->with('status','proses storage'.' Telah ditambahkan! ');
    }

    public function editdata(request $request, $id)
    {
        $data_storage= storage::where('id',$id)->first();
        $data_storage->no_HSA=$request->hsa;
        $data_storage->keterangan=$request->kesimpulan;
        $data_storage->save();

        return redirect()->back();
    }

    public function delete($id){
        $storage = storage::where('id',$id)->delete();

        return redirect()->back()->with('status','proses storage'.' Telah Dihapus! ');
    }

    public function ajukanstorage($id_formula){
        $formula = Formula::where('id',$id_formula)->first();
        $formula->status_storage='sent';
        $formula->save();

        return redirect()->back();
    }
}