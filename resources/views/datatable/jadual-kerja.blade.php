@php

$table_jadual_kerja     = 'jadual-kerja';

@endphp

<div class="p-0">
    <div class="row clearfix">
        <div class="col-12">
            <div class="text-right mb-4">
                <a href="javascript:void(0);"
                    class="btn btn-pill btn-light btn-xs pr-3 pl-3 py-1 text-dark "
                    data-toggle="modal"
                    data-target="#modal-{{ $table_jadual_kerja }}">
                    <i class="fa fa-plus text-dark" aria-hidden="true"></i> Tambah {{ $table_jadual_kerja }}
                </a>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="display datatables" id="table-{{ $table_jadual_kerja }}" style="width: 100%">
                    <thead>
                        <tr>
                            <th>Keterangan</th>
                            <th>Mula</th>
                            <th>Tamat</th>
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

<!-- Modal -->
<div class="modal fade" id="modal-{{ $table_jadual_kerja }}" tabindex="-1" role="dialog" aria-labelledby="modal-{{ $table_jadual_kerja }}-label" aria-hidden="true">
    <div class="modal-lg modal-dialog"  role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modal-{{ $table_jadual_kerja }}-label">Tambah {{ ucfirst($table_jadual_kerja) }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <form action="#" id="{{ $table_jadual_kerja }}_form">
            @csrf
            <div class="modal-body">
                <div class="row clearfix">

                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="alert alert-light" role="alert">
                                <p> Isi maklumat pada ruangan di bawah, dan tekan butang <strong>Simpan</strong> untuk menambah rekod ke pangkalan data</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="alert alert-danger error_alert mb-3" role="alert" style="display: none;">
                            <ul></ul>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="keterangan">Keterangan Jadual Kerja:</label>
                            <input type="text" class="form-control" placeholder="Taip keterangan jadual kerja" name="keterangan" id="input_keterangan">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="input_mula">Mula:</label>
                            <input type="date" class="form-control" data-language="en" placeholder="tarikh mula" name="tarikh_mula" id="input_tarikh_mula_jadual_kerja">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="input_tamat">Tamat:</label>
                            <input type="date" class="form-control" data-language="en" placeholder="tarikh tamat" name="tarikh_tamat" id="input_tarikh_tamat_jadual_kerja">
                        </div>
                    </div>

                    <input type="hidden" name="id_tahun_peperiksaan" value="{{ $tahunPeperiksaan->id }}">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" id="btn-save-{{ $table_jadual_kerja }}">Simpan</button>
                <input type="hidden" name="action" id="action_{{ $table_jadual_kerja }}" value="add" />
                <input type="hidden" name="_method" id="method_{{ $table_jadual_kerja }}" value="" />
                <input type="hidden" name="hidden_id" id="hidden_id_{{ $table_jadual_kerja }}" />
            </div>
            </form>
        </div>
    </div>
</div>

@push('script')

<script type="text/javascript">

    var jadual_kerja = {

        route: {

            datatable_url               : "{{ route('jadual-kerja.index', ['id_tahun_peperiksaan'=> $tahunPeperiksaan->id]) }}",
            action_url                  : "{{ route('jadual-kerja.index') }}/",
            store_url                   : "{{ route('jadual-kerja.store') }}",

        },

        table:{

            name                        : "{{ $table_jadual_kerja }}",

        }

    };
</script>

<script src="{{ asset('js/ref/ref_jadual_kerja.js') }}"></script>

@endpush

