@extends('layouts.print')
@section('title', 'Label Meja')

@section('content')

<div class="mb-3 paparan-sahaja">
    <button type="button" onClick="window.close()" class="btn btn-white">
        Tutup
    </button>
    <button type="button" onClick="window.print()" class="btn btn-primary">
        <i class="fa fa-print"></i> Cetak
    </button>
</div>
<table>
    <thead>
        <tr>
            <td>
                <div class="header-space">
                    <div class="row">
                        <div class="text-left col-md-3">
                            Tarikh : {{ \Carbon\Carbon::now()->format('d.m.Y') }}
                            <br>
                            Masa  : {{ \Carbon\Carbon::now()->format('H:i:s') }}
                        </div>
                        <div class="text-center col-md-6">
                            <img src="{{asset('assets/images/logo-KPM.png')}}"  height="60"/>
                        </div>
                        <div class="text-right col-md-3">
                            No Siri: {{ $calon->id }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="mt-3 text-center col-md-12">
                            LEMBAGA PEPERIKSAAN
                        </div>
                        <div class="text-center col-md-12">
                            <small><b>SIJIL TINGGI AGAMA MALAYSIA</b></small>
                        </div>
                        <div class="text-center col-md-12">
                            <small>TAHUN PEPERIKSAAN {{ \Carbon\Carbon::now()->format('Y') }}</small>
                        </div>

                        <div class="mt-3 text-center col-md-12">
                            <strong>KENYATAAN KEMASUKAN PEPERIKSAAN</strong>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <div class="row">
                    <div class="col-sm-3">
                        Nama Sekolah / Pusat
                    </div>
                    <div class="text-left col-sm-9">
                        : {{ $calon->pusat->sekolah->nama_sekolah ?? '-' }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        No. Kelas
                    </div>
                    <div class="text-left col-sm-9">
                        : {{ $calon->permohonan->no_kelas ?? '-' }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        Angka Giliran
                    </div>
                    <div class="text-left col-sm-9">
                        : {{ $calon->angka_giliran ?? '-' }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        Nama Calon
                    </div>
                    <div class="text-left col-sm-9">
                        : {{ Str::upper($calon->nama ?? '-') }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        Tarikh Lahir
                    </div>
                    <div class="text-left col-sm-9">
                        : {{ $calon->tarikh_lahir ?? '-' }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        {{ ($calon->id_warganegara ?? 0) == 1 ? 'No. Pengenalan Diri' : ' No. Passport' }}
                    </div>
                    <div class="text-left col-sm-9">
                        : {{ ($calon->id_warganegara ?? 0) == 1 ? $calon->no_kad_pengenalan : $calon->no_pengenalan_lain }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        Jantina
                    </div>
                    <div class="text-left col-sm-9">
                        : {{ $calon->id_jantina > 1 ? 'PEREMPUAN' : 'LELAKI' }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-3">
                        Jenis Calon
                    </div>
                    <div class="text-left col-sm-9">
                        : {{ $calon->permohonan->id_kemasukan == 11 ? 'CALON MENGULANG' : 'CALON BAHARU' }}
                    </div>
                </div>

                <div class="mt-5 mb-3 row">
                    <div class="text-center col-md-12">
                        <strong><u>Mata Pelajaran Yang Diambil</u></strong>
                    </div>
                </div>

                @if($calon->mata_pelajaran)
                @foreach ($calon->mata_pelajaran as $mata_pelajaran)
                    <div class="row justify-content-center">
                        <div class="text-left col-md-8">
                        <b>{{ $loop->index + 1 }}</b> <span class="mr-2">.</span> {{  $mata_pelajaran->kod_mata_pelajaran }} - {{  $mata_pelajaran->keterangan }}
                        </div>
                    </div>
                @endforeach
                @endif


                <div class="mt-5 row">
                    <div class="col-sm-3">
                        Jumlah Mata Pelajaran
                    </div>
                    <div class="text-left col-sm-9">
                        : {{ count($calon->mata_pelajaran ?? []) }}
                    </div>
                </div>

                <div class="mt-5 row">
                    <div class="text-left col-sm-12">
                        Saya akui telah menyemak maklumat pendaftaran peperiksaan di atas dan didapati betul dan tidak akan menukar matapelajaran / kertas selepas pendaftaran ni.
                    </div>
                </div>
            </td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td>
                <div class="footer-space">

                    <div class="mt-5 row">
                        <div class="text-left col-md-3">
                            ___________________________
                        </div>
                        <div class="text-center col-md-6">

                        </div>
                        <div class="text-right col-md-3">
                            ___________________________
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-center col-md-3">
                            Ibubapa / Penjaga
                        </div>
                        <div class="text-center col-md-6">

                        </div>
                        <div class="text-center col-md-3">
                            Tandatangan Calon
                        </div>
                    </div>

                    <div class="mt-3 row">
                        <div class="col-sm-3">
                            Nama
                        </div>
                        <div class="text-left col-sm-9">
                            :
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-3">
                            No Kad Pengenalan
                        </div>
                        <div class="text-left col-sm-9">
                            :
                        </div>
                    </div>


                    <div class="mt-3 mb-3 row">
                        <div class="col-sm-12">
                            Tarikh: _____________________________
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-3">
                            Lembaga Peperiksaan
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            Kementerian Pendidikan Malaysia
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    </tfoot>
</table>

@endsection
