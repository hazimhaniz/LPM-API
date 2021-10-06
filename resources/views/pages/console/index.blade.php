@extends('layouts.app', ['page' => 'konsol'])
@section('title', 'Dashboard')

@section('breadcrumb-items')
<li class="breadcrumb-item">Konsol</li>
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-xl-12 box-col-12">
      <div class="card card-with-border shadow shadow-showcase">
        <div class="card-header txt-primary"> <h5>Penyelenggaraan Application</h5> <span class="txt-primary">Sistem Pengurusan Peperiksaan Atas Talian</span></div>
          <div class="card-body">
            <div class="container">
              <div class="row">
                @foreach ($peperiksaans as $peperiksaan)
                  <div class="col-xl-6 col-lg-6 box-col-6 mt-3">
                    <div class="card card-with-border shadow-sm shadow-showcase">
                      <div class="card-body">
                        <h1 class="pt-3 text-center f-w-900"> <a class="txt-primary" href="{{ route( 'peperiksaan.dashboard' , $peperiksaan->keterangan ) }}">{{ $peperiksaan->keterangan }}</a> </h1>
                          <p class="text-center f-w-600 txt-primary">{{ $peperiksaan->keterangan_panjang }}</p>
                            <p class="pb-4 text-center"> <a href="{{ route( 'peperiksaan.dashboard' , $peperiksaan->keterangan ) }}" class="btn btn-primary btn-sm p-1 pl-3 pr-2 text-white">  KEMASKINI <i class="icon-arrow-circle-right text-white"></i></a> </p>
                              <div class="b-b-light mt-3 mb-3"></div>
                                <div class="according-menu"> <a href="#" data-original-title="Menu"> <i class="fa fa-ellipsis-v"></i></a> </div>
                              <div class="row">
                            <div class="col text-center b-r-light"> <span>status</span> <h5 class="txt-primary mb-0 mt-1">{{ $peperiksaan->status ? 'Aktif' : 'Tidak Aktif' }}</h5> </div>
                          <div class="col text-center"> <span>Kod</span> <h5 class="txt-primary mb-0 mt-1">{{ $peperiksaan->keterangan }}</h5></div>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection