@extends('layouts.guest')

@section('content')
<div class="login-box">
      <div class="login-logo">
        <a href="#"><img src=""><img src="{{ asset("images/logoz.png")}}" style="width:40px;"><b>Itenas</b>Kewirausahaan</a>
      </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
          <h2 class="login-box-msg">Daftar</h2>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group has-feedback">
                            <input  id="name" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" placeholder="Nama" value="{{ old('nama') }}" required autocomplete="nama">
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>  
                            @error('nama')
                                <small class="invalid-feedback" role="alert" style="color:#cc0001;">
                                        <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>

                        {{-- <textarea class="form-control @error('address') is-invalid @enderror" style="resize: none;" rows="5" name="address" placeholder="Address"  value="" required >{{ old('address') }}</textarea>
                        @error('address')
                            <small class="invalid-feedback" role="alert" style="color:#cc0001;">
                                    <strong>{{ $message }}</strong>
                            </small>
                        @enderror 
                        <br>--}}
                        <script>
                            function isNumberKey(evt)
                            {
                                var charCode = (evt.which) ? evt.which : event.keyCode
                                if (charCode > 31 && (charCode < 48 || charCode > 57))
                                    return false;

                                return true;
                            }
                        </script>
                        <div class="form-group has-feedback">
                            <input id="nim" type="text" class="form-control @error('nim') is-invalid @enderror" onkeypress="return isNumberKey(event)" name="nim" maxlength="9" placeholder="NIM"  value="{{ old('nim') }}" required autocomplete="nim">
                            <span class="glyphicon glyphicon-tag form-control-feedback"></span>  
                            @error('nim')
                                <small class="invalid-feedback" role="alert" style="color:#cc0001;">
                                        <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>
                        
                        <div class="form-group has-feedback">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email"  value="{{ old('email') }}" required autocomplete="email">
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>  
                                @error('email')
                                    <small class="invalid-feedback" role="alert" style="color:#cc0001;">
                                            <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                        </div>

                        <div class="form-group has-feedback">
                            <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" placeholder="Username"  value="{{ old('username') }}" required autocomplete="username">
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>  
                            @error('username')
                                <small class="invalid-feedback" role="alert" style="color:#cc0001;">
                                        <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                    </div>
                        
                        <div class="form-group has-feedback">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="new-password">
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>  
                                @error('password')
                                    <small class="invalid-feedback" role="alert" style="color:#cc0001;">
                                            <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                        </div>

                        <div class="form-group has-feedback">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Password Confirmation" required autocomplete="new-password">
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>  
                                @error('password')
                                    <small class="invalid-feedback" role="alert" style="color:#cc0001;">
                                            <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                        </div>

                       
                        <div class="form-group row mb-0">
                            <div class="col-md-12 ">
                                <button type="submit" class="btn btn-primary" style="width:100% !important">
                                    Daftar
                                </button>
                            </div>
                        </div>
                    </form>
                    <a href="{{ route("login") }}" class="btn btn-success btn-flat" style="width:100% !important">Log in</a>
                
                  </div>
@endsection
