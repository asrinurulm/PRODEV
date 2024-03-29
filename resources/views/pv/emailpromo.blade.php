<!DOCTYPE html>
<html lang="en">

<head>
<title>Download</title>
  <link href="{{ asset('img/prod.png') }}" rel="icon">
  <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/asrul.css') }}" rel="stylesheet">
  </head>
  <body>

<div id="pcoded" class="pcoded">
  <div class="col-md-12 col-sm-12 col-xs-12">
		<div class="tab-content panel ">
      <div class="tab-pane active" id="1">
        @php
          $no = 0;
        @endphp
        @foreach($promoo as $promo)
        <div class="panel-default">
					<div class="panel-body badan">
						<label>PT. NUTRIFOOD INDONESIA</label>
						<center> <h2 style="font-size: 22px;font-weight: bold;">PENGEMBANGAN KONSEP AWAL PRODUK BARU</h2> </center>
  					<center> <h2 style="font-size: 20px;font-weight: bold;">( PKP PROMO )</h2> </center><br>
						<center> <h2 style="font-weight: bold;"> {{ $promo->brand }} &reg;</h2> </center>
            <center> <h2 style="font-weight: bold;">Project Name : {{ $promo->project_name }} </h2> </center>
            <div class="row">
              <table ALIGN="left">
                <tr>
                  <button><a href="{{route('approveemailpromo',$promo->id_pkp_promoo)}}" class="btn btn-info">Approve</a></button>
                  <button><a href="{{route('rejectemailpromo',$promo->id_pkp_promoo)}}" class="btn btn-info">Reject</a></button>
                </tr>
              </table>
            </div><br><br>
          </div>
						<table border="1" style="font-size:15px" class="table table-bordered">
              <tr>
                <td style="width:530px"><b>Author</td>
                <td colspan="2">{{$promo->datapromoo->author1->name}}</td>
              </tr>
              <tr>
                <td width="25%"><b>Last Upadate On</td>
                <td colspan="2">{{$promo->created_date}}</td>
              </tr>
              <tr>
                <td width="25%"><b>Revisi No</td>
                <td colspan="2">{{$promo->revisi}}.{{$promo->turunan}}</td>
              </tr>
              <tr>
                  <td style="width:530px"><b>Perevisi</td>
                  <td colspan="2">@if($promo->datapromoo->perevisi!=null){{$promo->datapromoo->perevisi1->name}}@endif</td>
                </tr>
              <tr>
                <td width="25%"><b>Country</td>
                <td colspan="2">{{$promo->country}}</td>
              </tr>
              <tr>
                <td width="25%"><b>Item Promo type</td>
                <td colspan="2">{{$promo->promo_type}}</td>
              </tr>
              <tr>
                <td width="25%"><b>Type</td>
                <td colspan="2">{{$promo->type}}</td>
              </tr>
              @endforeach
              <tr>
                <td width="25%"><b>Promo Idea</td>
                <?php $promo_idea = []; foreach ($promo1 as $key => $data)If (!$promo_idea || !in_array($data->promo_idea, $promo_idea)) {$promo_idea += array($key => $data->promo_idea);}?>
                <td colspan="2">	@foreach($promo_idea as $promo_idea){{$promo_idea}} <br>@endforeach</td>
              </tr>
              <tr>
                <td width="25%"><b>Dimension</td>
                <?php $dimension = []; foreach ($promo1 as $key => $data) If (!$dimension || !in_array($data->dimension, $dimension)) { $dimension += array( $key => $data->dimension );} ?>
                <td colspan="2">	@foreach($dimension as $dimension){{$dimension}} <br>@endforeach</td>
              </tr>
              <tr>
                <td width="25%"><b>Application</td>
                <?php $application = []; foreach ($promo1 as $key => $data) If (!$application || !in_array($data->application, $application)) { $application += array( $key => $data->application );}  ?>
                <td colspan="2">	@foreach($application as $application){{ $application }} <br>@endforeach</td>
              </tr>
              <tr class="table-highlight">
                <?php $promo_readiness = []; foreach ($promo1 as $key => $data) If (!$promo_readiness || !in_array($data->promo_readiness, $promo_readiness)) { $promo_readiness += array( $key => $data->promo_readiness );}  ?>
                <td width="25%"><b>Item Promo Readiness</td>
                <td colspan="2">	@foreach($promo_readiness as $promo_readiness){{ $promo_readiness }} <br>@endforeach</td>
              </tr>
              <tr>
                <td width="25%"><b>Related Picture</td>
                <td colspan="2">@foreach($picture as $pic)<embed src="{{asset('data_file/'.$pic->filename)}}" width="150px" height="170" type="">@endforeach</td>
              </tr>
            </table><br><br>
            <label for="">Product And Allocation :</label>
            <table border="1" style="font-size:15px" class="table table-striped table-bordered nowrap" id="table">
              <thead>
                <tr style="background-color:#13699a;color:white;">
                  <td>Product SKU Name</td>
                  <td>Allocation (pcs)</td>
                  <td>Remarks</td>
                  <td>Start</td>
                  <td>End</td>
                  <td>RTO</td>
                  <td>Opsi</td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><?php $product_sku = []; foreach ($app as $key => $data) If (!$product_sku || !in_array($data->product_sku, $product_sku)) { $product_sku += array( $key => $data->product_sku );
                  if($data->turunan!=$promo->turunan){ echo"<s><font color='#6594c5'>".$data->sku->nama_sku."<br></font></s>"; } if($data->turunan==$promo->turunan){ echo"".$data->sku->nama_sku."<br>"; } } ?></td>
                  <td><?php $allocation = []; foreach ($app as $key => $data) If (!$allocation || !in_array($data->allocation, $allocation)) { $allocation += array( $key => $data->allocation );
                  if($data->turunan!=$promo->turunan){ echo"<s><font color='#6594c5'>$data->allocation<br></font></s>"; } if($data->turunan==$promo->turunan){ echo"$data->allocation<br>"; } } ?></td>
                  <td><?php $remarks = []; foreach ($app as $key => $data) If (!$remarks || !in_array($data->remarks, $remarks)) { $remarks += array( $key => $data->remarks );
                  if($data->turunan!=$promo->turunan){ echo"<s><font color='#6594c5'>$data->remarks<br></font></s>"; } if($data->turunan==$promo->turunan){ echo"$data->remarks<br>"; } } ?></td>
                  <td><?php $start = []; foreach ($app as $key => $data) If (!$start || !in_array($data->start, $start)) { $start += array( $key => $data->start );
                  if($data->turunan!=$promo->turunan){ echo"<s><font color='#6594c5'>$data->start<br></font></s>"; } if($data->turunan==$promo->turunan){ echo"$data->start<br>"; } } ?></td>
                  <td><?php $end = []; foreach ($app as $key => $data) If (!$end || !in_array($data->end, $end)) { $end += array( $key => $data->end );
                  if($data->turunan!=$promo->turunan){ echo"<s><font color='#6594c5'>$data->end<br></font></s>"; } if($data->turunan==$promo->turunan){ echo"$data->end<br>"; } } ?></td>
                  <td><?php $rto = []; foreach ($app as $key => $data) If (!$rto || !in_array($data->rto, $rto)) { $rto += array( $key => $data->rto );
                  if($data->turunan!=$promo->turunan){ echo"<s><font color='#6594c5'>$data->rto<br></font></s>"; } if($data->turunan==$promo->turunan){ echo"$data->rto<br>"; } } ?></td>
                  <td><?php $opsi = []; foreach ($app as $key => $data) If (!$opsi || !in_array($data->opsi, $opsi)) { $opsi += array( $key => $data->opsi );
                  if($data->turunan!=$promo->turunan){ echo"<s><font color='#6594c5'>$data->opsi<br></font></s>"; } if($data->turunan==$promo->turunan){ echo"$data->opsi<br>"; } } ?></td>
                </tr>
              </tbody>
            </table>
      			<table ALIGN="right">
      				<tr><td>Revisi/Berlaku :  </td></tr>
        			<tr><td>Masa Berlaku : Selamanya</td></tr>
        		</table>
					</div>
				</div>
      </div>
    </div>
	</div>
</div>
</body>

</html>
<script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
<script>
  $(document).ready(function() {
    window.print()
  });
</script>
