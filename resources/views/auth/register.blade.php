@extends('layouts.guest')

@section('content')
<div class="login-box">
        <div class="login-logo">
          <a href="#"><b>Member</b>Area</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
          <p class="login-box-msg">Register</p>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group has-feedback">
                            <input  id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Name" value="{{ old('name') }}" required autocomplete="name">
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>  
                            @error('name')
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

                        <div class="form-group has-feedback">
                                <select class="form-control" required name="pack"> 
                                    <option value="" @if(old("pack") == "") selected @endif disabled >-- Select Package --</option>
                                    @foreach ($packs as $pack)
                                    <option @if(old("pack") == "$pack->id-".$pack->app->id) selected @endif value="{{ $pack->id }}-{{ $pack->app->id }}">[{{ $pack->app->name }}] {{ $pack->name }} - Rp {{ number_format($pack->price) }} ( {{ $pack->total_license }} License )</option>
                                    @endforeach
                                </select>
                                <span class="glyphicon glyphicon-key form-control-feedback"></span>  
                                @error('pack')
                                    <small class="invalid-feedback" role="alert" style="color:#cc0001;">
                                            <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                        </div>
                       
                        <div class="form-group row mb-0">
                            <div class="col-md-12 ">
                                <button type="submit" class="btn btn-primary" style="width:100% !important">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <a href="{{ route("login") }}" class="btn btn-success btn-flat" style="width:100% !important">Sign In</a>
                
                  </div>
@endsection
