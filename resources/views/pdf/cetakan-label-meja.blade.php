@extends('layouts.print')
@section('title', 'Label Meja')

@section('content')

<table>
    <thead>
        <tr>
            <td>
                <div class="header-space">
                    <div class="container">
                        <div class="paparan-sahaja">
                            <button type="button" onClick="window.close()" class="btn btn-white">
                                Tutup
                            </button>
                            <button type="button" onClick="window.print()" class="btn btn-primary">
                                <i class="fa fa-print"></i> Cetak
                            </button>
                        </div>
                        <div class="row">
                            <div class="text-center col-md-12">
                                <strong>LEMBAGA PEPERIKSAAN</strong>
                            </div>
                            <div class="text-center col-md-12">
                                <strong>KEMENTERIAN PENDIDIKAN MALAYSIA</strong>
                            </div>
                            <div class="text-center col-md-12">
                                <strong>PERNYATAAN PENDAFTARAN PEPERIKSAAN</strong>
                            </div>
                            <div class="text-center col-md-12">
                                <small><b>SIJIL TINGGI AGAMA MALAYSIA</b></small>
                            </div>
                            <div class="text-center col-md-12">
                                <small><b>TAHUN PEPERIKSAAN 2020</b></small>
                            </div>
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
                        {{ ($calon->id_warganegara ?? 0) == 1 ? 'No. Pengenalan Diri' : ' No. Passport' }}
                    </div>
                    <div class="text-left col-sm-9">
                        : {{ ($calon->id_warganegara ?? 0) == 1 ? $calon->no_kad_pengenalan : $calon->no_pengenalan_lain }}
                    </div>
                </div>

                <div class="mt-3 row">
                    <div class="text-left col-md-12">
                        <b>Mata Pelajaran Yang Didaftarkan</b>
                    </div>
                </div>
                @if($calon->mata_pelajaran)
                <div class="row">
                    <div class="text-left col-md-6">
                        @foreach ($calon->mata_pelajaran as $mata_pelajaran)
                        @if($loop->index <= 6) <div class="text-left col-md-12">
                            <b>{{ $loop->index + 1 }}</b> <span class="mr-3">.</span>
                            {{  $mata_pelajaran->kod_mata_pelajaran }} - {{  $mata_pelajaran->keterangan }}
                    </div>
                    @endif
                    @endforeach
                </div>
                <div class="text-left col-md-6">
                    @foreach ($calon->mata_pelajaran as $mata_pelajaran)
                    @if($loop->index > 6)
                    <div class="text-left col-md-12">
                        <b>{{ $loop->index + 1 }}</b> <span class="mr-3">.</span>
                        {{  $mata_pelajaran->kod_mata_pelajaran }} - {{  $mata_pelajaran->keterangan }}
                    </div>
                    @endif
                    @endforeach
                </div>
                </div>
                @endif

            </td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td>
                <div class="footer-space">
                    <div class="mt-5 row justify-content-between">
                        <div class="col-md-auto">
                            <div class="row">
                                <div class="col-md-auto">
                                    <b>Jumlah Mata Pelajaran</b>
                                </div>
                                <div class="text-left col-md-auto">
                                    : <b>{{ str_pad(count($calon->mata_pelajaran ?? []), 2, '0',STR_PAD_LEFT) }}</b>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-auto">
                            <p class="mr-5 text-center">
                                <b>Bayaran (RM)</b> :
                                <b>{{ number_format ($calon->bayaran->jumlah_bayaran ?? 0, 2) }}</b>
                            </p>

                        </div>
                    </div>
                    <div class="mt-2 row justify-content-between">
                        <div class="col-md-auto">
                            <p class="text-center">
                                _______________________________________<br>
                                Tandatangan Calon
                            </p>
                        </div>
                        <div class="col-md-auto">
                            <p class="text-center">
                                _______________________________________<br>
                                Tandatangan Ibubapa / Penjaga
                            </p>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    </tfoot>
</table>

@endsection
