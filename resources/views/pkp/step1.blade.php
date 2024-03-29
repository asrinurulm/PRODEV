@extends('pv.tempvv')

@section('title', 'Request PKP')

@section('judulhalaman','Request PKP')

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

<div class="row">
  @include('formerrors')
  <div class="col-md-3"></div>
  <div class="col-md-8">
    <div class="tabbable">
      <ul class="nav nav-tabs wizard">
        <li class="completed"><a href="" ><span class="nmbr">1</span>Information</a></li>
        <li class="active"><a href=""><span class="nmbr">2</span>PKP</a></li>
        <li class="active"><a href=""><span class="nmbr">3</span>File & Image</a></li>
      </ul>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12 col-xs-12">
    <table class="table table-bordered">
      <tr style="font-weight: bold;color:white;background-color: #2a3f54;">
        <td>Mandatory Information</td>
        <td>* : Filled by Marketing</td>
        <td>^ : Filled By PV</td>
        <td>** : Filled by Marketing Or PV</td>
      </tr>
    </table>
  </div>
</div>

@foreach($pkp as $pkp)
<div class="">
  <form class="form-horizontal form-label-left" method="POST" action="{{ Route('updatest1',['id_pkp' => $pkp->id_pkp, 'revisi' => $pkp->revisi, 'turunan' => $pkp->turunan]) }}" novalidate>       
  <div class="row">
    <div class="col-md-6 col-xs-12">
      <div class="x_panel" style="min-height:240px">
        <div class="x_title">
          <h3><li class="fa fa-file-archive-o"></li> Project</h3>
        </div>
        <div class="card-block">
          <div class="x_content">
            <div class="col-md-12 col-xs-12">
              <div class="form-group row">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" style="color:#258039">Created Date</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input disabled value="{{$pkp->datapkpp->created_date}}" id="last" class="form-control col-md-12 col-xs-12" name="last" required="required" type="text">
                </div>
              </div>
              <div class="form-group row">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" style="color:#258039">Versi</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input id="revisi" value="{{$pkp->revisi}}.{{$pkp->turunan}}" disabled class="form-control col-md-12 col-xs-12" type="text" name="revisi">
                </div>
              </div>
              <div class="form-group row">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" style="color:#258039">Type</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                @if($pkp->datapkpp->type==1)
                  <input id="type" value="Maklon" disabled class="form-control col-md-12 col-xs-12" type="text" name="revisi">
                @elseif($pkp->datapkpp->type==2)
                  <input id="type" value="Internal" disabled class="form-control col-md-12 col-xs-12" type="text" name="revisi">
                @elseif($pkp->datapkpp->type==3)
                  <input id="type" value="Maklon/Internal" disabled class="form-control col-md-12 col-xs-12" type="text" name="revisi">
                @endif
                </div>
              </div>
            </div>
          </div>
        </div>  
      </div>      
    </div>  
    <div class="col-md-6 col-xs-12">
      <div class="x_panel" style="min-height:240px">
        <div class="x_title">
          <h3><li class="fa fa-file-archive-o"></li> Project</h3>
        </div>
        <div class="form-group row">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" style="color:#258039">Project Name*</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input id="name" value="{{ $pkp->datapkpp->project_name }}" class="form-control col-md-12 col-xs-12" type="text" name="name" required>
          </div>
        </div>
        <input type="hidden" value="{{$pkp->datapkpp->edit}}" name="edit" id="edit">
        <div class="form-group row">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" style="color:#258039">Brand *</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select name="brand" id=" brand" class="form-control">
              <option value="{{ $pkp->datapkpp->id_brand }}">{{ $pkp->datapkpp->id_brand }}</option>
              @foreach($brand as $br)
              <option value="{{$br->brand}}">{{$br->brand}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" style="color:#258039">Jenis</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select name="jenis" id="jenis" class="form-control">
              <option value="{{$pkp->datapkpp->jenis}}">{{$pkp->datapkpp->jenis}}</option>
              @foreach($type as $type)
              <option value="{{$type->jenis_menu}}">{{$type->jenis_menu}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <input id="author" disabled value="{{ $pkp->datapkpp->author }}" class="form-control col-md-12 col-xs-12" type="hidden" name="author">
				<?php $last = Date('j-F-Y'); ?>
        <input id="perevisi" value="{{ Auth::user()->id }}" class="form-control col-md-12 col-xs-12" type="hidden" name="perevisi">
		  	<input id="last_up" value="{{ $last }}" class="form-control col-md-12 col-xs-12" type="hidden" name="last_up">
      </div>
    </div>
  </div>
</div> 
<div class="x_panel">
  <div class="card-block col-md-6 col-md-offset-5">
    <button type="submit" class="btn btn-primary">Save And Next</button>
    {{ csrf_field() }}
  </div>
</div>
@endforeach
</form>              
@endsection