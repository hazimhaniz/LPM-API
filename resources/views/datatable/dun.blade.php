@php

$table_dun     = 'dun';

@endphp

<div class="p-0">
    <div class="row clearfix">
        <div class="col-12">
            <div class="text-right mb-4">
                <a href="javascript:void(0);"
                    class="btn btn-pill btn-light btn-xs pr-3 pl-3 py-1 text-dark "
                    data-toggle="modal"
                    data-target="#modal-{{ $table_dun }}">
                    <i class="fa fa-plus text-dark" aria-hidden="true"></i> Tambah {{ $table_dun }}
                </a>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="display datatables" id="table-{{ $table_dun }}" style="width: 100%">
                    <thead>
                        <tr>
                            <th>Kod dun</th>
                            <th>Nama DUN</th>
                            <th>Negeri</th>
                            <th>parlimen</th>
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
<div class="modal fade" id="modal-{{ $table_dun }}" tabindex="-1" role="dialog" aria-labelledby="modal-{{ $table_dun }}-label" aria-hidden="true">
    <div class="modal-lg modal-dialog"  role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modal-{{ $table_dun }}-label">Tambah {{ ucfirst($table_dun) }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <form action="#" id="{{ $table_dun }}_form">
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
                            <small>Isi maklumat pada ruangan di bawah, dan tekan butang <strong>Simpan</strong> untuk menambah rekod ke pangkalan data</small>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="input_dun">Kod dun:</label>
                            <input type="text" class="form-control" placeholder="Taip nama dun atau kawasan" name="kod_dun" id="kod_dun">
                            <div class="c_kod_dun invalid-feedback text-right"></div>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="input_dun">Nama dun:</label>
                            <input type="text" class="form-control" placeholder="Taip nama dun atau kawasan" name="keterangan_dun" id="keterangan_dun">
                            <div class="c_keterangan_dun invalid-feedback text-right"></div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="select_dun_negeri">Negeri:</label>
                            <select class="custom-select" name="select_negeri_dun" id="select_negeri_dun">
                                <option value="" disabled selected hidden style="color: #a9a9a9 !important;">- Pilih negeri</option>
                                @foreach($negeri as $item)
                                <option value="{{ $item->id }}">{{ $item->keterangan }}</option>
                                @endforeach
                            </select>
                            <div class="c_select_negeri_dun invalid-feedback text-right"></div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                        <label for="select_dun_parlimen">parlimen:</label>
                            <select class="custom-select" name="select_parlimen_dun" id="select_parlimen_dun">
                                <option value="" disabled selected hidden style="color: #a9a9a9 !important;">- Pilih parlimen</option>
                            </select>
                            <div class="c_select_parlimen_dun invalid-feedback text-right"></div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" id="btn-save-{{ $table_dun }}">Simpan</button>
                <input type="hidden" name="action" id="action_{{ $table_dun }}" value="add" />
                <input type="hidden" name="_method" id="method_{{ $table_dun }}" value="" />
                <input type="hidden" name="hidden_id" id="hidden_id_{{ $table_dun }}" />
            </div>
            </form>
        </div>
    </div>
</div>

@push('script')

<script type="text/javascript">
    var dun = {

        route: {

            datatable_url         : "{{ route('dun.index') }}",
            action_url            : "{{ route('dun.index') }}/",
            store_url             : "{{ route('dun.store') }}",

        },

        table:{

            name                  : "{{ $table_dun }}",

        }

    };
</script>

<script src="{{ asset('js/ref/ref_dun.js') }}"></script>

@endpush
