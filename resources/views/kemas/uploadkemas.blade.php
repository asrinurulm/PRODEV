@extends('kemas.tempkemas')
@section('title', 'feasibility|Kemas')
@section('judulnya', 'List Feasibility')
@section('content')

<div class="row">
	
</div>
<div class="row">
	<div class="col-md-7 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h3><li class="fa fa-folder"> Configuration</li></h3>
			</div>
			<div class="panel-body">
				<table class="table table-bordered">
					<thead>
						<tr style="font-weight: bold;color:white;background-color: #2a3f54;">
							<td class="text-center">Keterangan</td>
							<td class="text-center">Konfigurasi</td>
							<td class="text-center">Konsep</td> 
							<td class="text-center">Batch</td>
							<td class="text-center">Palet/batch</td>
							<td class="text-center">Box/palet</td>
							<td class="text-center">Box/layer</td>
							<td class="text-center">Kubikasi</td>
						</tr>
					</thead>
					<tbody>
						@foreach($konsep as $konsep)
						<tr>
							<td>{{$konsep->keterangan}}</td>
							<td class="text-center">
								@if($konsep->primer!=NULL)
								{{$konsep->primer}}{{$konsep->s_primer}}
								@endif
								@if($konsep->tersier!=NULL)
								X{{$konsep->tersier}}{{$konsep->s_tersier}}
								@endif	
								@if($konsep->tersier!=NULL)
								X{{$konsep->tersier2}}{{$konsep->s_tersier2}}
								@endif	
								@if($konsep->sekunder!=NULL)
								X{{$konsep->sekunder}}{{$konsep->s_sekunder}}
								@endif	
							</td>
							<td class="text-center">{{$konsep->konsep}}</td>
							<td class="text-right">{{$konsep->batch}}</td>
							<td class="text-right">{{$konsep->palet_batch}}</td>
							<td class="text-right">{{$konsep->box_palet}}</td>
							<td class="text-right">{{$konsep->box_layer}}</td>
							<td class="text-right">{{$konsep->kubikasi}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-5 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
				<h3><li class="fa fa-download"> Upload Kemas</li></h3>
 			</div>
			<div class="panel-body">
				<form action="{{ route('hasil',$id_feasibility) }}" method="post" enctype="multipart/form-data">
					{{ csrf_field() }}

					@if (session('success'))
					<div class="alert alert-success">
						{{ session('success') }}
					</div>
					@endif

					@if (session('error'))
					<div class="alert alert-success">
						{{ session('error') }}
					</div>
					@endif
					<div class="form-group">
						<div>
							<input type="hidden" name="finance" maxlength="45" required="required" value="{{$fe->id}}" class="form-control col-md-7 col-xs-12">
						</div>
						<label for="">File (.csv)</label>
						<input type="file" class="form-control" name="file">
						<p class="text-danger">{{ $errors->first('file') }}</p>
					</div>
					<div class="form-group">
						<button class="btn btn-success btn-sm"><li class="fa fa-upload"></li> Upload</button>
						@foreach($dataF as $dF)
							<a href="{{ url('lihat',['id_formula' => $dF->id_formula,'id_feasibility' => $dF->id_feasibility]) }}" class="btn btn-info btn-sm" type="button"><li class="fa fa-eye"></li> Show</a>
							<a href="{{ url('KonsepKemas',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}" class="btn btn-danger btn-sm"><li class="fa fa-arrow-circle-left"></li> Back</a>
						@endforeach
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection