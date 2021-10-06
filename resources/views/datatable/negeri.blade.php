@php

$table_negeri     = 'negeri';

@endphp

<div class="p-0">
    <div class="row clearfix">
        <div class="col-12">
            <div class="text-right mb-4">
                <a href="javascript:void(0);"
                    class="btn btn-pill btn-light btn-xs pr-3 pl-3 py-1 text-dark"
                    data-toggle="modal"
                    data-target="#modal-{{ $table_negeri }}">
                    <i class="fa fa-plus text-dark" aria-hidden="true"></i> Tambah {{ $table_negeri }}
                </a>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="display datatables" id="table-{{ $table_negeri }}" style="width: 100%">
                    <thead>
                        <tr>
                            <th>Kod negeri</th>
                            <th>negeri</th>
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
<div class="modal fade" id="modal-{{ $table_negeri }}" tabindex="-1" role="dialog" aria-labelledby="modal-{{ $table_negeri }}-label" aria-hidden="true">
    <div class="modal-lg modal-dialog"  role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modal-{{ $table_negeri }}-label">Tambah {{ ucfirst($table_negeri) }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <form action="#" id="{{ $table_negeri }}_form">
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
                            <label for="kod_negeri">Kod negeri:</label>
                            <input type="text" class="form-control" name="kod_negeri" id="kod_negeri">
                            <div class="c_kod_negeri invalid-feedback text-right"></div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="negeri">negeri:</label>
                            <input type="text" class="form-control" name="keterangan_negeri" id="keterangan_negeri">
                            <div class="c_keterangan_negeri invalid-feedback text-right"></div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" id="btn-save-{{ $table_negeri }}">Simpan</button>
                <input type="hidden" name="action" id="action_{{ $table_negeri }}" value="add" />
                <input type="hidden" name="_method" id="method_{{ $table_negeri }}" value="" />
                <input type="hidden" name="hidden_id" id="hidden_id_{{ $table_negeri }}" />

            </div>
            </form>
        </div>
    </div>
</div>

@push('script')

<script type="text/javascript">
    var negeri = {

        route: {

            datatable_url         : "{{ route('negeri.index') }}",
            action_url            : "{{ route('negeri.index') }}/",
            store_url             : "{{ route('negeri.store') }}",

        },

        table:{

            name                  : "{{ $table_negeri }}",

        }

    };
</script>

<script src="{{ asset('js/ref/ref_negeri.js') }}"></script>

@endpush

