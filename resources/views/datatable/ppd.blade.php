@php

$table_ppd     = 'PPD';

@endphp

<div class="card card-with-border">
    <div class="card-body">
        <div class="row clearfix">
            <div class="col-12">
                <div class="text-right mb-4">
                    <a href="javascript:void(0);"
                        class="btn btn-pill btn-light btn-xs pr-3 pl-3 py-1 text-dark" data-toggle="modal"
                        data-target="#modal-{{ $table_ppd }}">
                        <i class="fa fa-plus text-dark" aria-hidden="true"></i> Tambah {{ $table_ppd }}
                    </a>
                </div>
                <hr>
                <div class="table-responsive">
                    <table class="display datatables" id="table-{{ $table_ppd }}" style="width: 100%">
                        <thead>
                            <tr>
                                <th>Kod PPD</th>
                                <th>Nama PPD</th>
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
<div class="modal fade" id="modal-{{ $table_ppd }}" tabindex="-1" role="dialog" aria-labelledby="modal-{{ $table_ppd }}-label" aria-hidden="true">
    <div class="modal-lg modal-dialog"  role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modal-{{ $table_ppd }}-label">Tambah {{ ucfirst($table_ppd) }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <form action="#" id="{{ $table_ppd }}_form">
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
                            <label for="kod_ppd">Kod PPD:</label>
                            <input type="text" class="form-control" placeholder="Taip no kod ppd" name="kod_ppd" id="input_kod_ppd">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="input_ppd">Nama PPD:</label>
                            <input type="text" class="form-control" placeholder="Taip nama ppd" name="nama_ppd" id="input_nama_ppd">
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="form-group">
                        <label for="select_ppd_negeri">Negeri:</label>
                            <select class="custom-select" name="select_negeri" id="select_ppd_negeri">
                                <option value="" disabled selected hidden style="color: #a9a9a9 !important;">- Pilih negeri</option>
                                @foreach($negeri as $item)
                                <option value="{{ $item->id }}">{{ $item->keterangan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" id="btn-save-{{ $table_ppd }}">Simpan</button>
                <input type="hidden" name="action" id="action_{{ $table_ppd }}" value="add" />
                <input type="hidden" name="_method" id="method_{{ $table_ppd }}" value="" />
                <input type="hidden" name="hidden_id" id="hidden_id_{{ $table_ppd }}" />
            </div>
            </form>
        </div>
    </div>
</div>

@push('script')

<script>

    var ppd = {

        route: {

            datatable_url               : "{{ route('ppd.index', ['id_peperiksaan'=> $tahunPeperiksaan->id]) }}",
            action_url                  : "{{ route('ppd.index') }}/",
            store_url                   : "{{ route('ppd.store') }}",

        },

        table:{

            name                        : "{{ $table_ppd }}",

        }

    };

</script>

<script src="{{ asset('js/ref/ref_ppd.js') }}"></script>

@endpush
