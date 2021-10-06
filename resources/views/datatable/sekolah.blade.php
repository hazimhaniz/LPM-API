@php

$table_sekolah     = 'sekolah';

@endphp
<div class="card card-with-border">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="mb-4 text-right">
                    <a href="javascript:void(0);"
                        class="py-1 pl-3 pr-3 btn btn-pill btn-light btn-xs text-dark" data-toggle="modal"
                        data-target="#modal-{{ $table_sekolah }}">
                        <i class="fa fa-plus text-dark" aria-hidden="true"></i> Tambah {{ $table_sekolah }}
                    </a>
                </div>
                <hr>
                <div class="table-responsive">
                    <table class="display datatables" id="table-{{ $table_sekolah }}" style="width: 100%">
                        <thead>
                            <tr>
                                <th>Kod Sekolah</th>
                                <th>Nama Sekolah</th>
                                <th>Negeri</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-{{ $table_sekolah }}" tabindex="-1" role="dialog" aria-labelledby="modal-{{ $table_sekolah }}-label" aria-hidden="true">
    <div class="modal-lg modal-dialog"  role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modal-{{ $table_sekolah }}-label">Tambah {{ ucfirst($table_sekolah) }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <form action="#" id="{{ $table_sekolah }}_form">
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
                            <label for="select_jenis_sekolah">Jenis Calon:</label>
                            <select class="custom-select" name="select_jenis_sekolah" id="select_jenis_sekolah">
                                <option value="" disabled selected hidden style="color: #a9a9a9 !important;">- Pilih Jenis Calon</option>
                                @foreach($jenis_sekolah as $item)
                                <option value="{{ $item->id }}">{{ $item->keterangan }}</option>
                                @endforeach
                            </select>
                            <div class="c_select_jenis_sekolah invalid-feedback text-right"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kod_sekolah">Kod Sekolah:</label>
                            <input type="text" class="form-control" placeholder="Taip kod sekolah" name="kod_sekolah" id="kod_sekolah">
                            <div class="c_kod_sekolah invalid-feedback text-right"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="input_sekolah">Nama Sekolah:</label>
                            <input type="text" class="form-control" placeholder="Taip nama sekolah" name="nama_sekolah" id="input_nama_sekolah">
                            <div class="c_nama_sekolah invalid-feedback text-right"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="input_pengetua">Nama pengetua:</label>
                            <input type="text" class="form-control" placeholder="Taip nama pengetua" name="nama_pengetua" id="input_nama_pengetua">
                            <div class="c_nama_pengetua invalid-feedback text-right"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="input_no_telefon">No Telefon:</label>
                            <input type="text" class="form-control" placeholder="Taip no telefon" name="no_telefon" id="input_no_telefon">
                            <div class="c_no_telefon invalid-feedback text-right"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="input_no_fax">No Fax:</label>
                            <input type="text" class="form-control" placeholder="Taip no fax" name="no_faks" id="input_no_faks">
                            <div class="c_no_faks invalid-feedback text-right"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="input_email_sekolah">Email Sekolah:</label>
                            <input type="text" class="form-control" placeholder="Taip email sekolah" name="emel_sekolah" id="input_email_sekolah">
                            <div class="c_emel_sekolah invalid-feedback text-right"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="input_alamat_sekolah">Alamat Sekolah:</label>
                            <input type="text" class="form-control" placeholder="Taip nama sekolah" name="alamat_sekolah" id="input_alamat_sekolah">
                            <div class="c_alamat_sekolah invalid-feedback text-right"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="input_poskod_sekolah">Poskod:</label>
                            <input type="text" class="form-control" placeholder="Taip poskod sekolah" name="poskod_sekolah" id="input_poskod_sekolah">
                            <div class="c_poskod_sekolah invalid-feedback text-right"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="select_negeri_sekolah">Negeri:</label>
                            <select class="custom-select" name="select_negeri_sekolah" id="select_negeri_sekolah">
                                <option value="" disabled selected hidden style="color: #a9a9a9 !important;">- Pilih negeri</option>
                                @foreach($negeri as $item)
                                <option value="{{ $item->id }}">{{ $item->keterangan }}</option>
                                @endforeach
                            </select>
                            <div class="c_select_negeri_sekolah invalid-feedback text-right"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="select_ppd_sekolah">PPD:</label>
                            <select class="custom-select" name="select_ppd_sekolah" id="select_ppd_sekolah">
                                <option value="" disabled selected hidden style="color: #a9a9a9 !important;">- Pilih PPD</option>
                            </select>
                            <div class="c_select_ppd_sekolah invalid-feedback text-right"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="select_daerah_sekolah">Daerah:</label>
                            <select class="custom-select" name="select_daerah_sekolah" id="select_daerah_sekolah">
                                <option value="" disabled selected hidden style="color: #a9a9a9 !important;">- Pilih daerah</option>
                            </select>
                            <div class="c_select_daerah_sekolah invalid-feedback text-right"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="select_bandar_sekolah">Bandar:</label>
                            <select class="custom-select" name="select_bandar_sekolah" id="select_bandar_sekolah">
                                <option value="" disabled selected hidden style="color: #a9a9a9 !important;">- Pilih daerah</option>
                            </select>
                            <div class="c_select_bandar_sekolah invalid-feedback text-right"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="select_parlimen_sekolah">Parlimen:</label>
                            <select class="custom-select" name="select_parlimen_sekolah" id="select_parlimen_sekolah">
                                <option value="" disabled selected hidden style="color: #a9a9a9 !important;">- Pilih Parlimen</option>
                            </select>
                            <div class="c_select_parlimen_sekolah invalid-feedback text-right"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="select_dun_sekolah">DUN:</label>
                            <select class="custom-select" name="select_dun_sekolah" id="select_dun_sekolah">
                                <option value="" disabled selected hidden style="color: #a9a9a9 !important;">- Pilih DUN</option>
                            </select>
                            <div class="c_select_dun_sekolah invalid-feedback text-right"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="select_lokasi_sekolah">Lokasi Sekolah:</label>
                            <select class="custom-select" name="select_lokasi_sekolah" id="select_lokasi_sekolah">
                                <option value="" disabled selected hidden style="color: #a9a9a9 !important;">- Pilih Lokasi Sekolah</option>
                                <option value="1">Bandar</option>
                                <option value="2">Luar Bandar</option>
                            </select>
                            <div class="c_select_lokasi_sekolah invalid-feedback text-right"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="select_jenis_sekolah">Jenis sekolah:</label>
                            <select class="custom-select" name="select_jenis_sekolah" id="select_jenis_sekolah">
                                <option value="" disabled selected hidden style="color: #a9a9a9 !important;">- Pilih Jenis Sekolah</option>
                                @foreach($jenis_sekolah as $item)
                                <option value="{{ $item->id }}">{{ $item->keterangan }}</option>
                                @endforeach
                            </select>
                            <div class="c_select_jenis_sekolah invalid-feedback text-right"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" id="btn-save-{{ $table_sekolah }}">Simpan</button>
                <input type="hidden" name="action" id="action_{{ $table_sekolah }}" value="add" />
                <input type="hidden" name="_method" id="method_{{ $table_sekolah }}" value="" />
                <input type="hidden" name="hidden_id" id="hidden_id_{{ $table_sekolah }}" />
            </div>
            </form>
        </div>
    </div>
</div>

@push('script')

<script>

    var sekolah = {

        route: {

            datatable_url               : "{{ route('sekolah.index', ['id_peperiksaan'=> $tahunPeperiksaan->id]) }}",
            action_url                  : "{{ route('sekolah.index') }}/",
            store_url                   : "{{ route('sekolah.store') }}",

        },

        table:{

            name                        : "{{ $table_sekolah }}",

        }

    };

</script>

<script src="{{ asset('js/ref/ref_sekolah.js') }}"></script>

@endpush
