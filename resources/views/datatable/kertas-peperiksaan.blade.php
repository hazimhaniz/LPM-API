@php

$table_kertas_peperiksaan     = 'kertas-peperiksaan';

@endphp

<div class="card card-with-border">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="mb-4 text-right">
                    <a href="javascript:void(0);"
                        class="py-1 pl-4 pr-4 btn btn-pill btn-light btn-xs text-dark "
                        data-toggle="modal"
                        data-target="#modal-{{ $table_kertas_peperiksaan }}">
                        <i class="fa fa-plus text-dark pr-2" aria-hidden="true"></i> Tambah {{ ucwords(str_replace("-", " ", $table_kertas_peperiksaan)) }}
                    </a>
                </div>
                <hr>
                <div class="table-responsive">
                    <table class="display datatables" id="table-{{ $table_kertas_peperiksaan }}" style="width: 100%">
                        <thead>
                            <tr>
                                <th>Kod Kertas Peperiksaan</th>
                                <th>Nama Kertas</th>
                                <th>Jenis Kertas</th>
                                <th>Bahasa Kertas</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-{{ $table_kertas_peperiksaan }}" tabindex="-1" role="dialog" aria-labelledby="modal-{{ $table_kertas_peperiksaan }}-label" aria-hidden="true">
    <div class="modal-lg modal-dialog"  role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modal-{{ $table_kertas_peperiksaan }}-label">Tambah {{ ucwords(str_replace("-", " ", $table_kertas_peperiksaan)) }} :  {{ $tahunPeperiksaan->tahun }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <form action="{{ route('kertas-peperiksaan.store') }}" id="{{ $table_kertas_peperiksaan }}_form" method="POST">
            @csrf
            <div class="modal-body">
                <div class="clearfix row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="no_kertas_peperiksaan">No Kertas Peperiksaan:</label>
                            <input type="text" class="form-control" name="no_kertas_peperiksaan" id="no_kertas_peperiksaan">
                            <div class="text-right c-no_kertas_peperiksaan invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kod_kertas_peperiksaan">Kod Kertas Peperiksaan:</label>
                            <input  type="text" class="form-control" name="kod_kertas_peperiksaan" id="kod_kertas_peperiksaan">
                            <div class="text-right c-kod_kertas_peperiksaan invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nama_kertas_peperiksaan">Nama Kertas Peperiksaan:</label>
                            <input type="text" class="form-control" name="nama_kertas_peperiksaan" id="nama_kertas_peperiksaan">
                            <div class="text-right c-nama_kertas_peperiksaan invalid-feedback"></div>
                        </div>
                    </div>
                </div>

                <div class="clearfix row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="markah_maksimum_kertas">Markah Maksimum</label>
                            <div class="mb-3 input-group">
                                <input class="form-control" type="text" name="markah_maksimum_kertas" id="markah_maksimum_kertas">
                                <div class="input-group-append"><span class="input-group-text">%</span></div>
                            </div>
                            <div class="text-right c-markah_maksimum_kertas invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="skala_kertas">Skala:</label>
                            <input  type="text" class="form-control" name="skala_kertas" id="skala_kertas">
                            <div class="text-right c-skala_kertas invalid-feedback"></div>
                        </div>
                    </div>
                </div>

                <div class="clearfix row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jenis_kertas">Jenis Kertas:</label>
                            <select class="custom-select" name="jenis_kertas" id="jenis_kertas">
                                <option value="" disabled selected hidden style="color: #a9a9a9 !important;">- Sila Pilih</option>
                                <option value="objektif">Objektif</option>
                                <option value="subjektif">Subjektif</option>
                                <option value="kerja_kursus">Kerja Kursus</option>
                                <option value="lisan">Lisan</option>
                            </select>
                            <div class="text-right c-jenis_kertas invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pilihan">Status Pilihan:</label>
                            <select class="custom-select" name="pilihan" id="pilihan">
                                <option value="" disabled selected hidden style="color: #a9a9a9 !important;">- Sila Pilih</option>
                                <option value="1">Wajib</option>
                                <option value="2">Pilihan</option>
                            </select>
                            <div class="text-right c-pilihan invalid-feedback"></div>
                        </div>
                    </div>
                </div>

                <div class="clearfix row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kertas_hurdle">Kertas Hurlde:</label>

                            <div class="row">
                                <div class="col">
                                    <label class="d-block" for="kertas_hurdle">
                                        <input class="radio_animated" type="radio" name="kertas_hurdle" id="kertas_hurdle" value="1">
                                        Ya
                                    </label>
                                    <label class="d-block" for="kertas_hurdle">
                                        <input class="radio_animated" type="radio" name="kertas_hurdle" id="kertas_hurdle" value="2">
                                        Tidak
                                    </label>
                                </div>
                            </div>
                            <div class="text-right c-kertas_hurdle invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kertas_matriks">Kertas Matriks:</label>

                            <div class="row">
                                <div class="col">
                                    <label class="d-block" for="kertas_matriks">
                                        <input class="radio_animated" type="radio" name="kertas_matriks" id="kertas_matriks" value="1">
                                        Ya
                                    </label>
                                    <label class="d-block" for="kertas_matriks">
                                        <input class="radio_animated" type="radio" name="kertas_matriks" id="kertas_matriks" value="2">
                                        Tidak
                                    </label>
                                </div>
                            </div>
                            <div class="text-right c-kertas_matriks invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="dikira_gred">Dikira Gred:</label>

                            <div class="row">
                                <div class="col">
                                    <label class="d-block" for="dikira_gred">
                                        <input class="radio_animated" type="radio" name="dikira_gred" id="dikira_gred" value="1">
                                        Ya
                                    </label>
                                    <label class="d-block" for="dikira_gred">
                                        <input class="radio_animated" type="radio" name="dikira_gred" id="dikira_gred" value="2">
                                        Tidak
                                    </label>
                                </div>
                            </div>
                            <div class="text-right c-dikira_gred invalid-feedback"></div>
                        </div>
                    </div>
                </div>

                <div class="clearfix pt-4 row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="bahasa">Pilihan Bahasa:</label>
                            <select class="custom-select" name="bahasa" id="bahasa">
                                <option value="" disabled selected hidden style="color: #a9a9a9 !important;">- Sila Pilih</option>
                                <option value="bahasa_malaysia">Bahasa Malaysia</option>
                                <option value="bahasa_inggeris">Bahasa Inggeris</option>
                                <option value="bahasa_cina">Bahasa Cina</option>
                                <option value="bahasa_tamil">Bahasa Tamil</option>
                                <option value="bahasa_arab">Bahasa Arab</option>
                                <option value="bahasa_punjabi">Bahasa Punjabi</option>
                                <option value="bahasa_iban">Bahasa Iban</option>
                                <option value="bahasa_kadazandusun">Bahasa Kadazandusun</option>
                                <option value="bahasa_semai">Bahasa Semai</option>
                            </select>
                            <div class="text-right c-bahasa invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jenis_semakan">Jenis Semakan :</label>
                            <select class="custom-select" name="jenis_semakan" id="jenis_semakan">
                                <option value="" disabled selected hidden style="color: #a9a9a9 !important;">- Sila Pilih</option>
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                            </select>
                            <div class="text-right c-jenis_semakan invalid-feedback"></div>
                        </div>
                    </div>
                </div>

                <div class="clearfix row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="mensyuarat_pemeriksa">Jenis Mesyuarat Peperiksaan Pemeriksa :</label>
                            <select class="custom-select" name="mensyuarat_pemeriksa" id="mensyuarat_pemeriksa">
                                <option value="" disabled selected hidden style="color: #a9a9a9 !important;">- Sila Pilih</option>
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                            </select>
                            <div class="text-right c-mensyuarat_pemeriksa invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="id_mata_pelajaran">Mata Pelajaran :</label>
                            <select class="custom-select" name="id_mata_pelajaran" id="id_mata_pelajaran">
                                <option value="" disabled selected hidden style="color: #a9a9a9 !important;">- Sila Pilih</option>
                            </select>
                        </div>
                        <div class="text-right c-id_mata_pelajaran invalid-feedback"></div>
                    </div>
                </div>

                <div class="clearfix row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="lpm">Dihantar ke LPM:</label>

                            <div class="row">
                                <div class="col">
                                    <label class="d-block" for="edo_ani">
                                        <input class="radio_animated" type="radio" name="lpm" id="lpm" value="1">
                                        Ya
                                    </label>
                                    <label class="d-block" for="edo_ani">
                                        <input class="radio_animated" type="radio" name="lpm" id="lpm" value="2">
                                        Tidak
                                    </label>
                                </div>
                            </div>
                            <div class="text-right c-lpm invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="penentuan_standard">Dikecualikan dalam penentuan standard :</label>

                            <div class="row">
                                <div class="col">
                                    <label class="d-block" for="penentuan_standard">
                                        <input class="radio_animated" type="radio" name="penentuan_standard" id="penentuan_standard" value="1">
                                        Ya
                                    </label>
                                    <label class="d-block" for="penentuan_standard">
                                        <input class="radio_animated" type="radio" name="penentuan_standard" id="penentuan_standard" value="2">
                                        Tidak
                                    </label>
                                </div>
                            </div>
                            <div class="text-right c-penentuan_standard invalid-feedback"></div>
                        </div>
                    </div>
                </div>

                <div class="clearfix row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="calon">Diambil oleh calon:</label>

                            <div class="row">
                                <div class="col">
                                    <label class="d-block" for="calon">
                                        <input class="checkbox_animated" type="checkbox" name="calon[]" id="calon[]" value="sekolah_kerajaan">
                                        Sekolah Kerajaan
                                    </label>
                                    <label class="d-block" for="calon">
                                        <input class="checkbox_animated" type="checkbox" name="calon[]" id="calon[]" value="sekolah_swasta">
                                        Sekolah Swasta
                                    </label>
                                    <label class="d-block" for="calon">
                                        <input class="checkbox_animated" type="checkbox" name="calon[]" id="calon[]" value="persendirian">
                                        Persendirian
                                    </label>
                                </div>
                            </div>
                            <div class="text-right c-calon invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Status :</label>
                            <select class="custom-select" name="status_kertas" id="status_kertas">
                                <option value="" disabled selected hidden style="color: #a9a9a9 !important;">- Sila Pilih</option>
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                            </select>
                            <div class="text-right c-status invalid-feedback"></div>
                        </div>
                    </div>
                </div>

                <div class="clearfix row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="catatan_kertas">Catatan :</label>
                            <textarea class="form-control" name="catatan_kertas" id="catatan_kertas"></textarea>
                            <div class="text-right c-catatan_kertas invalid-feedback"></div>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="id_peperiksaan" value="{{ $tahunPeperiksaan->peperiksaan->id }}"> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" id="btn-save-{{ $table_kertas_peperiksaan }}">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

@push('script')
<script>

    var kertas_peperiksaan = {

        route: {

            datatable_url               : "{{ route('kertas-peperiksaan.index', ['id_peperiksaan'=> $tahunPeperiksaan->peperiksaan->id]) }}",
            action_url                  : "{{ route('kertas-peperiksaan.index') }}"
        },

        table:{

            name                        : "{{ $table_kertas_peperiksaan }}",
        }

    };

</script>
<script type="module" src="{{ asset('js/modules/kertas_peperiksaan.js') }}"></script>
@endpush