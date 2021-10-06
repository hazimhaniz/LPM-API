@extends('layouts.main')
@section('title', 'Penyelenggaran Peperiksaan Tahun ' .  $tahunPeperiksaan->tahun)

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('peperiksaan.dashboard',  $tahunPeperiksaan->peperiksaan->keterangan) }}">{{ $tahunPeperiksaan->peperiksaan->keterangan }}</a></li>
    <li class="breadcrumb-item"><b>{{ $tahunPeperiksaan->tahun }}</b></li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-with-border">
                    <div class="card-header">
                        <div class="row">
                            <div class="mt-2">
                                <a href="{{ route('peperiksaan.dashboard', $tahunPeperiksaan->peperiksaan->keterangan) }}">
                                    <i data-feather="chevron-left"></i>
                                </a>
                            </div>
                            <div class="col-lg-10 m0-5">
                                <h2 class="f-w-900">{{ $tahunPeperiksaan->tahun }}</h2>
                                <span class="f-w-600">{{ $tahunPeperiksaan->peperiksaan->keterangan }} | {{ $tahunPeperiksaan->peperiksaan->keterangan_panjang }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="b-b-light"></div>
                    <div class="card-body px-2">
                        <div class="container-fluid">
                            <div class="row">
                                  <div class="col-xl-3 col-lg-4 col-md-5 nav-md-mt mb-3">
                                    <div class="card card-with-border default-according faq-accordion job-accordion" id="accordionoc">
                                      <div class="tabs-responsive-side">
                                        <div class="nav flex-column nav-pills border-tab nav-left" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                          @include('pages.tahun_peperiksaan.menus.sidebar')
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-xl-9 col-lg-8 col-md-7 nav-md-mt">
                                    <div class="row">
                                        <div class="col-xl-12 ">
                                            <div class="tab-content" id="v-pills-tabContent">
                                                <div class="tab-pane fade show active" id="menu-capaian-pengguna">
                                                    Capaian Pengguna (Kertas)
                                                </div>
                                                <div class="tab-pane fade" id="menu-pengurusan-jadual">
                                                    @include('pages.tahun_peperiksaan.menus.pengurusan_jadual')
                                                </div>
                                                <div class="tab-pane fade" id="menu-pengurusan-mata-pelajaran">
                                                    @include('datatable.mata-pelajaran')
                                                </div>
                                                <div class="tab-pane fade" id="menu-pengurusan-kertas-peperiksaan">
                                                    @include('datatable.kertas-peperiksaan')
                                                </div>
                                                <div class="tab-pane fade" id="menu-jejak-audit">
                                                    Jejak Audit
                                                </div>
                                                <div class="tab-pane fade" id="menu-sekolah">
                                                    @include('datatable.sekolah')
                                                </div>
                                                <div class="tab-pane fade" id="menu-pusat">
                                                    @include('datatable.pusat')
                                                </div>
                                                <div class="tab-pane fade" id="menu-ppd">
                                                    @include('datatable.ppd')
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

