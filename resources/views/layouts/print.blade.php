<!DOCTYPE html>
<html lang="en">
<head>
  <title>@yield('title') - Penyelenggaraan</title>
  <meta charset="utf-8">
@include('layouts.css')
  <link rel="stylesheet" href="{{asset('assets/css/print.css')}}">

</head>
<body>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>

