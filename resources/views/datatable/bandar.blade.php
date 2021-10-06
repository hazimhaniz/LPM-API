@php

$table_bandar     = 'bandar';

@endphp

<div class="p-0">
    <div class="row clearfix">
        <div class="col-12">
            <div class="text-right mb-4">
                <a href="javascript:void(0);" class="btn btn-pill btn-light btn-xs pr-3 pl-3 py-1 text-dark " data-toggle="modal" data-target="#modal-{{ $table_bandar }}">
                    <i class="fa fa-plus text-dark" aria-hidden="true"></i> Tambah {{ $table_bandar }}
                </a>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="display datatables" id="table-{{ $table_bandar }}" style="width: 100%">
                    <thead>
                        <tr>
                            <th>Nama Bandar / Kawasan / Tempat</th>
                            <th>Negeri</th>
                            <th>Daerah</th>
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
<div class="modal fade" id="modal-{{ $table_bandar }}" tabindex="-1" role="dialog" aria-labelledby="modal-{{ $table_bandar }}-label" aria-hidden="true">
    <div class="modal-lg modal-dialog"  role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modal-{{ $table_bandar }}-label">Tambah {{ ucfirst($table_bandar) }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <form action="#" id="{{ $table_bandar }}_form">
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
                            <label for="input_bandar">Nama Bandar / Kawasan / Tempat:</label>
                            <input type="text" class="form-control" placeholder="Taip nama bandar atau kawasan" name="keterangan_bandar" id="keterangan_bandar">
                            <div class="c_keterangan_bandar invalid-feedback text-right"></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="select_bandar_negeri">Negeri:</label>
                            <select class="custom-select" name="select_negeri_bandar" id="select_negeri_bandar">
                                <option value="" disabled selected hidden style="color: #a9a9a9 !important;">- Pilih negeri</option>
                                @foreach($negeri as $item)
                                <option value="{{ $item->id }}">{{ $item->keterangan }}</option>
                                @endforeach
                            </select>
                            <div class="c_select_negeri_bandar invalid-feedback text-right"></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                        <label for="select_bandar_daerah">Daerah:</label>
                            <select class="custom-select" name="select_daerah_bandar" id="select_daerah_bandar">
                                <option value="" disabled selected hidden style="color: #a9a9a9 !important;">- Pilih daerah</option>
                            </select>
                            <div class="c_select_daerah_bandar invalid-feedback text-right"></div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" id="btn-save-{{ $table_bandar }}">Simpan</button>
                <input type="hidden" name="action" id="action_{{ $table_bandar }}" value="add" />
                <input type="hidden" name="_method" id="method_{{ $table_bandar }}" value="" />
                <input type="hidden" name="hidden_id" id="hidden_id_{{ $table_bandar }}" />
            </div>
            </form>
        </div>
    </div>
</div>

@push('script')

<script type="text/javascript">

    var bandar = {

        route: {

            datatable_url         : "{{ route('bandar.index') }}",
            action_url            : "{{ route('bandar.index') }}/",
            store_url             : "{{ route('bandar.store') }}",

        },

        table:{

            name                  : "{{ $table_bandar }}",

        }

    };
</script>
<script src="{{ asset('js/ref/ref_bandar.js') }}"></script>

@endpush
