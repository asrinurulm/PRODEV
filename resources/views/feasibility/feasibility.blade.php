@extends('feasibility.tempfeasibility')
@section('title', 'feasibility')
@section('judulnya', 'List Feasibility')
@section('content')

@if (session('status'))
<div class="row">
  <div class="col-md-12">
    <div class="alert alert-success" style="margin:20px">
      <button type="button" class="close" data-dismiss="alert">×</button>
      {{ session('status') }}
    </div>
  </div>
</div>
@endif

<div class="x_panel">
  <div class="x_title">
    <h3><li class="fa fa-list"> List Feasibility</li></h3>
  </div>
    <div class="row">
			<div class="col-md-5">
				<table>
					<tr><th width="15%">Nama Produk </th><th width="45%">: {{ $myFormula->datapkpp->project_name}}</th>
					<tr><th width="15%">Tanggal Terima</th><th width="45%">: {{ $myFormula->updated_at }}</th>
					<tr><th width="15%">No.PKP</th><th width="45%">: {{ $myFormula->datapkpp->pkp_number }}{{$myFormula->datapkpp->ket_no}}</th>
					<tr><th width="15%">Idea</th><th width="45%">: {{ $myFormula->idea }}</th></tr>
				</table>
			</div>
			<div class="col-md-5">
				<table>
					<tr><th width="15%">Brand </th><th width="45%">: {{ $myFormula->datapkpp->id_brand}}</th>
					<tr><th width="15%">Packaging Concept</th><th width="45%">: 
						@if($myFormula->kemas_eksis!=NULL)
            
							@if($myFormula->kemas->tersier!=NULL)
							{{ $myFormula->kemas->tersier }}{{ $myFormula->kemas->s_tersier }}
							@elseif($myFormula->tersier==NULL)
							@endif

							@if($myFormula->kemas->sekunder1!=NULL)
							X {{ $myFormula->kemas->sekunder1 }}{{ $myFormula->kemas->s_sekunder1}}
							@elseif($myFormula->kemas->sekunder1==NULL)
							@endif

							@if($myFormula->kemas->sekunder2!=NULL)
							X {{ $myFormula->kemas->sekunder2 }}{{ $myFormula->kemas->s_sekunder2 }}
							@elseif($myFormula->sekunder2==NULL)
							@endif

							@if($myFormula->kemas->primer!=NULL)
							X{{ $myFormula->kemas->primer }}{{ $myFormula->kemas->s_primer }}
							@elseif($myFormula->kemas->primer==NULL)
							@endif
            
            @elseif($myFormula->primer==NULL)
            @endif
					</th>
					<tr><th width="15%">Target konsumen</th><th width="45%">: {{ $myFormula->tarkon->tarkon }}</th>
					<tr><th width="15%">Formula</th><th width="45%">: </th></tr>
				</table>
			</div>
			<div class="col-md-2">
				<table>
					<tr><th>
					<a class="btn btn-success btn-sm fa fa-plus" data-toggle="tooltip" data-placement="top" title="tambah Data" href="{{ route('upFeasibility',$for->id_formula) }}"> Add Option</a>
        <a class="btn btn-danger btn-sm fa fa-sign-out" data-toggle="tooltip" data-placement="top" title="Kemabali" href="{{ route('rekappkp',$myFormula->id_pkp) }}"> Kembali</a></th></tr>
				</table>
			</div>
		</div><hr>
    <div class="" role="tabpanel" data-example-id="togglable-tabs">
        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
          <li role="presentation" class="active"><a href="#tab_content6" id="profile-tab" role="tab" data-toggle="tab" aria-expanded="true">List</a></li>
          <li role="presentation" class=""><a href="#tab_content7" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Penyusunan</a></li>
        </ul>
        <div id="myTabContent" class="tab-content">

          <!-- Mesin dan SDM -->
          <div role="tabpanel" class="tab-pane fade active in" id="tab_content6" aria-labelledby="profile-tab">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="dt-responsive table-responsive"><br>
                  <table id="multi-colum-dt" class="Table table-striped table-bordered nowrap">
                    <thead>
                      <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                        <th class="text-center" width="10%">Versi</th>
                        <th class="text-center">Status Kemas</th>
                        <th class="text-center">Status Evaluator</th>
                        <th class="text-center">Status Lab</th>
                        <th class="text-center">Status Maklon</th>
                        <th class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($dataF as $dF)
                      <tr>
                        <td class="text-center">{{ $dF->kemungkinan }}</td>

                        @if($dF->status_kemas =='belum selesai')
                        <td class="text-center"><span class="labell label-danger " style="color:#ffff">Proses</span></td>
                        @elseif($dF->status_kemas=='selesai')
                        <td class="text-center"><span class="labell label-info " style="color:#ffff">Done</span></td>
                        @elseif($dF->status_kemas=='sending')
                        <td class="text-center"><span class="labell label-success " style="color:#ffff">Sending</span></td>
                        @endif

                        @if($dF->status_mesin =='belum selesai')
                        <td class="text-center"><span class="labell label-danger " style="color:#ffff">Proses</span></td>
                        @elseif($dF->status_kemas=='selesai')
                        <td class="text-center"><span class="labell label-info " style="color:#ffff">Done</span></td>
                        @elseif($dF->status_kemas=='sending')
                        <td class="text-center"><span class="labell label-success " style="color:#ffff">Sending</span></td>
                        @endif

                        @if($dF->status_sdm =='belum selesai')
                        <td class="text-center"><span class="labell label-danger " style="color:#ffff">Proses</span></td>
                        @elseif($dF->status_kemas=='selesai')
                        <td class="text-center"><span class="labell label-info " style="color:#ffff">Done</span></td>
                        @elseif($dF->status_kemas=='sending')
                        <td class="text-center"><span class="labell label-success " style="color:#ffff">Sending</span></td>
                        @endif

                        @if($dF->status_lab =='belum selesai')
                        <td class="text-center"><span class="labell label-danger " style="color:#ffff">Proses</span></td>
                        @elseif($dF->status_kemas=='selesai')
                        <td class="text-center"><span class="labell label-info " style="color:#ffff">Done</span></td>
                        @elseif($dF->status_kemas=='sending')
                        <td class="text-center"><span class="labell label-success " style="color:#ffff">Sending</span></td>
                        @endif
                        <td class="text-center">

                        <!-- link -->
                        @if(auth()->user()->role->namaRule === 'evaluator')
                          @if($dF->status_mesin=='belum selesai')
                          <a href="{{ route('reference',[ 'id_formula' => $dF->id_formula,'id_feasibility' => $dF->id_feasibility]) }}" type="submit" class="btn btn-primary fa fa-edit" data-toggle="tooltip" data-placement="top" title="buat data"></a>
                          @elseif($dF->status_mesin=='sending')
                          <a href="{{ route('datamesin',[ 'id_formula' => $dF->id_formula,'id_feasibility' => $dF->id_feasibility]) }}" type="submit" class="btn btn-info fa fa-paste" data-toggle="tooltip" data-placement="top" title="Edit Data"></a>
                          @endif

                        @elseif(auth()->user()->role->namaRule === 'finance')
                          @if($dF->status_feasibility =='belum selesai')
                            @if($dF->status_finance =='belum selesai')
                            <a href="{{ route('finance',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}" type="submit" class="btn btn-primary fa fa-edit" data-toggle="tooltip" data-placement="top" title="Edit"></a>
                            @elseif($dF->status_finance !='belum selesai')
                            <a href="{{ route('summary',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}" type="submit" class="btn btn-info fa fa-eye" data-toggle="tooltip" data-placement="top" title="lihat"></a>
                            <a href="{{ route('akhirfs',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}" type="submit" class="btn btn-success fa fa-paper-plane" data-toggle="tooltip" data-placement="top" title="sent to PV"></a>
                            @endif
                          @elseif($dF->status_feasibility =='selesai')
                          <a href="{{ route('summary',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}" type="submit" class="btn btn-info fa fa-eye" data-toggle="tooltip" data-placement="top" title="lihat"></a>
                          @endif
                        @endif
                        
                        @if(auth()->user()->role->namaRule === 'pv_lokal' || auth()->user()->role->namaRule === 'pv_global')
                          <a href="{{ route('summary',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}" type="submit" class="btn btn-info fa fa-eye" data-toggle="tooltip" data-placement="top" title="lihat"></a>
                        @endif
                        @if(auth()->user()->role->namaRule === 'evaluator')
                        <a href="{{ route('deletefs', $dF->id_feasibility) }}" class="btn btn-danger fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="Hapus"></a>
                        </td>
                        @endif
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- mesin dan sdm selesai -->

          <!-- LAB -->
          <div role="tabpanel" class="tab-pane fade" id="tab_content7" aria-labelledby="profile-tab">
            <div class="panel-heading">
              <h2>Penyusunan Feasibility</h2>
            </div>
            <table id="myTable" class="table table-hover table-bordered">
              <thead>
                <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                  <th class="text-center" width="10%">Versi Feasibility</th>
                  <th class="text-center" width="30%">Kemas</th>
                  <th class="text-center" width="30%">Lab</th>
                  <th class="text-center" width="30%">Maklon</th>
                </tr>
              </thead>
            </table>
          </div>
          <!-- LAB selesai -->
        </div>
      </div>
    </div>
  </div>
</div>

@endsection