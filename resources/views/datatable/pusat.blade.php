@php

$table_pusat     = 'pusat';

@endphp

<div class="card card-with-border">
    <div class="card-body">
        <div class="row ">
            <div class="col-12">
                <div class="text-right mb-4">
                    <a href="javascript:void(0);"
                        class="btn btn-pill btn-light btn-xs pr-3 pl-3 py-1 text-dark" data-toggle="modal"
                        data-target="#modal-{{ $table_pusat }}">
                        <i class="fa fa-plus text-dark" aria-hidden="true"></i> Tambah {{ $table_pusat }}
                    </a>
                </div>
                <hr>
                <div class="table-responsive">
                    <table class="display datatables" id="table-{{ $table_pusat }}" style="width: 100%">
                        <thead>
                            <tr>
                                <th>Kod Pusat</th>
                                <th>Nama Pusat</th>
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
<div class="modal fade" id="modal-{{ $table_pusat }}" tabindex="-1" role="dialog" aria-labelledby="modal-{{ $table_pusat }}-label" aria-hidden="true">
    <div class="modal-lg modal-dialog"  role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modal-{{ $table_pusat }}-label">Tambah {{ ucfirst($table_pusat) }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <form action="#" id="{{ $table_pusat }}_form">
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
                            <label for="kod_pusat">Kod Pusat:</label>
                            <input type="text" class="form-control" placeholder="Taip kod pusat" name="kod_pusat" id="input_kod_pusat">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="input_pusat">Nama Pusat:</label>
                            <input type="text" class="form-control" placeholder="Taip nama pusat" name="nama_pusat" id="input_nama_pusat">
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" id="btn-save-{{ $table_pusat }}">Simpan</button>
                <input type="hidden" name="action" id="action_{{ $table_pusat }}" value="add" />
                <input type="hidden" name="_method" id="method_{{ $table_pusat }}" value="" />
                <input type="hidden" name="hidden_id" id="hidden_id_{{ $table_pusat }}" />
            </div>
            </form>
        </div>
    </div>
</div>

@push('script')

<script>

    var pusat = {

        route: {

            datatable_url               : "{{ route('pusat.index', ['id_tahun_peperiksaan'=> $tahunPeperiksaan->id, 'id_peperiksaan' => $tahunPeperiksaan->peperiksaan->id]) }}",
            action_url                  : "{{ route('pusat.index') }}/",
            store_url                   : "{{ route('pusat.store') }}",

        },

        table:{

            name                        : "{{ $table_pusat }}",

        }

    };

</script>

<script src="{{ asset('js/ref/ref_pusat.js') }}"></script>

@endpush
