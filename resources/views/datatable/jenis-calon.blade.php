@php

$table_jenis_calon     = 'jenis-calon';

@endphp

<div class="p-0">
    <div class="row clearfix">
        <div class="col-12">
            <div class="text-right mb-4">
                <a href="javascript:void(0);"
                    class="btn btn-pill btn-light btn-xs pr-3 pl-3 py-1 text-dark "
                    data-toggle="modal"
                    data-target="#modal-{{ $table_jenis_calon }}">
                    <i class="fa fa-plus text-dark" aria-hidden="true"></i> Tambah {{ $table_jenis_calon }}
                </a>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="display datatables" id="table-{{ $table_jenis_calon }}" style="width: 100%">
                    <thead>
                        <tr>
                            <th>Kod Jenis Calon</th>
                            <th>Keterangan</th>
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
<div class="modal fade" id="modal-{{ $table_jenis_calon }}" tabindex="-1" role="dialog" aria-labelledby="modal-{{ $table_jenis_calon }}-label" aria-hidden="true">
    <div class="modal-lg modal-dialog"  role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modal-{{ $table_jenis_calon }}-label">Tambah {{ ucfirst($table_jenis_calon) }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <form action="#" id="{{ $table_jenis_calon }}_form">
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
                            <label for="kod_jenis_calon">Kod Jenis Calon:</label>
                            <input type="text" class="form-control" name="kod_jenis_calon" id="input_kod_jenis_calon">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="input_calon_keterangan">Keterangan:</label>
                            <textarea  type="text" class="form-control" name="keterangan" id="input_calon_keterangan"></textarea>
                        </div>
                    </div>

                    <input type="hidden" name="id_peperiksaan" value="{{ $peperiksaan->id }}">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" id="btn-save-{{ $table_jenis_calon }}">Simpan</button>
                <input type="hidden" name="action" id="action_{{ $table_jenis_calon }}" value="add" />
                <input type="hidden" name="_method" id="method_{{ $table_jenis_calon }}" value="" />
                <input type="hidden" name="hidden_id" id="hidden_id_{{ $table_jenis_calon }}" />
            </div>
            </form>
        </div>
    </div>
</div>

@push('script')

<script type="text/javascript">

    var jenis_calon = {

        route: {

            datatable_url               : "{{ route('jenis-calon.index', ['id_peperiksaan'=> $peperiksaan->id]) }}",
            action_url                  : "{{ route('jenis-calon.index') }}/",
            store_url                   : "{{ route('jenis-calon.store') }}",

        },

        table:{

            name                        : "{{ $table_jenis_calon }}",

        }

    };
</script>

<script src="{{ asset('js/ref/ref_jenis_calon.js') }}"></script>

@endpush

