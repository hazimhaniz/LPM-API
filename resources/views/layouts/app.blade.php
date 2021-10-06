<!DOCTYPE html>
<html lang="en">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="Sistem Pengurusan Peperiksaan Atas Talian LPM">
      <meta name="keywords" content="Sistem Pengurusan Peperiksaan Atas Talian LPM">
      <meta name="author" content="LPM">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <link rel="icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon">
      <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon">
      <title>@yield('title') - Penyelenggaraan</title>
      @include('layouts.css')
      @yield('style')
   </head>
   <body>

      <!-- Loader starts-->
      <div class="loader-wrapper">
         <div class="theme-loader"></div>
      </div>
      <!-- Loader ends-->

      <!-- page-wrapper Start-->
      <div class="page-wrapper" id="pageWrapper">

         <!-- Page Body Start-->
         <div class="page-body-wrapper">


            @include('layouts.sidebar')

            <!-- Page Sidebar Ends-->
            <div class="page-body">

         <!-- Page Header Start-->
         @include('layouts.header')
         <!-- Page Header Ends -->

               <div class="container-fluid">
                  <div class="page-header">
                     <div class="row">
                        <div class="col-lg-6">
                           <ol class="breadcrumb">
                              <li class="breadcrumb-item">
                                  <a href="{{route('console.index')}}"><i class="f-16 fa fa-home"></i></a>
                                </li>
                              @yield('breadcrumb-items')
                           </ol>
                           @yield('breadcrumb-title')
                        </div>
                     </div>
                  </div>
               </div>
               <div id="app">
                    <!-- Container-fluid starts-->
                    @yield('content')
                    <!-- Container-fluid Ends-->
               </div>

            </div>

            <!-- footer start-->
            @include('layouts.footer')

         </div>
      </div>

      @yield('popup')

      @include('layouts.script')

   </body>
</html>
