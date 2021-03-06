<?php

namespace App\Http\Controllers\kemas;

use Illuminate\Http\Request;
use App\Http\Requests\CsvImportRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Excel;
use App\Imports\Import;
use App\Imports\KemasImport;
use App\Modelkemas\userkemas;
use App\Modelkemas\konsep;
use App\dev\Formula;
use App\Modelfn\finance;
use App\pkp\tipp;

class KemasController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
		$this->middleware('rule:kemas');
	}

	public function index(Request $request,$id, $id_feasibility)
	{
		$formulas = tipp::where('id_pkp',$id)->where('status_data','=','active')->get();
		$request->session()->get('id_feasibility');
		$request->session()->put('id_feasibility', $id_feasibility);
		$fe=finance::find($id_feasibility);
		$kemas =userkemas::where('id_feasibility', $id_feasibility)->get();
		$konsep = konsep::where('id_feasibility', $id_feasibility)->get();
		$dataF = finance::where('id_feasibility', $id_feasibility)->get();
		return view('kemas.uploadkemas', compact('toImport'))
			->with([
				'formulas' => $formulas,
				'dataF' => $dataF,
				'kemas' => $kemas,
				'id' => $id,
				'konsep' => $konsep,
				'fe'=>$fe,
				'id_feasibility' => $id_feasibility
			]);
	}

	public function storeData(Request $request, $id_feasibility)
    {
		$id = $request->session()->get('id_feasibility');
		//VALIDASI
		$this->validate($request, [
			'file' => 'required|mimes:csv,txt',
			'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
		]);

		if ($request->hasFile('file')) {
			$file = $request->file('file');
			$data = new userkemas;
            $data->id_feasibility=$request->finance;
             //GET FILE
            Excel::import(new KemasImport, $file, $data);
            $lastkemas = DB::table('fs_formula_kemas')->max('id_fk');
            $hapus = userkemas::where('id_feasibility',$id)->delete();
            $changekemas = userkemas::where('id_feasibility', '0')->update(['id_feasibility'=>$id]);
            // $changekemas->save();
			$change_status  = finance::where('id_feasibility',$id_feasibility)->first();
			$change_status->status_kemas='sending';
			$change_status->save();

            return redirect()->back()->with(['success' => 'Upload success']);
        }
        return redirect()->back()->with(['error' => 'Please choose file before']);
    }
}