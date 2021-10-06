@extends('layouts.authentication.master')
@section('title', 'Coming Soon')

@section('css')
@endsection

@section('style')
@endsection

@section('content')
<div class="page-wrapper compact-wrapper" id="pageWrapper">
   <!-- Page Body Start-->
   <div class="container-fluid p-0">
      <div class="comingsoon">
         <div class="comingsoon-inner text-center">
            <img src="{{asset('assets/images/email-template/success.png')}}" alt="">
            <h5>Pengesahan Permohonan Pusat Lewat</h5>
            <p><strong>{{ $pusat->nama_pusat }}</strong></p>
            <p>Dimaklumkan bahawa anda telah mengesahkan permohonan pusat lewat bagi pusat yang tertulis diatas.</p>
         </div>
      </div>
   </div>
</div>
@endsection

@section('script')
<script src="{{asset('assets/js/countdown.js')}}"></script>
@endsection
