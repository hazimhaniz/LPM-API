@php

$table_mata_pelajaran     = 'mata-pelajaran';

@endphp

<div class="card card-with-border">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="mb-4 text-right">
                    <a href="javascript:void(0);"
                        class="py-1 pl-3 pr-3 btn btn-pill btn-light btn-xs text-dark "
                        data-toggle="modal"
                        data-target="#modal-{{ $table_mata_pelajaran }}">
                        <i class="fa fa-plus text-dark" aria-hidden="true"></i> Tambah {{ ucwords(str_replace("-", " ", $table_mata_pelajaran))  }}
                    </a>
                </div>
                <hr>
                <div class="table-responsive">
                    <table class="display datatables" id="table-{{ $table_mata_pelajaran }}" style="width: 100%">
                        <thead>
                            <tr>
                                <th>Kod Mata Pelajaran</th>
                                <th>Keterangan</th>
                                <th>Tarikh Akhir Kemaskini</th>
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
<div class="modal fade" id="modal-{{ $table_mata_pelajaran }}" tabindex="-1" role="dialog" aria-labelledby="modal-{{ $table_mata_pelajaran }}-label" aria-hidden="true">
    <div class="modal-lg modal-dialog"  role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modal-{{ $table_mata_pelajaran }}-label">Tambah {{ ucfirst($table_mata_pelajaran) }} :  {{ $tahunPeperiksaan->tahun }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <form action="#" id="{{ $table_mata_pelajaran }}_form">
            @csrf
            <div class="modal-body">
                <div class="clearfix row">

                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="alert alert-light" role="alert">
                                <p> Isi maklumat pada ruangan di bawah, dan tekan butang <strong>Simpan</strong> untuk menambah rekod ke pangkalan data</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="pentaksiran_opt">Pilih Komponen Pentaksiran:</label>
                            <select class="custom-select" name="pentaksiran_opt" id="pentaksiran_opt">
                                <option value="" disabled selected hidden style="color: #a9a9a9 !important;">- Sila Pilih</option>
                            </select>
                            <div class="text-right c-pentaksiran_opt invalid-feedback"></div>
                        </div>
                    </div>
                </div>
                <div class="clearfix row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kod_mata_pelajaran">Kod Mata Pelajaran:</label>
                            <input type="text" class="form-control" name="kod_mata_pelajaran" id="kod_mata_pelajaran">
                            <div class="text-right c-kod_mata_pelajaran invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="input_mata_pelajaran_keterangan">Nama Mata Pelajaran:</label>
                            <input  type="text" class="form-control" name="nama_mata_pelajaran" id="nama_mata_pelajaran">
                            <div class="text-right c-nama_mata_pelajaran invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="input_mata_pelajaran_keterangan">Nama Mata Pelajaran (EN):</label>
                            <input  type="text" class="form-control" name="nama_mata_pelajaran_opt" id="nama_mata_pelajaran_opt">
                            <div class="text-right c-nama_mata_pelajaran_opt invalid-feedback"></div>
                        </div>
                    </div>
                </div>
                <div class="clearfix row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="markah_maksimum">Markah Maksimum:</label>
                            <input type="text" class="form-control" name="markah_maksimum" id="markah_maksimum">
                            <div class="text-right c-markah_maksimum invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cara_penentuan_gred">Cara Penentuan Gred:</label>
                            <input type="text" class="form-control" name="cara_penentuan_gred" id="cara_penentuan_gred">
                            <div class="text-right c-cara_penentuan_gred invalid-feedback"></div>
                        </div>
                    </div>
                </div>

                <div class="clearfix row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="mata_pelajaran_opt">Status Pilihan:</label>
                            <select class="custom-select" name="mata_pelajaran_opt" id="mata_pelajaran_opt">
                                <option value="" disabled selected hidden style="color: #a9a9a9 !important;">- Sila Pilih</option>
                                <option value="1">Wajib</option>
                                <option value="2">Pilihan</option>
                            </select>
                            <div class="text-right c-mata_pelajaran_opt invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="calon_yang_dibenarkan">Mata Pelajaran Dibenarkan:</label>
                            <select class="custom-select" name="calon_yang_dibenarkan" id="calon_yang_dibenarkan">
                                <option value="" disabled selected hidden style="color: #a9a9a9 !important;">- Sila Pilih</option>
                            </select>
                            <div class="text-right c-calon_yang_dibenarkan invalid-feedback"></div>
                        </div>
                    </div>
                </div>

                <div class="clearfix row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jenis_calon">Jenis Calon:</label>
                            <select class="custom-select" name="jenis_calon" id="jenis_calon">
                                <option value="" disabled selected hidden style="color: #a9a9a9 !important;">- Sila Pilih</option>
                            </select>
                            <div class="text-right c-jenis_calon invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jenis_bayaran">Jenis Bayaran:</label>
                            <select class="custom-select" name="jenis_bayaran" id="jenis_bayaran">
                                <option value="" disabled selected hidden style="color: #a9a9a9 !important;">- Sila Pilih</option>
                            </select>
                            <div class="text-right c-jenis_bayaran invalid-feedback"></div>
                        </div>
                    </div>
                </div>

                <div class="clearfix row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="format_pentaksiran">Format Pentaksiran Kertas:</label>
                            <select class="custom-select" name="format_pentaksiran" id="format_pentaksiran">
                                <option value="" disabled selected hidden style="color: #a9a9a9 !important;">- Sila Pilih</option>
                            </select>
                            <div class="text-right c-format_pentaksiran invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kerja_kursus">Struktur Pentaksiran Kertas ( Kerja Kursus ) :</label>
                            <select class="custom-select" name="kerja_kursus" id="kerja_kursus">
                                <option value="" disabled selected hidden style="color: #a9a9a9 !important;">- Sila Pilih</option>
                            </select>
                            <div class="text-right c-kerja_kursus invalid-feedback"></div>
                        </div>
                    </div>
                </div>

                <div class="clearfix row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="status">Status :</label>
                            <select class="custom-select" name="status" id="status">
                                <option value="" disabled selected hidden style="color: #a9a9a9 !important;">- Sila Pilih</option>
                                <option value="1">Aktif</option>
                                <option value="2">Tidak Aktif</option>
                            </select>
                            <div class="text-right c-status invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="catatan">Catatan :</label>
                            <textarea class="form-control" name="catatan" id="catatan"></textarea>
                            <div class="text-right c-catatan invalid-feedback"></div>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="action" id="action_{{ $table_mata_pelajaran }}" value="add" />
                <input type="hidden" name="_method" id="method_{{ $table_mata_pelajaran }}" value="" />
                <input type="hidden" name="hidden_id" id="hidden_id_{{ $table_mata_pelajaran }}" />
                <input type="hidden" name="id_peperiksaan" value="{{ $tahunPeperiksaan->peperiksaan->id }}"> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" id="btn-save-{{ $table_mata_pelajaran }}">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

@push('script')
<script>

    var mata_pelajaran = {

        route: {

            datatable_url               : "{{ route('mata-pelajaran.index', ['id_peperiksaan'=> $tahunPeperiksaan->peperiksaan->id]) }}",
            action_url                  : "{{ route('mata-pelajaran.index') }}/",
            store_url                   : "{{ route('mata-pelajaran.store') }}",

        },

        table:{

            name                        : "{{ $table_mata_pelajaran }}",

        }

    };

</script>
<script src="{{ asset('js/ref/ref_mata_pelajaran.js') }}"></script>
@endpush