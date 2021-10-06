@extends('layouts.print')
@section('title', 'SENARAI CALON DIBATALKAN')

@section('content')

<table>
    <thead>
        <tr>
            <td>
                <div class="header-space">
                    <div class="container">
                        <div class="paparan-sahaja mb-4">
                            <!-- <button type="button" onClick="window.close()" class="btn btn-white">
                                Tutup
                            </button> -->
                            <button type="button" onClick="window.print()" class="btn btn-primary">
                                <i class="fa fa-print"></i> Cetak
                            </button>
                        </div>
                        <div class="paparan-sahaja">
                            <div class="col-sm-3">
                                Tarikh  : @php echo date('d-m-Y'); @endphp
                            </div>
                            <div class="col-sm-3">
                                Masa    : @php date_default_timezone_set('Asia/Kuala_Lumpur'); echo date('g:i a'); @endphp
                            </div>
                            <div class="col-sm-3">
                                LAPORAN B09/06-2021
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <strong>LEMBAGA PEPERIKSAAN</strong>
                            </div>
                            <div class="col-md-12 text-center">
                                <strong>KEMENTERIAN PENDIDIKAN MALAYSIA</strong>
                            </div>
                            <div class="col-md-12 text-center">
                                <strong>{{$exam}}</strong>
                            </div>
                            <div class="col-md-12 mt-6 text-center">
                                <b>SENARAI CALON DIBATALKAN</b>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    </thead>
</table>
<br><br>
<div class="col-sm-3">
</div>
<table class="table table-border">
    <thead>
        <tr>
            <th width="5%">BIL</th>
            <th width="5%">NAMA CALON</th>
            <th width="5%">ANGKA GILIRAN</th>
            <th width="5%">KOD PUSAT</th>
            <th width="5%">NAMA PUSAT</th>
            <th width="5%">JENIS PENDAFTARAN CALON</th>
            <th width="5%">NO KAD PENGENALAN / PASSPORT</th>
            <th width="5%">NO TELEFON</th>
        </tr>
    </thead>
    @foreach($calonDibatalkan as $key => $calon)
    <tbody>
        <tr> 
            <td>{{$key + 1}}</td>
            <td>{{ $calon->nama ?? '-' }}</td>
            <td>{{ $calon->angka_giliran ?? '-' }}</td>
            <td>{{ $calon->pusat->kod_pusat ?? '-' }}</td>
            <td>{{ $calon->pusat->nama_pusat ?? '-' }}</td>
            <td>{{ $calon->JenisPendaftaran->keterangan ?? '-' }}</td>
            <td>{{ $calon->no_kad_pengenalan ?? $calon->no_pengenalan_lain ?? '-' }}</td>
            <td>{{ $calon->no_telefon ?? '-' }}</td>
            
        </tr>
    </tbody>
    @endforeach
</table>

@endsection
