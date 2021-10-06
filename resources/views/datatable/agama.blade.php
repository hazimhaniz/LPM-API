@php

$table_agama     = 'agama';

@endphp

<div class="p-0">
    <div class="row clearfix">
        <div class="col-12">
            <div class="text-right mb-4">
                <a href="javascript:void(0);"
                    class="btn btn-pill btn-light btn-xs pr-3 pl-3 py-1 text-dark"
                    data-toggle="modal"
                    data-target="#modal-{{ $table_agama }}">
                    <i class="fa fa-plus text-dark" aria-hidden="true"></i> Tambah {{ $table_agama }}
                </a>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="display datatables" id="table-{{ $table_agama }}" style="width: 100%">
                    <thead>
                        <tr>
                            <th>Kod Agama</th>
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
<div class="modal fade" id="modal-{{ $table_agama }}" tabindex="-1" role="dialog" aria-labelledby="modal-{{ $table_agama }}-label" aria-hidden="true">
    <div class="modal-lg modal-dialog"  role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modal-{{ $table_agama }}-label">Tambah {{ ucfirst($table_agama) }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <form action="#" id="{{ $table_agama }}_form">
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
                        <div class="form-group">
                            <label for="kod_agama">Kod Agama:</label>
                            <input type="text" class="form-control" name="kod_agama" id="kod_agama">
                            <div class="c_kod_agama invalid-feedback text-right"></div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="agama">Keterangan:</label>
                            <input type="text" class="form-control" name="keterangan_agama" id="keterangan_agama">
                            <div class="c_keterangan_agama invalid-feedback text-right"></div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" id="btn-save-{{ $table_agama }}">Simpan</button>
                <input type="hidden" name="action" id="action_{{ $table_agama }}" value="add" />
                <input type="hidden" name="_method" id="method_{{ $table_agama }}" value="" />
                <input type="hidden" name="hidden_id" id="hidden_id_{{ $table_agama }}" />

            </div>
            </form>
        </div>
    </div>
</div>

@push('script')

<script type="text/javascript">

    var agama = {

        route: {

            datatable_url         : "{{ route('agama.index') }}",
            action_url            : "{{ route('agama.index') }}/",
            store_url             : "{{ route('agama.store') }}",

        },

        table:{

            name                  : "{{ $table_agama }}",

        }

    };
</script>

<script src="{{ asset('js/ref/ref_agama.js') }}"></script>

@endpush

