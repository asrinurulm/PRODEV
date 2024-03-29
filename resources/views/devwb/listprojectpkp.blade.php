@extends('formula.tempformula')
@section('title', 'List PKP')
@section('content')

@if (session('status'))
<div class="col-lg-12 col-md-12 col-sm-12">
  <div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ session('status') }}
  </div>
</div>
@elseif(session('error'))
<div class="col-lg-12 col-md-12 col-sm-12">
  <div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ session('error') }}
  </div>
</div>
@endif

<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="row">
    <!-- filter data -->
    <div class="panel panel-default">
	    <div class="panel-heading">
        <h2><li class="fa fa-filter"></li> Filter Project PKP</h2>
      </div>
      <div>
        <div>
          <form id="clear">          
          <!--project-->
          <div class="col-md-4 pl-1">
            <div class="form-group" id="filter_col" data-column="1">
              <label>Project Name</label>
              <select name="name" class="form-control column_filter" id="col1_filter">
                <option disabled selected>-->Select One<--</option>
                <option>proses</option>
                <option>close</option>
              </select>
            </div>
          </div>      
          <!--brand-->
          <div class="col-md-4 pl-1">
            <div class="form-group" id="filter_col1" data-column="3">
              <label>Brand</label>
              <select name="brand" class="form-control column_filter" id="col3_filter" >
                <option disabled selected>-->Select One<--</option>
                @foreach($brand as $br)
                <option>{{$br->brand}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <!--Data-->
          <div class="col-md-3 pl-1">
            <div class="form-group" id="filter_col1" data-column="5">
              <label>Status</label>
              <select name="status" class="form-control column_filter" id="col5_filter" >
                <option disabled selected>-->Select One<--</option>
                <option>sending sample</option>
                <option>sent to PV</option>
                <option>approved by PV</option>
              </select>
            </div>
          </div>
          <div class="col-md-1 pl-1">
            <div class="form-group" id="filter_col1" data-column="5">
              <label class="text-center">refresh</label>    
              <a href="" class="btn btn-info btn-sm"><li class="fa fa-refresh"></li></a>
            </div>
          </div>
          </form>
        </div>
      </div>
    </div>
    <!-- filter data selesai -->
  </div>
</div>

<div class="x_panel">
  <div class="x_title">
    <h3><li class="fa fa-wpforms"></li> List PKP</h3>
  </div>
  <div class="card-block">
    <div class="clearfix"></div>
      <div class="x_content" style="overflow-x: scroll;">
      <table id="ex" class="Table table-striped nowrap">
        <thead>
          <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
            <th class="text-center">#</th>
            <th class="text-center">PKP Number</th>
            <th class="text-center">Project Name</th>
            <th class="text-center">Brand</th>
            <th class="text-center">PV</th>
            <th class="text-center">Prototype Sample submission status</th>
            <th width="15%" class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
          @php $no = 0; @endphp
          @foreach($pkp as $pkp)
          @if($pkp->userpenerima2=='NULL')
            @if($pkp->userpenerima==Auth::user()->id)
            <td class="text-center">{{ ++$no}}</td>
            <td>{{$pkp->pkp_number}}{{$pkp->ket_no}}</td>
            <td>{{ $pkp->project_name }}</td>
            <td>{{ $pkp->id_brand}}</td>
            <td>{{ $pkp->datapkp->perevisi2->name }}</td>
            <td class="text-center">
              @if($pkp->status_freeze=='inactive')
                    @if($pkp->pengajuan_sample=='proses')
                    <?php
                      $awal  = date_create( $pkp->waktu );
                      $akhir = date_create(); // waktu sekarang
                      if($akhir<=$awal)
                      {
                        $diff  = date_diff( $akhir, $awal );
                        echo ' You Have ';
                        echo $diff->m . ' Month, ';
                        echo $diff->d . ' Days, ';
                        echo $diff->h . ' Hours, ';
                        echo ' To sending Sample ';
                      }else{
                        echo ' Your Time Is Up ';
                      }
                    ?>
                    @elseif($pkp->pengajuan_sample=='sent')
                    Sample has been sent to PV
                    @elseif($pkp->pengajuan_sample=='reject')
                    Sample rejected by PV
                    @elseif($pkp->pengajuan_sample=='approve')
                    Sample has been approved by PV
                    @endif
                  @elseif($pkp->status_freeze=='active')
                    Project Is Inactive
                  @endif
            </td>
            <td class="text-center">
              <a class="btn btn-info btn-sm" href="{{ Route('rekappkp',$pkp->id_project) }}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
              @if($pkp->status_project=='close')
              <button class="btn btn-info btn-sm" disabled><li class="fa fa-smile-o" title="close"></li></button>
              @endif
            </td>
            @endif
          @elseif($pkp->userpenerima2!='NULL')
            @if($pkp->userpenerima==Auth::user()->id || $pkp->userpenerima2==Auth::user()->id)
            <td class="text-center">{{ ++$no}}</td>
            <td>{{$pkp->pkp_number}}{{$pkp->ket_no}}</td>
            <td>{{ $pkp->project_name }}</td>
            <td>{{ $pkp->id_brand}}</td>
            <td>{{ $pkp->datapkp->perevisi2->name }}</td>
            <td>
              @if($pkp->status_freeze=='inactive')
                    @if($pkp->pengajuan_sample=='proses')
                    <?php
                      $awal  = date_create( $pkp->waktu );
                      $akhir = date_create(); // waktu sekarang
                      if($akhir<=$awal)
                      {
                        $diff  = date_diff( $akhir, $awal );
                        echo ' You Have ';
                        echo $diff->m . ' Month, ';
                        echo $diff->d . ' Days, ';
                        echo $diff->h . ' Hours, ';
                        echo ' To sending Sample ';
                      }else{
                        echo ' Your Time Is Up ';
                      }
                    ?>
                    @elseif($pkp->pengajuan_sample=='sent')
                    Sample has been sent to PV
                    @elseif($pkp->pengajuan_sample=='reject')
                    Sample rejected by PV
                    @elseif($pkp->pengajuan_sample=='approve')
                    Sample has been approved by PV
                    @endif
                  @elseif($pkp->status_freeze=='active')
                    Project Is Inactive
                  @endif
            </td>
            <td class="text-center">
              <a class="btn btn-info btn-sm" href="{{ Route('rekappkp',$pkp->id_project) }}" data-toggle="tooltip" title="Show"><i class="fa fa-folder-open"></i></a>
              @if($pkp->status_project=='close')
              <button class="btn btn-success btn-sm" title="this project is finished" disabled><li class="fa fa-smile-o" title="close"></li></button>
              @endif
            </td>
            @endif
          </tr>
          @endif
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection
@section('s')
<script>
  function filterGlobal () {
    $('#ex').DataTable().search(
      $('#global_filter').val(),
    ).draw();
  }
    
  function filterColumn ( i ) {
    $('#ex').DataTable().column( i ).search(
      $('#col'+i+'_filter').val()
    ).draw();
  }
    
  $(document).ready(function() {
    $('#ex').DataTable();
        
    $('input.global_filter').on( 'keyup click', function () {
      filterGlobal();
    } );
    
    $('input.column_filter').on( 'keyup click', function () {
      filterColumn( $(this).parents('div').attr('data-column') );
    } );
  });

  $('select.column_filter').on('change', function () {
    filterColumn( $(this).parents('div').attr('data-column') );
  } );
</script>
@endsection