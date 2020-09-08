@extends('_layout.base')

@section('css')
    @parent    
    <link href="{{ asset('css/panel.css') }}" rel="stylesheet">
    
@stop

@section('content')
<div class="panel panel-primary">
  <div class="panel-heading">
    <h3><i class="fa fa-list-alt"></i> Edit User</h3>
  </div>
  <div class="panel-body">
  	<form action="{{ route('user_update', $user->id) }}" method="post" enctype="multipart/form-data">
      {!! csrf_field() !!}
      <input type="hidden" name="_method" value="PATCH">

  		<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} {{ Session::has('gagal_email') ? ' has-error' : '' }}">
        <label for="email" class="control-label">Alamat E-Mail</label>
        <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required autofocus>
        @if(Session::has('gagal_email'))
          <span class="help-block">
              <strong>{{ Session::get('gagal_email') }}</strong>
          </span>
        @endif 
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
      </div>

      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="control-label">Nama</label>
        <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required>

        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
      </div>

      <div class="form-group{{ $errors->has('nim') ? ' has-error' : '' }}">
          <label for="nim" class="control-label">
            @if($user->id < 6)
              NIK
            @else
              NIM
            @endif
          </label>
          <input id="nim" type="text" class="form-control" name="nim" value="{{ $user->nim }}" required>

          @if ($errors->has('nim'))
              <span class="help-block">
                  <strong>{{ $errors->first('nim') }}</strong>
              </span>
          @endif
      </div>

      <div class="form-group{{ $errors->has('prodi') ? ' has-error' : '' }}">
          @if($user->id < 6)
            <label for="prodi" class="control-label">Jabatan</label>
            <input id="prodi" type="text" class="form-control" name="prodi" value="{{ $user->prodi }}" required disabled>
          @else
            <label for="ps_id" class="control-label">Program Studi</label>            
            <select id="ps_id" name="ps_id" class="form-control" required>    
              @foreach($prodi_list as $prodi)
              <option value="{{ $prodi->id }}" @if('$user->ps->id == $prodi->id') selected @endif>
                {{ $prodi->nama }}
              </option>
              @endforeach  
            </select>
            @if ($errors->has('ps_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('ps_id') }}</strong>
                </span>
            @endif            
          @endif      

          @if ($errors->has('prodi'))
              <span class="help-block">
                  <strong>{{ $errors->first('prodi') }}</strong>
              </span>
          @endif
      </div>      
      <div class="form-group{{ $errors->has('telepon') ? ' has-error' : '' }}">
              <label for="telepon" class="control-label">Nomor Telepon</label>
              <input id="telepon" type="text" class="form-control" name="telepon" value="{{ $user->telepon }}" required>
              @if ($errors->has('telepon'))
                  <span class="help-block">
                      <strong>{{ $errors->first('telepon') }}</strong>
                  </span>
              @endif
              </div>
          </div>
      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} col-md-12">
          <label for="password" class="control-label">Password</label>
          <input id="password" type="password" class="form-control" name="password" placeholder="Kosongkan jika tidak ingin mengubah password">

          @if ($errors->has('password'))
              <span class="help-block">
                  <strong>{{ $errors->first('password') }}</strong>
              </span>
          @endif
      </div>

      <div class="form-group col-md-12 {{ Session::has('gagal_konfirm') ? ' has-error' : '' }}"  >
        <label for="password-confirm" class="control-label">Konfirmasi Password</label>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
        @if(Session::has('gagal_konfirm'))
          <span class="help-block">
              <strong>{{ Session::get('gagal_konfirm') }}</strong>
          </span>
        @endif 
      </div>

      <div class="form-group">
          <div class="col-md-6 ">
              <button type="submit" class="btn btn-primary">
                  Update
              </button>
          </div>
      </div>  		
  	</form>
  </div>
 </div>
@stop

@section('js')
  @parent 
  
@stop