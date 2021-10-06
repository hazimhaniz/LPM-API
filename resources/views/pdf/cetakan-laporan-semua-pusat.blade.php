@extends('layouts.print')
@section('title', 'SENARAI PUSAT DAN SEKOLAH')

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
                                <strong>SIJIL TINGGI AGAMA MALAYSIA 2020</strong>
                            </div>
                            <div class="col-md-12 mt-6 text-center">
                                <b>SENARAI PUSAT DAN SEKOLAH</b>
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
    <p>Negeri: PERAK</p>
</div>
<table class="table table-border">
    <thead>
        <tr>
            <th width="5%">BIL</th>
            <th width="5%">NO SEK</th>
            <th>NO PUSAT</th>
            <th width="5%">JENIS CALON</th>
            <th width="30%">NAMA PUSAT/SEKOLAH</th>
            <th>KOD SEKOLAH</th>
            <th width="5%">JUMLAH CALON</th>
            <th width="20%">JULAT NO CALON MULA - AKHIR</th>
        </tr>
    </thead>
    @foreach($pusats as $key => $pusat)
    <tbody>
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $pusat->no_sekolah ?? '-' }}</td>
            <td>{{ $pusat->kod_pusat ?? '-' }}</td>
            @if ( $pusat->id_jenis_calon == '1' )
                <td>S</td>
            @elseif ( $pusat->id_jenis_calon == '2' )
                <td>T</td>
            @elseif ( $pusat->id_jenis_calon == '3' )
                <td>V</td>
            @elseif ( $pusat->id_jenis_calon == '4' )
                <td>W</td>
            @elseif ( $pusat->id_jenis_calon == '5' )
                <td>X</td>
            @else
                <td>-</td>
            @endif
            <td>{{ $pusat->nama_pusat ?? '-' }}</td>
            <td>1</td>
            <td>{{ $pusat->jumlah_calon ?? '-' }}</td>
            <td>1</td>
        </tr>
    </tbody>
    @endforeach
</table>

@endsection
