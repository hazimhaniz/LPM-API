@extends('layouts.authentication.master')
{{-- 2d2c2c --}}

{{-- 655af2 --}}
{{-- 665af3 --}}
@section('content')
<div class="page-wrapper">
    <div class="container-fluid p-0">
       <div class="authentication-main">
          <div class="row">
             <div class="col-md-12">
                <div class="auth-innerright">
                   <div class="authentication-box">
                      <div class="card mt-4">
                            <div class="card-body">
                                <div class="cont text-center-sm  shadow shadow-showcase">
                                <div>
                                    <form method="POST" action="{{ route('login') }}" class="theme-form">
                                        <h4 class="text-center">LOG MASUK</h4>
                                        <p class="text-center mt-3">
                                            Sila masukkan Emel dan Kata Laluan untuk<br>memasuki laman.
                                        </p>
                                        @csrf
                                        <div class="form-group text-left mt-3">
                                            <div class="col-lg-10 offset-lg-1">
                                                <label for="email" class="col-form-label">
                                                    {{ __('E-Mail') }}
                                                </label>
                                                <input id="email" type="email" class="form-control  text-center @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Sila masukkan Email" required autocomplete="email" autofocus>
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group text-left">
                                            <div class="col-lg-10 offset-lg-1">
                                                <label for="password" class="col-form-label">{{ __('Kata Laluan') }}</label>
                                                <input id="password" type="password" class="form-control text-center @error('password') is-invalid @enderror" name="password" placeholder="Sila masukkan kata laluan" required autocomplete="current-password">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group text-center mt-5">
                                            <button type="submit" class="btn btn-pill btn-primary btn-air-primary text-white">
                                                <i class="icon-unlock mr-1"></i> {{ __('Log Masuk') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="sub-cont1 d-none d-lg-block">
                                    <div class="img" >
                                    <div class="img__text">
                                        <img src="{{asset('assets/images/kpm_logo.png')}}" />
                                        <hr>
                                        <h5 class="m-3 mt-4">Penyelenggaraan</h5>
                                        <p>Sistem Pengurusan Peperiksaan Atas Talian</p>
                                    </div>
                                    </div>
                                    </div>
                                </div>
                                <p class="text-center mt-5">
                                    <span class=" d-sm-inline-block">
                                        &copy; {{date('Y')}}  - Lembaga Peperiksaan Malaysia
                                        <br />
                                        Sistem Pengurusan Peperiksaan Atas Talian Version 2.0
                                    </span>
                                </p>
                                </div>
                            </div>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
@endsection
