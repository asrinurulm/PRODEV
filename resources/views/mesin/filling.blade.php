@extends('mesin.tempmesin')
@section('title','Feasibility|Data Mesin')
@section('content')

<div id="RM" class="tab-pane">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h3><li class="fa fa-cogs"> Data Mesin</li></h3>
        </div>
        <div class="x_content">
          <div class="" role="tabpanel" data-example-id="togglable-tabs">
            <ul class="nav nav-tabs  tabs" role="tablist">
              @foreach($dataF as $dF)
              <li role="presentation" class=""><a href="{{ route('runtimemesin',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}">MAKLON</a></li>
              <li role="presentation" class=""><a href="{{ route('mesinmixing',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}">MIXING</a></li>
              <li role="presentation" class="active"><a href="{{ route('mesinfilling',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}">FILLING</a></li>
              <li role="presentation" class=""><a href="{{ route('mesinpacking',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}">PACKING</a></li>
              @endforeach
            </ul><br>
            <div id="myTabContent" class="tab-content">
                        
              <!-- FILLING -->
              <table class="Table table-hover table-bordered">
                <thead>
                  <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
                    <th class="text-center">mesin</th>
                    <th class="text-center">standar sdm</th>
                    <th class="text-center">Speed</th>
                    <th class="text-center">Aksi</th>
                    <th class="text-center">Hasil</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($Mdata as $dM)
                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="/updatemss/{{$dM->id_mesin}}" method="post">
                  {!!csrf_field()!!}
                  <tr>
                    @if( $dM->meesin->kategori=='Filling' )
                    <td> {{ $dM->meesin->nama_mesin }}</td>
                    <td class="text-center" width="15%">{{$dM->standar_sdm}} Orang </td>
                    <td class="text-center" width="15%">{{$dM->runtime}} Menit</td>
                    <td class="text-center" width="15%">
                      </form>
                      <form action="{{ route('mesin.destroy', $dM->id_mesin) }}" method="post">
                        {{csrf_field()}}
                        <button type="submit" class="btn btn-danger fa fa-trash-o"></button>
                        <input type="hidden" name="_method" value="DELETE">
                      </form>
                    </td>
                    <td width="15%"><input type="number" id='hasill{{$dM->id_mesin}}' class="form-control1 text-center col-md-7 col-xs-12" value="{{ $dM->hasil }}" disabled> </td>
                    @endif
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            @foreach($dataF as $dF)
              <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{route('statusM',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula])}}" method="post">
              <input class="form-control1" type="hidden" name="statusM" class="text-center col-md-7 col-xs-12" value="sending">
              <center>
                <a href="{{ route('datamesin',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}" class="btn btn-danger btn-sm" type="button">Back</a>
                <!-- <button type="submit" class="btn btn-primary">Selesai</button> -->
			          {{ csrf_field() }}
              </center>
              </form>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</div> 

@endsection

@section('s')

<script type="text/javascript">
        $(document).ready(function(){
      $.ajax({
        url: '/api/runtime/' + '{{ $id_feasibility }}',
        method: 'GET',
        type: 'JSON',
        success : function(data){
          console.log(data);
          var formDelete = '';
          for(var i = 0; i < Object.keys(data).length; i++){
            // console.log(i)
            formDelete = '<form id="'+data[i].id_mesin+'" type="POST">' +
                            '{{ csrf_field() }}' +
                            '<button type="submit" class="btn btn-danger fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="Hapus"></button> ' +
                            '<input type="hidden" name="_method" value="DELETE">' +
                          '</form>';
            $('#deleteData'+data[i].id_mesin).html(formDelete);

            $('#'+data[i].id_mesin).submit(function(e) {
              e.preventDefault();
              var id = $(this).attr('id');
              $.ajax({
                method: 'POST',
                data: {
                  '_method' : 'DELETE'
                },
                url: window.location.origin + '/deletedata/' + id,
                headers: {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(res){
                  console.log('Berhasil')
                  $('#row'+id).html('');
                },
                error: function(error){
                  console.log('error')
                  console.log(error)
                }
              })
            })
            $('#edit'+data[i].id_mesin).submit(function(e){
              e.preventDefault();
              var data = $(this).serializeArray();
              var id = data[0].value;
              var runtime = data[1].value;
              $.ajax({
                url: window.location.origin + '/updatemss/' + id,
                method: 'POST',
                data: {
                  '_method' : 'PUT',
                  'runtime' : runtime
                },
                headers: {
                  'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                },
                success: function(res){
                  console.log('Success')
                  $('#runtime'+id).html(runtime)
                  $.ajax({
                    url: window.location.origin + '/api/update/' + id,
                    method: 'GET',
                    type: 'JSON',
                    success: function(data){
                      console.log(data.runtime)
                      $('#runtimes'+id).val(data.runtime);
                      $('#hasill'+id).val(data.hasil);
                    },
                    error: function(error){
                      console.log('Gagal update view')
                    }
                  })
                },
                error: function(error){
                  console.log('error')
                  console.log(error)
                }
              })
            })
          }
        },
        error :function(error){
          console.log('error')
          console.log(error)
        }
      })

      $('document').on('submit', function(e){
        e.preventdefault();
        console.log($(this).serializeArray());
      })
  });
</script>
@endsection
