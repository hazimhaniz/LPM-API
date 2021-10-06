@php

$table_parlimen     = 'parlimen';

@endphp

<div class="p-0">
    <div class="row clearfix">
        <div class="col-12">
            <div class="text-right mb-4">
                <a href="javascript:void(0);"
                    class="btn btn-pill btn-light btn-xs pr-3 pl-3 py-1 text-dark "
                    data-toggle="modal"
                    data-target="#modal-{{ $table_parlimen }}">
                    <i class="fa fa-plus text-dark" aria-hidden="true"></i> Tambah {{ $table_parlimen }}
                </a>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="display datatables" id="table-{{ $table_parlimen }}" style="width: 100%">
                    <thead>
                        <tr>
                            <th>Kod parlimen</th>
                            <th>Nama parlimen</th>
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
<div class="modal fade" id="modal-{{ $table_parlimen }}" tabindex="-1" role="dialog" aria-labelledby="modal-{{ $table_parlimen }}-label" aria-hidden="true">
    <div class="modal-lg modal-dialog"  role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modal-{{ $table_parlimen }}-label">Tambah {{ ucfirst($table_parlimen) }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <form action="#" id="{{ $table_parlimen }}_form">
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
                            <small>Isi maklumat pada ruangan di bawah, dan tekan butang <strong>Simpan</strong> untuk menambah rekod ke pangkalan data</small>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="kod_parlimen">Kod parlimen:</label>
                            <input type="text" class="form-control" placeholder="Taip no id parlimen" name="kod_parlimen" id="kod_parlimen">
                            <div class="c_kod_parlimen invalid-feedback text-right"></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="input_parlimen">Nama parlimen:</label>
                            <input type="text" class="form-control" placeholder="Taip nama parlimen" name="keterangan_parlimen" id="keterangan_parlimen">
                            <div class="c_keterangan_parlimen invalid-feedback text-right"></div>
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
                            <div class="c_select_negeri invalid-feedback text-right"></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="kod_ppd">Kod PPD:</label>
                            <select class="custom-select" name="select_ppd" id="select_ppd">
                                <option value="" disabled selected hidden style="color: #a9a9a9 !important;">- Pilih Kod PPD</option>
                                @foreach($kod_ppd as $item)
                                <option value="{{ $item->id }}">{{ $item->kod_ppd }} - {{ $item->nama_ppd }}</option>
                                @endforeach
                            </select>
                            <div class="c_select_ppd invalid-feedback text-right"></div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" id="btn-save-{{ $table_parlimen }}">Simpan</button>
                <input type="hidden" name="action" id="action_{{ $table_parlimen }}" value="add" />
                <input type="hidden" name="_method" id="method_{{ $table_parlimen }}" value="" />
                <input type="hidden" name="hidden_id" id="hidden_id_{{ $table_parlimen }}" />
            </div>
            </form>
        </div>
    </div>
</div>

@push('script')

<script type="text/javascript">
    var parlimen = {

        route: {

            datatable_url         : "{{ route('parlimen.index') }}",
            action_url            : "{{ route('parlimen.index') }}/",
            store_url             : "{{ route('parlimen.store') }}",

        },

        table:{

            name                  : "{{ $table_parlimen }}",

        }

    };
</script>

<script src="{{ asset('js/ref/ref_parlimen.js') }}"></script>

@endpush
