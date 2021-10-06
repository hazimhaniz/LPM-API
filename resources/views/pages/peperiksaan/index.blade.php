@extends('layouts.main')
@section('title', 'Penyelenggaran Peperiksaan')

@section('breadcrumb-items')
    <li class="breadcrumb-item"><b>{{ $peperiksaan->keterangan }}</b></li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-with-border">
                    <div class="card-header">
                        <div class="row">
                            <div class="mt-2">
                                <a href="{{ route('console.index') }}">
                                    <i data-feather="chevron-left"></i>
                                </a>
                            </div>
                            <div class="col-md-10">
                                <h2 class="f-w-900">{{ $peperiksaan->keterangan }}</h2>
                                <span class="f-w-600">{{ $peperiksaan->keterangan_panjang }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-2">
                        <div class="container-fluid">
                            <div class="row">
                               <div class="col-xl-3 col-lg-4 col-md-5 nav-md-mt mb-3">
                                  <div class="card card-with-border default-according faq-accordion job-accordion" id="accordionoc">
                                    <div class="tabs-responsive-side">
                                       <div class="nav flex-column nav-pills border-tab nav-left" role="tablist" aria-orientation="vertical">
                                            @include('pages.peperiksaan.menus.sidebar')
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-xl-9 col-lg-8 col-md-7 nav-md-mt">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="tab-content">
                                                <div class="tab-pane fade show active" id="menu-tahun-peperiksaan">
                                                    @include('pages.peperiksaan.menus.tahun_peperiksaan')
                                                </div>
                                                <div class="tab-pane fade show" id="menu-selenggara-data">
                                                    @include('pages.peperiksaan.menus.selenggara_data')
                                                </div>
                                                <div class="tab-pane fade" id="menu-pengguna">
                                                    @include('pages.peperiksaan.menus.pengguna')
                                                </div>
                                                <div class="tab-pane fade" id="menu-jejak-audit">
                                                    Jejak Audit
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
    </div>
@endsection


