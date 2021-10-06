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
            <h5>Akaun Anda Berjaya Diaktifkan</h5>
            <p>Hi {{ $details['nama'] ?? '' }}, Sila klik pautan di bawah untuk Log Masuk:</p>
            <p style="text-align: center">

                @if($calon->id_peperiksaan == 1)
                <a href="https://pt3.rania.dev/login" style="padding: 10px; background-color: #4F5B80; color: #fff; display: inline-block; border-radius: 4px">
                   Log Masuk
                </a>
               @else
                <a href="https://stam.rania.dev/login" style="padding: 10px; background-color: #4F5B80; color: #fff; display: inline-block; border-radius: 4px">
                    Log Masuk
                </a>
                @endif
           </p>
         </div>
      </div>
   </div>
</div>
@endsection

@section('script')
<script src="{{asset('assets/js/countdown.js')}}"></script>
@endsection
