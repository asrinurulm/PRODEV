@extends('mesin.tempmesin')
@section('title','Feasibility|inputor')
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
              <li role="presentation" class="active"><a href="{{ route('mesinmixing',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}">MIXING</a></li>
              <li role="presentation" class=""><a href="{{ route('mesinfilling',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}">FILLING</a></li>
              <li role="presentation" class=""><a href="{{ route('mesinpacking',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}">PACKING</a></li>
            @endforeach
            </ul><br>
            <div id="myTabContent" class="tab-content">

              <!-- MIXING -->
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
                  @php $nom = 0; @endphp
                  @foreach($Mdata as $dM)
                  @php ++$nom; @endphp
                  {!!csrf_field()!!}
                  @if( $dM->meesin->kategori=='Mixing' )
                  <tr id="row{{$dM->id_mesin}}">
                    <td> {{ $dM->meesin->nama_mesin }}</td>
                    <td class="text-center" width="10%"><input disabled type="number" name="runtime" value="{{$dM->standar_sdm}}" name="last-name" required class="form-control1 col-md-12 col-xs-12 text-center"></td>
                      @if($dM->runtime==NULL)
                      <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="/updatemss/{{$dM->id_mesin}}" method="post">
                      <td>
                        <input oninput="hitung();" name="runtime" class="date-picker form-control col-md-7 col-xs-12" type="number" required></td> 
                        {{ csrf_field() }}
                        <input type="hidden" value="put" name="_method">
                      <td class="text-center"><button type="submit" class="btn btn-primary fa fa-check" data-toggle="tooltip" data-placement="top" title="Submit"></button></td> 
                      @else
                        <td class="text-center" width="15%"><input  type="number" id="runtimes{{$dM->id_mesin}}" name="runtime" name="last-name" value="{{$dM->runtime}}" required class="form-control1 col-md-12 col-xs-12 text-center"></td>
                        <td class="text-center">
                          <button type="button" class="btn btn-warning fa fa-edit" data-toggle="modal" data-target="#exampleModal{{ $dM->id_mesin }}" data-toggle="tooltip" data-placement="top" title="Edit"></button>
                          <div class="modal fade" id="exampleModal{{ $dM->id_mesin  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content text-left ">
                                <div class="modal-header">
                                  <h3 class="modal-title" id="exampleModalLabel">Edit Data
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button><h3>
                                </div>
                                <div class="modal-body">
                                <form id="edit{{ $dM->id_mesin }}">
                                  <div class="form-group">
                                    <input type="hidden" name="id" value="{{ $dM->id_mesin }}">
                                    <label for="recipient-name" class="col-form-label">Runtime Mesin:</label>
                                    <input id="runtime" value="{{$dM->runtime}}" name="runtime" class="date-picker form-control" type="text">
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <input type="hidden" name="_method" value="PUT">
                                  <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                                </form>
                              </div>
                            </div>
                          </div>
                          <div id="deleteData{{ $dM->id_mesin }}"></div>
                        </td>
                        <td width="15%"><input type="number" id='hasill{{$dM->id_mesin}}' class="form-control1 text-center col-md-12 col-xs-12" value="{{ $dM->hasil }}" disabled> </td>
                      @endif
                    </form>
                  </tr>
                  @endif
                  @endforeach
                </tbody>
              </table>
            </div>
            @foreach($dataF as $dF)
              <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{route('statusM',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula])}}" method="post">
              <input class="form-control1" type="hidden" name="statusM" class="text-center col-md-7 col-xs-12" value="sending">
              <center>
                <a href="{{ route('datamesin',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}" class="btn btn-danger btn-sm" type="button">Back</a>
                <!-- <button type="submit" class="btn btn-primary btn-sm">Finish</button> -->
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
