@extends('layouts.app', ['page' => 'pengurusan-pengguna'])
@section('title', 'Pengurusan Pengguna')

@section('breadcrumb-items')
<li class="breadcrumb-item">Pengurusan Pengguna</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
         <div class="col-xl-12 box-col-12">
            <div class="card card-with-border">
                <div class="card-header">
                    <ul class="nav nav-pills nav-primary" role="tablist">
                        <li class="nav-item"><a class="nav-link btn btn-outline-light-dark btn-sm m-1 active" data-toggle="tab" href="#ref-kumpulan-kawalan">Kumpulan Kawalan</a></li>
                        <li class="nav-item"><a class="nav-link btn btn-outline-light-dark btn-sm m-1" data-toggle="tab" href="#ref-kawalan-sistem">Kawalan Sistem</a></li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content mt-3">

                        <div class="tab-pane fade show active" id="ref-kumpulan-kawalan" role="tabpanel">
                            @include('datatable.kumpulan-kawalan')
                        </div>

                        <div class="tab-pane fade" id="ref-kawalan-sistem" role="tabpanel">
                            @include('datatable.kawalan-sistem')
                        </div>
                    </div>
                </div>
            </div>
         </div>
    </div>
</div>
@endsection
