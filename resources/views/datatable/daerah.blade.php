@php

$table_daerah     = 'daerah';

@endphp

<div class="p-0">
    <div class="row clearfix">
        <div class="col-12">
            <div class="text-right mb-4">
                <a href="javascript:void(0);"
                    class="btn btn-pill btn-light btn-xs pr-3 pl-3 py-1 text-dark "
                    data-toggle="modal"
                    data-target="#modal-{{ $table_daerah }}">
                    <i class="fa fa-plus text-dark" aria-hidden="true"></i> Tambah {{ $table_daerah }}
                </a>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="display datatables" id="table-{{ $table_daerah }}" style="width: 100%">
                    <thead>
                        <tr>
                            <th>Kod Daerah</th>
                            <th>Keterangan</th>
                            <th>Negeri</th>
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
<div class="modal fade" id="modal-{{ $table_daerah }}" tabindex="-1" role="dialog" aria-labelledby="modal-{{ $table_daerah }}-label" aria-hidden="true">
    <div class="modal-lg modal-dialog"  role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modal-{{ $table_daerah }}-label">Tambah {{ ucfirst($table_daerah) }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <form action="#" id="{{ $table_daerah }}_form">
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
                            <label for="kod_daerah">Kod Daerah:</label>
                            <input type="text" class="form-control" placeholder="Taip kod daerah" name="kod_daerah" id="input_kod_daerah">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="input_keterangan">Keterangan:</label>
                            <input type="text" class="form-control" placeholder="Taip keterangan" name="keterangan" id="input_keterangan_daerah">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                        <label for="select_negeri">Negeri:</label>
                            <select class="custom-select" name="select_negeri" id="select_negeri">
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
                <button type="submit" class="btn btn-primary" id="btn-save-{{ $table_daerah }}">Simpan</button>
                <input type="hidden" name="action" id="action_{{ $table_daerah }}" value="add" />
                <input type="hidden" name="_method" id="method_{{ $table_daerah }}" value="" />
                <input type="hidden" name="hidden_id" id="hidden_id_{{ $table_daerah }}" />
            </div>
            </form>
        </div>
    </div>
</div>

@push('script')

<script type="text/javascript">
    var daerah = {

        route: {

            datatable_url         : "{{ route('daerah.index') }}",
            action_url            : "{{ route('daerah.index') }}/",
            store_url             : "{{ route('daerah.store') }}",

        },

        table:{

            name                  : "{{ $table_daerah }}",

        }

    };
</script>

<script src="{{ asset('js/ref/ref_daerah.js') }}"></script>

@endpush
