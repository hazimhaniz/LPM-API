<!DOCTYPE html>
<html lang="en">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="Penyelenggaraan for Lembaga Peperiksaan Malaysia manage an application inside application">
      <meta name="author" content="RRSB">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <link rel="icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon">
      <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon">
      <title>@yield('title') - Penyelenggaraan</title>
      @include('layouts.css')
      @yield('style')
   </head>
   <body>
      <div class="loader-wrapper">
         <div class="theme-loader"></div>
      </div>
      <div class="page-wrapper compact-wrapper" id="pageWrapper">
         @include('layouts.header', ['menu' => 'false'])
         <div class="pt-3">
            <div class="page-body">
               @role('Developer')
                <div class="container-fluid">
                  <div class="page-header">
                     <div class="row">
                        <div class="col-lg-12">
                           <ol class="breadcrumb">
                              <li class="breadcrumb-item">
                                <a href="{{route('console.index')}}"><i class="f-16 fa fa-home"></i></a>
                              </li>
                              <li class="breadcrumb-item">
                                <a href="{{route('console.index')}}">Konsol</a>
                              </li>
                              @yield('breadcrumb-items')
                           </ol>
                           @yield('breadcrumb-title')
                        </div>
                     </div>
                  </div>
               </div>
               @endrole
               @yield('content')
            </div>
         </div>
      </div>
      @include('layouts.script')
   </body>
</html>
