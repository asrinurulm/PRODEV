@extends('pv.tempvv')
@section('title', 'Request PKP')
@section('judulhalaman','Request PKP')
@section('content')

<div class="row">
	<div class="x_panel">
	<a href="{{route('exportBpom')}}" class="btn btn-info btn-sm"><li class="fa fa-download"></li> Export Data BPOM</a>
	@if(auth()->user()->role->namaRule == 'admin')
	<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#pangan"><i class="fa fa-plus"></i> Add Data Pangan</button>
	<!-- modal -->
	<div class="modal" id="pangan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title text-left" id="exampleModalLabel">Add Data Pangan
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span></h3>
					</button>
				</div>
				<div class="modal-body">
					<form class="form-horizontal form-label-left" method="POST" action="{{route('tambahpangan')}}" novalidate>
					<div class="form-group row">
						<label class="control-label text-bold col-md-3 col-sm-3 col-xs-12 text-center">Jenis</label>
						<div class="col-md- col-sm-3 col-xs-12">
							<select name="jenis" class="form-control form-control-line" style="width:408px">
								@foreach($datapangan as $data)
								<option value="{{$data->kategori_pangan}}">{{$data->kategori_pangan}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label text-bold col-md-3 col-sm-3 col-xs-12 text-center">No.Kategori</label>
						<div class="col-md-9 col-sm-3 col-xs-12">
							<input type="text" class="form-control" name="no">
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label text-bold col-md-3 col-sm-3 col-xs-12 text-center">Kategori</label>
						<div class="col-md-9 col-sm-3 col-xs-12">
							<input type="text" class="form-control" name="kategori">
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label text-bold col-md-3 col-sm-3 col-xs-12 text-center">Jenis Mikroba</label>
						<div class="col-md-9 col-sm-3 col-xs-12">
							<input type="text" class="form-control" name="mikroba">
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label text-bold col-md-3 col-sm-3 col-xs-12 text-center">n</label>
						<div class="col-md-4 col-sm-3 col-xs-12">
							<input type="text" class="form-control" name="n">
						</div>
						<label class="control-label text-bold col-md-1 col-sm-3 col-xs-12 text-center">c</label>
						<div class="col-md-4 col-sm-3 col-xs-12">
							<input type="text" class="form-control" name="c">
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label text-bold col-md-3 col-sm-3 col-xs-12 text-center">m</label>
						<div class="col-md-4 col-sm-3 col-xs-12">
							<input type="text" class="form-control" name="m1">
						</div>
						<label class="control-label text-bold col-md-1 col-sm-3 col-xs-12 text-center">M</label>
						<div class="col-md-4 col-sm-3 col-xs-12">
							<input type="text" class="form-control" name="m2">
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label text-bold col-md-3 col-sm-3 col-xs-12 text-center">Metode Analisa</label>
						<div class="col-md-9 col-sm-3 col-xs-12">
							<input type="text" class="form-control" name="analisa">
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Submit</button>
						{{ csrf_field() }}
					</div>
				</form>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal Selesai -->
	@endif
		<table class="Table table-bordered">
			<thead>
				<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
					<td width="7px"></td>
					<td>Jenis</td>
					<td>No kategori</td>
					<td>kategori pangan</td>
					<td>jenis mikroba</td>
					<td>n</td>
					<td>c</td>
					<td>m</td>
					<td>M</td>
					<td>Metode Analisa</td>
					<td></td>
				</tr>
			</thead>
			<tbody>
				@php
					$no = 0;
				@endphp
				@foreach($pangan as $pangan)
				<tr>
					<td>{{++$no}}</td>
					<td>{{$pangan->jenis}}</td>
					<td class="text-right">{{$pangan->no}}</td>
					<td>{{$pangan->kategori_pangan}}</td>
					<td>{{$pangan->jenis_mikroba}}</td>
					<td>{{$pangan->n}}</td>
					<td>{{$pangan->c}}</td>
					<td>{{$pangan->m1}}</td>
					<td>{{$pangan->m2}}</td>
					<td>{{$pangan->metode_analisa}}</td>
					<td><button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#pangan{{$pangan->id_bpom}}" data-toggle="tooltip" data-placement="top" title="Edit"><li class="fa fa-edit "></li></button></td>
				<!-- modal -->
				<div class="modal" id="pangan{{$pangan->id_bpom}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h3 class="modal-title text-left" id="exampleModalLabel"> Edit data 
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span></h3>
								</button>
							</div>
							<div class="modal-body">
							<form class="form-horizontal form-label-left" method="POST" action="{{route('editpangan',$pangan->id_bpom)}}" novalidate>
								<div class="form-group row">
									<label class="control-label text-bold col-md-3 col-sm-3 col-xs-12 text-center">No kategori</label>
									<div class="col-md-9 col-sm-10 col-xs-12">
										<input type="text" disabled class="form-control" name="no" value="{{$pangan->no}}">
									</div>
								</div>
								<div class="form-group row">
									<label class="control-label text-bold col-md-3 col-sm-3 col-xs-12 text-center">Kategori Pangan</label>
									<div class="col-md-9 col-sm-10 col-xs-12">
										<input type="text" class="form-control" name="kategori" value="{{$pangan->kategori_pangan}}">
									</div>
								</div>
								<div class="form-group row">
									<label class="control-label text-bold col-md-3 col-sm-3 col-xs-12 text-center">Jenis Mikroba</label>
									<div class="col-md-9 col-sm-10 col-xs-12">
										<input type="text" name="mikro" class="form-control" value="{{$pangan->jenis_mikroba}}">
									</div>
								</div>
								<div class="form-group row">
									<label class="control-label text-bold col-md-3 col-sm-3 col-xs-12 text-center">n</label>
									<div class="col-md-4 col-sm-10 col-xs-12">
										<input type="text" name="n" class="form-control" value="{{$pangan->n}}">
									</div>
									<label class="control-label text-bold col-md-1 col-sm-3 col-xs-12 text-center">c</label>
									<div class="col-md-4 col-sm-10 col-xs-12">
										<input type="text" name="c" class="form-control" value="{{$pangan->c}}">
									</div>
								</div>
								<div class="form-group row">
									<label class="control-label text-bold col-md-3 col-sm-3 col-xs-12 text-center">m</label>
									<div class="col-md-4 col-sm-10 col-xs-12">
										<input type="text" name="m1" class="form-control" value="{{$pangan->m1}}">
									</div>
									<label class="control-label text-bold col-md-1 col-sm-3 col-xs-12 text-center">M</label>
									<div class="col-md-4 col-sm-10 col-xs-12">
										<input type="text" name="m2" class="form-control" value="{{$pangan->m2}}">
									</div>
								</div>
								<div class="form-group row">
									<label class="control-label text-bold col-md-3 col-sm-3 col-xs-12 text-center">Metode Analisa</label>
									<div class="col-md-9 col-sm-10 col-xs-12">
										<input type="text" name="analisa" class="form-control" value="{{$pangan->metode_analisa}}">
									</div>
								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Submit</button>
									{{ csrf_field() }}
								</div>
							</form>
							</div>
						</div>
					</div>
				</div>
				<!-- Modal Selesai -->	
			</tr>	
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection

@section('s')
<script type="text/javascript">
  $('select').select2({
    placeholder: '-->Select One<--',
    allowClear: true
  });
</script>
@endsection