@extends('admin.tempadmin')
@section('title', 'Edit Departement')
@section('judulhalaman','User Management')
@section('content')

<div class="x_panel">
  <div class="x_title">
      <h3><li class="fa fa-edit"> Edit Departement</li></h3>
  </div>
	<div class="card-block">
    <form method="POST" action="{{ route('storeupdatedept',$dept->id) }}">
      <label for="nama_produk" class="control-label">Departement</label>
      <input class="form-control" id="dept" name="dept" value="{{ $dept->dept }}" required />
      <label for="nama_produk" class="control-label">Keterangan</label>
      <input class="form-control" id="nama_dept" name="nama_dept" value="{{ $dept->nama_dept }}" required />
      <label for="nama_produk" class="control-label">Manager</label>
      <select id="manager" name="manager" class="form-control">
        <option selected disabled>--> Select One <--<option>
        @foreach($users as $user) 
        <option value="{{  $user->id }}" {{ ( $user->id == $dept->manager_id ) ? ' selected' : '' }}>{{ $user->role->namaRule }} - {{ $user->name }}</option>
        @endforeach
      </select><br><br>
      {{ csrf_field() }}
      {{ method_field('PATCH') }}
      <button class="btn btn-primary" type="submit"><i class="fa fa-edit"></i> Save</button>
      <a type="button" class="btn btn-danger" href="{{ route('dept') }}"><i class="fa fa-times"></i> Cencel</a>
    </form>
  </div>
</div>
@endsection

@section('s')
@endsection