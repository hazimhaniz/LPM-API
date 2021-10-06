@php

$table_jenis_kemasukan     = 'jenis-kemasukan';

@endphp

<div class="p-0">
    <div class="row clearfix">
        <div class="col-12">
            <div class="text-right mb-4">
                <a href="javascript:void(0);"
                    class="btn btn-pill btn-light btn-xs pr-3 pl-3 py-1 text-dark "
                    data-toggle="modal"
                    data-target="#modal-{{ $table_jenis_kemasukan }}">
                    <i class="fa fa-plus text-dark" aria-hidden="true"></i> Tambah {{ $table_jenis_kemasukan }}
                </a>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="display datatables" id="table-{{ $table_jenis_kemasukan }}" style="width: 100%">
                    <thead>
                        <tr>
                            <th>Kod Kemasukan</th>
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
<div class="modal fade" id="modal-{{ $table_jenis_kemasukan }}" tabindex="-1" role="dialog" aria-labelledby="modal-{{ $table_jenis_kemasukan }}-label" aria-hidden="true">
    <div class="modal-lg modal-dialog"  role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modal-{{ $table_jenis_kemasukan }}-label">Tambah {{ ucfirst($table_jenis_kemasukan) }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <form action="#" id="{{ $table_jenis_kemasukan }}_form">
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
                            <label for="kod_jenis_kemasukan">Kod Kemasukan:</label>
                            <input type="text" class="form-control" name="kod_kemasukan" id="input_kod_kemasukan">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="input_kemasukan_keterangan">Keterangan:</label>
                            <input type="text" class="form-control" name="keterangan" id="input_kemasukan_keterangan">
                        </div>
                    </div>

                    <input type="hidden" name="id_peperiksaan" value="{{ $peperiksaan->id }}">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" id="btn-save-{{ $table_jenis_kemasukan }}">Simpan</button>
                <input type="hidden" name="action" id="action_{{ $table_jenis_kemasukan }}" value="add" />
                <input type="hidden" name="_method" id="method_{{ $table_jenis_kemasukan }}" value="" />
                <input type="hidden" name="hidden_id" id="hidden_id_{{ $table_jenis_kemasukan }}" />
            </div>
            </form>
        </div>
    </div>
</div>

@push('script')

<script type="text/javascript">

    var jenis_kemasukan = {

        route: {

            datatable_url               : "{{ route('jenis-kemasukan.index', ['id_peperiksaan'=> $peperiksaan->id]) }}",
            action_url                  : "{{ route('jenis-kemasukan.index') }}/",
            store_url                   : "{{ route('jenis-kemasukan.store') }}",

        },

        table:{

            name                        : "{{ $table_jenis_kemasukan }}",

        }

    };
</script>

<script src="{{ asset('js/ref/ref_jenis_kemasukan.js') }}"></script>

@endpush

