@extends('layouts.app', ['page' => 'selenggara-data'])
@section('title', 'Selenggara Data')

@section('breadcrumb-items')
<li class="breadcrumb-item">Selenggara Data</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
         <div class="col-xl-12 box-col-12">
            <div class="card card-with-border">
                <div class="card-header">
                    <ul class="nav nav-pills nav-primary" role="tablist">
                        <li class="nav-item"><a class="nav-link btn btn-outline-light-dark btn-sm m-1 active" data-toggle="tab" href="#datatable-jenis-peperiksaan">Jenis Peperiksaan</a></li>
                        <li class="nav-item"><a class="nav-link btn btn-outline-light-dark btn-sm m-1" data-toggle="tab" href="#datatable-agama">Agama</a></li>
                        <li class="nav-item"><a class="nav-link btn btn-outline-light-dark btn-sm m-1" data-toggle="tab" href="#datatable-negeri">Negeri</a></li>
                        <li class="nav-item"><a class="nav-link btn btn-outline-light-dark btn-sm m-1" data-toggle="tab" href="#datatable-dun">DUN</a></li>
                        <li class="nav-item"><a class="nav-link btn btn-outline-light-dark btn-sm m-1" data-toggle="tab" href="#datatable-parlimen">Parlimen</a></li>
                        <li class="nav-item"><a class="nav-link btn btn-outline-light-dark btn-sm m-1" data-toggle="tab" href="#datatable-bandar">Bandar</a></li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="datatable-jenis-peperiksaan">
                                    @include('datatable.jenis-peperiksaan')
                                </div>
                                <div class="tab-pane fade show" id="datatable-agama">
                                    @include('datatable.agama')
                                </div>
                                <div class="tab-pane fade show" id="datatable-bandar">
                                    @include('datatable.bandar')
                                </div>
                                <div class="tab-pane fade show" id="datatable-dun">
                                    @include('datatable.dun')
                                </div>
                                <div class="tab-pane fade show" id="datatable-parlimen">
                                    @include('datatable.parlimen')
                                </div>
                                <div class="tab-pane fade show" id="datatable-negeri">
                                    @include('datatable.negeri')
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
