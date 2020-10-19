@extends('kemas.tempkemas')
@section('title', 'feasibility|Kemas')
@section('judulnya', 'Konsep Kemas')
@section('content')

<div class="x_panel">
  <div class="card-block">
    <div class="row">
	    <div class="col-md-6 col-sm-6 col-xs-12 content-panel">
		    @foreach($formulas as $formula)
  		  <table>
	  		  <tr><th width="15%">Nama Produk </th><th width="45%">: {{ $formula->datapkpp->project_name}}</th>
		  	  <tr><th width="15%">Tanggal Terima</th><th width="45%">: {{ $formula->updated_at }}</th>
          <tr><th width="15%">No.PKP</th><th width="45%">: {{ $formula->datapkpp->pkp_number }}{{$formula->datapkpp->ketno}}</th>
		    </table>
		    @endforeach
  	  </div>
      <div class="col-md-6 col-sm-6 col-xs-12 content-panel">
		    @foreach($formulas as $formula)
		    <table>
        <tr><th width="10%">Versi Project</th><th width="45%">: {{ $formula->revisi }}.{{$formula->turunan}}</th>
		  	  <tr><th width="10%">Idea</th><th width="45%">: {{ $formula->idea }}</th></tr>
		    </table>
		    @endforeach
	    </div>
    </div>  
  </div>
</div>

<div class="row">
  <div class="col-md-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h3><li class="fa fa-file"> Konsep Kemas</li></h3>
      </div>
      <div>
        <form id="demo-form2"  class="form-horizontal form-label-left" action="{{ route('insertkonsep',$id_feasibility) }}" method="post">
          <div class="form-group row">
            <label class=" col-md-2 col-sm-2 col-xs-12">Keterangan</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input type="text" class="form-control col-md-8 col-sm-8 col-xs-12" name="keterangan" id="keterangan" required>
            </div>
          </div>
          <div class="form-group row">
          <label class=" col-md-2 col-sm-2 col-xs-12">konsep</label>
          <div class="col-md-4 col-sm-4 col-xs-12">
            <select class="form-control col-md-4 col-sm-4 col-xs-12" name="konsepkemas" required>
              <option>Tradisional</option>
              <option>Modern</option>
            </select>
          </div>
          <label class="control-label col-md-1 col-sm-1 col-xs-12">renceng</label>
          <div class="col-md-4 col-sm-4 col-xs-12">
            <select class="form-control col-md-4 col-sm-3 col-xs-12" name="ren">
              <option>10</option>
              <option>8</option>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label class=" col-md-2 col-sm-2 col-xs-12">Konfigurasi</label>&nbsp
          <div class="col-md-4 col-sm-4 col-xs-12">
          <input type="radio" name="gramasi" oninput="dua()" id="radio_dua">&nbsp 2 Dimensi &nbsp
          <input type="radio" name="gramasi" oninput="tiga()" id="radio_tiga">&nbsp 3 Dimensi &nbsp
           <input type="radio" name="gramasi" oninput="empat()" id="radio_empat">&nbsp 4 Dimensi 
          </div>
          <label class="control-label col-md-1 col-sm-1 col-xs-12">Batch</label>
           <div class="col-md-4 col-sm-4 col-xs-12">
           @foreach($myFormula as $for)
              <input type="text" value="{{$for->batch}}" id="batch" name="batch" class="form-control" readonly>
              @endforeach
           </div>
        </div>
        <div id="tampil"></div>
        <div class="form-group row"><br>
          <div class="col-sm-6">  
            <input type="number" name="BP" maxlength="8" name="last-name" placeholder="Box/Palet" required class="form-control">
          </div>
          <div class="col-sm-6">
            <input type="number" name="BL" maxlength="8" name="last-name" placeholder="Box/Layer" required class="form-control">
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-6">
            <input type="number" class="form-control" placeholder="Palet/Batch" name="PB" required >
          </div>
          <div class="col-sm-6">
            <input type="text" class="form-control" placeholder="Kubikasi/m^3" name="kubikasi" required>
          </div>
        </div>

        <div class="ln_solid"></div>
        <div class="form-group"><br>
          <center>
            @foreach($dataF as $dF)
            <a href="{{ route('myFeasibility',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}" class="btn btn-danger btn-sm" type="submit"><li class="fa fa-arrow-circle-left"></li> Cancel</a>
            @if($count_konsep == 0)
            <button class="btn btn-warning btn-sm" type="reset"><li class="fa fa-trash"></li> Reset</button>
            @elseif($count_konsep >= 1)
            <a href="{{ route('uploadkemas',['id_feasibility' => $dF->id_feasibility, 'id_formula' => $dF->id_formula]) }}" class="btn btn-info btn-sm"><li class="fa fa-eye"></li> next and show configuration</a>
            @endif
            @endforeach
            <button type="submit" onclick="return confirm('Yakin Dengan Data Yang Anda Masukan?? ?')" class="btn btn-primary btn-sm"><li class="fa fa-plus"></li> Submit</button>
            {{ csrf_field() }}
          </center>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  var batch = document.getElementById('batch').value;
  var primer = document.getElementById('primer').value;
  var sekunder = document.getElementById('sekunder').value;
  var tersier = document.getElementById('tersier').value;
  var tersier2 = document.getElementById('tersier2').value;
  var ren = document.getElementById('ren').value;

  var pertama = ((batch*1000)/tersier);
  pertama = pertama.toFixed(0);
  // console.log(pertama);
  document.getElementById('sachet').value = pertama;
  var kedua = (pertama/ren);
  kedua = kedua.toFixed(0);
  document.getElementById('renceng').value = kedua;
  var bagi = (sekunder/ren);
  var ketiga = (kedua/bagi);
  ketiga = ketiga.toFixed(0);
  document.getElementById('outer').value = ketiga;
  var keempat = (ketiga/tersier2);
  keempat = keempat.toFixed(0);
  document.getElementById('pack').value = keempat;
  var kelima = (keempat/primer);
  kelima = kelima.toFixed(0);
  document.getElementById('box').value = kelima;
</script>

<script>
  var batch3 = document.getElementById('batch3').value;
  var primer3 = document.getElementById('primer3').value;
  var sekunder3 = document.getElementById('sekunder3').value;
  var tersier3 = document.getElementById('tersier3').value;
  var ren3 = document.getElementById('ren3').value;

  var pertama = ((batch3*1000)/tersier3);
  pertama = pertama.toFixed(0);
  document.getElementById('sachet3').value = pertama;
  var kedua = (pertama/ren3);
  kedua = kedua.toFixed(0);
  document.getElementById('renceng3').value = kedua;
  var bagi = (sekunder/ren3);
  var ketiga = (kedua/bagi);
  ketiga = ketiga.toFixed(0);
  document.getElementById('pack3').value = ketiga;
  var keempat = (keempat/primer);
  keempat = keempat.toFixed(0);
  document.getElementById('box3').value = keempat;
</script>

<script>

  function dua(){
    var dua = document.getElementById('radio_dua');
    if(dua.checked != true){
      document.getElementById('tampil').innerHTML = "";
    }else{
      document.getElementById('tampil').innerHTML = "<br><div class='panel panel-default'>"+
        "<div class='x_panel'>"+
          "<div class='x_title'>"+
           " <h3><li class='fa fa-file'> Konfigurasi Kemas</li></h3>"+
          "</div>"+
          "<div class='card-block'>"+
          "<div class='form-group row'>"+
          "<div>"+
            "<input type='hidden' name='finance' maxlength='45' value='{{$fe->id_feasibility}}' class='form-control col-md-7 col-xs-12'>"+
          "</div>"+
          "<div class='col-md-2 col-sm-1 col-xs-12'>"+
            "<input name='d' class='date-picker form-control' type='number'>"+
          "</div>"+
          "<div class='col-md-1 col-sm-2 col-xs-12'>"+
            "<select class='form-control' name='primer'>"+
              "<option>D</option>"+
              "<option>S</option>"+
              "<option>G</option>"+
              "<option>SB</option>"+
              "<option>O</option>"+
							"<option>R</option>"+
              "<option>P</option>"+
              "<option>GST</option>"+
              "<option>BTL</option>"+
            "</select>"+
          "</div>"+

          "<div class='col-md-2 col-sm-1 col-xs-12'>"+
            "<input name='g' class='date-picker form-control' type='number'>"+
          "</div>"+
          "<div class='col-md-1 col-sm-2 col-xs-12'>"+
            "<select class='form-control' name='tersier'>"+
              "<option>G</option>"+
              "<option>ML</option>"+
            "</select>"+
          "</div>"+
          "<input name='t' value='1' class='date-picker form-control col-md-7 col-xs-12' type='hidden'>"+
          "<div class='col-md-1 col-sm-1 col-xs-12'>"+
            "<input name='s' class='date-picker form-control col-md-1 col-sm-2 col-xs-12' type='hidden'>"+
          "</div>"+
          "</div>"+
          "</div>"+
      "</div>"
    }
  }

  function tiga(){
    var tiga = document.getElementById('radio_tiga');
    if(tiga.checked != true){
      document.getElementById('tampil').innerHTML = "";
    }else{
      document.getElementById('tampil').innerHTML = "<br><div class='panel panel-default'>"+
        "<div class='x_panel'>"+
          "<div class='x_title'>"+
            "<h3><li class='fa fa-file'> Konfigurasi Kemas</li></h3>"+
          "</div>"+
          "<div class='card-block'>"+
            "<div class='form-group row'>"+
              "<div>"+
                "<input type='hidden' name='finance' maxlength='45' value='{{$fe->id_feasibility}}' class='form-control col-md-7 col-xs-12'>"+
              "</div>"+
              "<div class='col-md-2 col-sm-1 col-xs-12'>"+
                "<input name='d' class='date-picker form-control col-md-1 col-sm-2 col-xs-12' type='number'>"+
              "</div>"+
              "<div class='col-md-1 col-sm-2 col-xs-12'>"+
                "<select class='form-control' name='primer'>"+
                  "<option>D</option>"+
                  "<option>S</option>"+
                  "<option>G</option>"+
                  "<option>SB</option>"+
                  "<option>O</option>"+
						    	"<option>R</option>"+
                  "<option>P</option>"+
                  "<option>GST</option>"+
                  "<option>BTL</option>"+
                "</select>"+
              "</div>"+

              "<div class='col-md-2 col-sm-1 col-xs-12'>"+
                "<input name='s' class='date-picker form-control col-md-7 col-xs-12' type='number'>"+
              "</div>"+
              "<div class='col-md-1 col-sm-2 col-xs-12'>"+
                "<select class='form-control' name='sekunder'>"+
                  "<option>D</option>"+
                  "<option>S</option>"+
                  "<option>G</option>"+
                  "<option>SB</option>"+
                  "<option>O</option>"+
                  "<option>R</option>"+
                  "<option>P</option>"+
                  "<option>GST</option>"+
                  "<option>BTL</option>"+
                "</select>"+
              "</div>"+
              "<input name='t' value='1' class='date-picker form-control col-md-7 col-xs-12' type='hidden'>"+
              "<div class='col-md-2 col-sm-1 col-xs-12'>"+
                "<input name='g' class='date-picker form-control col-md-1 col-sm-2 col-xs-12' type='number'>"+
              "</div>"+
              "<div class='col-md-1 col-sm-2 col-xs-12'>"+
                "<select class='form-control' name='tersier'>"+
                  "<option>G</option>"+
                  "<option>ML</option>"+
                "</select>"+
              "</div>"+
            "</div>"+
          "</div>"+
        "</div>"
    }
  }

  function empat(){
    var empat = document.getElementById('radio_empat');
    if(empat.checked != true){
      document.getElementById('tampil').innerHTML = "";
    }else{
      document.getElementById('tampil').innerHTML =
      "<div class='x_panel'>"+
        "<div class='x_title'>"+
          "<h3><li class='fa fa-file'> Konfigurasi Kemas</li></h3>"+
        "</div>"+
        "<div class='card-block'>"+
          "<div class='form-group row'>"+
            "<div>"+
              "<input type='hidden' name='finance' maxlength='45' value='{{$fe->id_feasibility}}' class='form-control col-md-7 col-xs-12'>"+
            "</div>"+
            "<div class='col-md-2 col-sm-1 col-xs-12'>"+
              "<input name='d' class='date-picker form-control col-md-1 col-sm-2 col-xs-12' type='number'>"+
            "</div>"+
            "<div class='col-md-1 col-sm-2 col-xs-12'>"+
              "<select class='form-control' name='primer'>"+
                "<option>D</option>"+
                "<option>S</option>"+
                "<option>G</option>"+
                "<option>SB</option>"+
                "<option>O</option>"+
							  "<option>R</option>"+
                "<option>P</option>"+
                "<option>GST</option>"+
                "<option>BTL</option>"+
              "</select>"+
            "</div>"+
            "<div class='col-md-2 col-sm-1 col-xs-12'>"+
              "<input name='t' class='date-picker form-control col-md-7 col-xs-12' type='number'>"+
            "</div>"+
            "<div class='col-md-1 col-sm-2 col-xs-12'>"+
              "<select class='form-control' name='tersier2'>"+
                "<option>D</option>"+
                "<option>S</option>"+
                "<option>G</option>"+
                "<option>SB</option>"+
                "<option>O</option>"+
							  "<option>R</option>"+
                "<option>P</option>"+
                "<option>GST</option>"+
                "<option>BTL</option>"+
              "</select>"+
            "</div>"+ 
            "<div class='col-md-2 col-sm-1 col-xs-12'>"+
              "<input name='s' class='date-picker form-control col-md-7 col-xs-12' type='number'>"+
            "</div>"+
            "<div class='col-md-1 col-sm-2 col-xs-12'>"+
              "<select class='form-control' name='sekunder'>"+
                "<option>D</option>"+
                "<option>S</option>"+
                "<option>G</option>"+
                "<option>SB</option>"+
                "<option>O</option>"+
							  "<option>R</option>"+
                "<option>P</option>"+
                "<option>GST</option>"+
                "<option>BTL</option>"+
              "</select>"+
            "</div>"+
            "<div class='col-md-2 col-sm-1 col-xs-12'>"+
              "<input name='g' class='date-picker form-control col-md-1 col-sm-2 col-xs-12' type='number'>"+
            "</div>"+
            "<div class='col-md-1 col-sm-2 col-xs-12'>"+
              "<select class='form-control' name='tersier'>"+
                "<option>G</option>"+
                "<option>ML</option>"+
              "</select>"+
            "</div>"+
          "</div>"+
        "</div>"+
      "</div>"  ;
    }
  }
</script>
@endsection