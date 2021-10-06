@extends('layouts.main')
@section('title', 'info')


@section('content')
<!-- error-500 start-->
<div class="error-wrapper">
  <div class="container">
    <div class="error-heading">
      <h2 class="headline font-primary">Maaf!</h2>
    </div>
    <div class="col-md-8 offset-md-2">
      <p class="sub-content">Pengguna tidak mempunyai peranan yang betul.</p>
    </div>
    <div>
        <a class="btn btn-primary btn-lg" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i data-feather="log-in"></i> Log Keluar
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
  </div>
</div>
<!-- error-500 end-->
@endsection

@section('script')
@endsection
