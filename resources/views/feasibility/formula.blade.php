@extends('feasibility.tempfeasibility')
@section('title', 'Formula')
@section('content')

<div class="x_panel">
  <div class="x_title">
    <h3><li class="fa fa-list"> List project</li></h3>
  </div>
  <div class="showback" style="border-radius:3px;">
    <table class="Table table-striped table-advance table-hover table-bordered" id="Table">
      <thead>
        <div class="btn-group">
          {{-- <a href="{{ route('formula.selesai') }}" type="submit" data-toggle="tooltip" title="Lihat" class="btn btn-info fa fa-folder-open"> Formula Yang Sudah Selesai</a> --}}
        </div><br>
        <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
          <th class="text-center">PKP Number</th>
          <th class="text-center">PV</th>
          <th class="text-center">Project Name</th>
          <th class="text-center">Brand</th>
          <th class="text-center">Status Sample</th>
          <th class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($wb as $wb)
        <tr>
          <td>{{$wb->pkp_number}}{{$wb->ket_no}}</td>
          <td class="text-center">{{$wb->datapkp->perevisi2->name}}</td>
          <td>{{$wb->project_name}}</td>
          <td>{{$wb->id_brand}}</td>
          <td></td>
          <td class="text-center">
            <div class="btn-group">
                <a class="btn btn-info btn-sm" href="{{ Route('rekappkp',$wb->id_project) }}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection