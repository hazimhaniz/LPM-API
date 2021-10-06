@php

$table_kumpulan_kawalan     = 'kumpulan-kawalan';

@endphp

<div class="p-0">
    <div class="row clearfix">
        <div class="col-12">
            <div class="text-right mb-4">
                <a href="javascript:void(0);"
                    class="btn btn-pill btn-light btn-xs pr-3 pl-3 py-1 text-dark "
                    data-toggle="modal"
                    data-target="#modal-{{ $table_kumpulan_kawalan }}">
                    <i class="fa fa-plus text-dark" aria-hidden="true"></i> Tambah {{ $table_kumpulan_kawalan }}
                </a>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="display datatables" id="table-{{ $table_kumpulan_kawalan }}" style="width: 100%">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Diskripsi</th>
                            <th>Diskripsi Panjang</th>
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
<div class="modal fade" id="modal-{{ $table_kumpulan_kawalan }}" tabindex="-1" role="dialog" aria-labelledby="modal-{{ $table_kumpulan_kawalan }}-label" aria-hidden="true">
    <div class="modal-lg modal-dialog"  role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modal-{{ $table_kumpulan_kawalan }}-label">Tambah {{ ucfirst($table_kumpulan_kawalan) }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <form action="{{ route('kumpulan-kawalan.store') }}" id="{{ $table_kumpulan_kawalan }}_form" method="post">
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
                            <label for="name">Nama Peranan:</label>
                            <input type="text" class="form-control" placeholder="Taip nama peranan" name="name" id="name">
                            <div class="c_name invalid-feedback text-right"></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">Penerangan:</label>
                            <input type="text" class="form-control" placeholder="Keterangan ringkas peranan" name="description" id="description">
                            <div class="c_description invalid-feedback text-right"></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="default-according" id="accordionclose">
                                <div class="card">
                                    <a class="btn btn-link text-left p-0" data-toggle="collapse" data-target="#collapse1" aria-expanded="false" aria-controls="heading1" data-original-title="" title="">
                                        <div class="card-header text-white bg-dark" id="heading1">
                                            Kawalan Sistem :
                                        </div>
                                    </a>
                                    <div class="collapse" id="collapse1" aria-labelledby="heading1" data-parent="#accordionclose" style="">
                                    <div class="card-body p-1 pt-3">
                                        <div id="list-kawalan-sistem">

                                            <div class="default-according style-1" id="accordionoc">

                                            @foreach ($user_permissions as $permission)

                                                <div class="card">
                                                    <a class="btn bg-light text-left" data-toggle="collapse" data-target="#collapseicon-{{ $permission->id}}" aria-expanded="true">
                                                        <small><b>{{$loop->index + 1}} - {{ $permission->name}}</b></small>
                                                    </a>
                                                    <div class="collapse" id="collapseicon-{{ $permission->id}}" aria-labelledby="collapseicon" data-parent="#accordionoc" style="">
                                                    <div class="card-body">

                                                        @if (count($permission->subPermissions) > 0)

                                                            @foreach ($permission->subPermissions as $sub_permission)

                                                                <div>
                                                                    <input class="permission-checkbox-{{$sub_permission->id}}" type="checkbox" name="permissions[]" value="{{ $sub_permission->id}}"/>
                                                                    <label for="checkbox-primary-1">{{ $sub_permission->name}}</label>
                                                                </div>

                                                            @endforeach

                                                        @else

                                                            <p>Tiada rekod ditemui</p>

                                                        @endif

                                                    </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" id="btn-save-{{ $table_kumpulan_kawalan }}">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

@push('script')

<script type="text/javascript">

    var kumpulan_kawalan = {

        route: {

            datatable_url      : "{{ route('kumpulan-kawalan.index') }}",
            action_url         : "{{ route('kumpulan-kawalan.index') }}"

        },

        table:{

            name               : "{{ $table_kumpulan_kawalan }}",

        }
    };
</script>

<script type="module" src="{{ asset('js/modules/kumpulan_kawalan.js') }}"></script>

@endpush
