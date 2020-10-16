<?php

namespace App\Http\Controllers\feasibility;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\dev\Formula;
use App\pkp\tipp;
use App\pkp\pkp_project;
use App\Modelfn\feasibility;
use Redirect;

class ListFormulaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $wb = pkp_project::where('status_project','=','proses')->get();
        $formulas = formula::where('status_fisibility','!=','not_approved')->get();
        return view('feasibility.formula')->with([
            'formulas' => $formulas,
            'wb' => $wb
        ]);
    }

    public function sudah(){
        $formulas = Formula::where('status_fisibility','approved')->get();
        return view('feasibility.selesai')->with([
            'formulas' => $formulas
        ]);
    }
}