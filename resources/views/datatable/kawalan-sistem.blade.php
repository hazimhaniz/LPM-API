@php

$table_kawalan_sistem     = 'kawalan-sistem';

@endphp

<div class="p-0">
    <div class="row clearfix">
        <div class="col-12">
            {{-- <div class="text-right mb-4">
                <a href="javascript:void(0);"
                    class="btn btn-pill btn-light btn-xs pr-3 pl-3 py-1 text-dark "
                    data-toggle="modal"
                    data-target="#modal-{{ $table_kawalan_sistem }}">
                    <i class="fa fa-plus text-dark" aria-hidden="true"></i> Tambah {{ $table_kawalan_sistem }}
                </a>
            </div> --}}
          
            <div class="table-responsive">
                <table class="display datatables" id="table-{{ $table_kawalan_sistem }}" style="width: 100%">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Kumpulan Kawalan Sistem</th>
                            <th>Kawalan Sistem</th>
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
<div class="modal fade" id="modal-{{ $table_kawalan_sistem }}" tabindex="-1" role="dialog" aria-labelledby="modal-{{ $table_kawalan_sistem }}-label" aria-hidden="true">
    <div class="modal-lg modal-dialog"  role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modal-{{ $table_kawalan_sistem }}-label">Tambah {{ ucfirst($table_kawalan_sistem) }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <form action="{{ route('kawalan-sistem.store') }}" id="{{ $table_kawalan_sistem }}_form" method="post">
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
                            <label for="kod_pusat">Nama Kumpulan Kawalan Sistem:</label>
                            <input type="text" class="form-control" placeholder="Taip nama peranan" name="name_kawalan_sistem" id="name_kawalan_sistem">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="input_pusat">Penerangan:</label>
                            <input type="text" class="form-control" placeholder="Keterangan ringkas kawalan sistem" name="description_kawalan_sistem" id="description_kawalan_sistem">
                        </div>
                    </div>
                    {{-- <div class="col-md-12">
                        <div class="form-group">
                            <label for="input_pusat">Kawalan Sistem:</label>
                            <div class="input-wrapper"></div>
                            <a href="#" class="tambah-input"> + Tambah Kawalan Sistem</a>
                        </div>
                    </div> --}}

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" id="btn-save-{{ $table_kawalan_sistem }}">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

@push('script')


<script type="text/javascript">

    var kawalan_sistem = {

        route: {

            datatable_url        : "{{ route('kawalan-sistem.index') }}",
            action_url           : "{{ route('kawalan-sistem.index') }}",

        },

        table:{

            name                 : "{{ $table_kawalan_sistem }}",

        }

    };
</script>


<script type="module" src="{{ asset('js/modules/kawalan_sistem.js') }}"></script>

@endpush
