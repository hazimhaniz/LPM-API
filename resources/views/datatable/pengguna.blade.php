@php

$table_pengguna     = 'pengguna';

@endphp

<div class="p-0">
    <div class="row clearfix">
        <div class="col-12">
            <div class="text-right mb-4">
                <a href="javascript:void(0);"
                    class="btn btn-pill btn-light btn-xs pr-3 pl-3 py-1 text-dark "
                    data-toggle="modal"
                    data-target="#modal-{{ $table_pengguna }}">
                    <i class="fa fa-plus text-dark" aria-hidden="true"></i> Tambah {{ $table_pengguna }}
                </a>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="display datatables" id="table-{{ $table_pengguna }}" style="width: 100%">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Nama</th>
                            <th>ID Pengguna</th>
                            <th>Peranan</th>
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
<div class="modal fade" id="modal-{{ $table_pengguna }}" tabindex="-1" role="dialog" aria-labelledby="modal-{{ $table_pengguna }}-label" aria-hidden="true">
    <div class="modal-xl modal-dialog"  role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modal-{{ $table_pengguna }}-label">Tambah {{ ucfirst($table_pengguna) }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <form action="{{ route('pengguna.store') }}" id="{{ $table_pengguna }}_form" method="post">
            @csrf
            <div class="modal-body">
                <div class="row clearfix">

                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="alert alert-light" role="alert">
                                <p>Isi maklumat pada ruangan di bawah, dan tekan butang <strong>Simpan</strong> untuk menambah rekod ke pangkalan data</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">

                        <h5 class="card-title">Maklumat Pengguna</h5> <hr>

                        <div class="form-group">
                            <label for="select_peranan"><b>Peranan</b></label>
                            <select class="custom-select" name="select_peranan" id="select_peranan">
                                <option value="" disabled selected hidden style="color: #a9a9a9 !important;">- Pilih peranan</option>
                                @foreach($user_roles as $item)
                                    <option value="{{ $item->id }}">{{ $item->description }}</option>
                                @endforeach
                            </select>
                            <div class="c_role invalid-feedback text-right"></div>
                        </div>

                        <div class="form-group select_negeri_pengguna" style="display: none">
                            <label for="select_negeri_{{ $table_pengguna }}"><b>Negeri</b></label>
                            <select class="custom-select" name="select_negeri_{{ $table_pengguna }}" id="select_negeri_{{ $table_pengguna }}">
                                <option value="" disabled selected hidden style="color: #a9a9a9 !important;">- Pilih Negeri</option>
                                @foreach($negeri as $state)
                                    <option value="{{ $state->id }}">{{ $state->keterangan }}</option>
                                @endforeach
                            </select>
                            <div class="c_select_pengguna_negeri invalid-feedback text-right"></div>
                        </div>

                        <div class="form-group select_sekolah_pengguna" style="display: none">
                            <label for="select_sekolah_{{ $table_pengguna }}"><b>Sekolah</b></label>
                            <select class="custom-select" name="select_sekolah_{{ $table_pengguna }}" id="select_sekolah_{{ $table_pengguna }}">
                                <option value="" disabled selected hidden style="color: #a9a9a9 !important;">- Pilih sekolah</option>
                                @foreach($sekolahs as $sekolah)
                                    <option value="{{ $sekolah->id }}">{{ $sekolah->nama_sekolah }}</option>
                                @endforeach
                            </select>
                            <div class="c_role invalid-feedback text-right"></div>
                        </div>

                        <div class="form-group">
                            <b>Alamat email</b>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-envelope-o"></i></span>
                                </div>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Cth: ali@email.com" id="email">
                                <div class="c_email invalid-feedback text-right"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <b>ID Pengguna</b>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-mouse-pointer"></i></span>
                                </div>
                                <input type="text" name="id_pengguna" id="id_pengguna" class="form-control" value="" placeholder="kata nama">
                                <div class="c_id_pengguna invalid-feedback text-right"></div>
                            </div>
                        </div>

                        <div class="form-group form-kata-laluan controls show-hide-wpd">
                            <b>Kata laluan</b>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-key"></i></span>
                                </div>
                                <input type="password" name="password_1" id="password_1" class="form-control" value="" placeholder="kata laluan anda">
                                <div class="c_password invalid-feedback text-right"></div>
                            </div>
                        </div>

                        <div class="form-group controls show-hide-wpd">
                            <b>Kata laluan (taip semula)</b>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-key"></i></span>
                                </div>
                                <input type="password" name="password_2" id="password_2" class="form-control" value="{{ old('password_2') }}" placeholder="kata laluan (taip semula)">
                                <div class="invalid-feedback text-right"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">

                        <h5 class="card-title">Maklumat Personel</h5> <hr>

                        <div class="form-group">
                            <b>Nama penuh</b>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-mouse-pointer"></i></span>
                                </div>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="nama penuh anda">
                                <div class="c_name invalid-feedback text-right"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <b>No Kad Pengenalan</b>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-id-card-o"></i></span>
                                </div>
                                <input type="text" name="ic" id="ic" class="form-control" value="{{ old('ic') }}" placeholder="XXXXXXXXXXXX" id="no-ic">
                                <div class="c_ic invalid-feedback text-right"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <b>No Telefon</b>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                </div>
                                <input type="text" name="phone" id="phone" class="form-control phone-number" value="{{ old('phone') }}" placeholder="Cth: 000-00000000" id="no-telefon">
                                <div class="c_phone invalid-feedback text-right"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <h5 class="card-title">Alamat Pengguna</h5> <hr>
                        <div class="form-group">
                            <b>Alamat Penuh</b>
                            <textarea name="address" id="address" class="form-control"></textarea>
                            <div class="c_address invalid-feedback text-right"></div>
                        </div>

                        <div class="row form-group">
                            <div class="col-lg-4">
                                <b>Poskod</b>
                                <input type="text" name="postcode" id="postcode" class="form-control" value="{{ old('postcode') }}" placeholder="">
                                <div class="c_postcode invalid-feedback text-right"></div>
                            </div>
                            <div class="col-lg-4">
                                <b>Negeri</b>
                                <select class="custom-select" name="select_pengguna_negeri" id="select_pengguna_negeri">
                                    <option value="" disabled selected hidden style="color: #a9a9a9 !important;">- Pilih Negeri</option>
                                    @foreach($negeri as $state)
                                        <option value="{{ $state->id }}">{{ $state->keterangan }}</option>
                                    @endforeach
                                </select>
                                <div class="c_select_pengguna_negeri invalid-feedback text-right"></div>
                            </div>
                            <div class="col-lg-4">
                                <b>Bandar</b>
                                <select class="custom-select" name="select_pengguna_bandar" id="select_pengguna_bandar">
                                    <option value="" disabled selected hidden style="color: #a9a9a9 !important;">- Sila Pilih Negeri Dahulu</option>
                                    @foreach($bandar as $city)
                                        <option value="{{ $city->id }}">{{ $city->keterangan }}</option>
                                    @endforeach
                                </select>
                                <div class="c_select_pengguna_bandar invalid-feedback text-right"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <input type="hidden" name="id_peperiksaan" value="{{ $peperiksaan->id }}">

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" id="btn-save-{{ $table_pengguna }}">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

@push('script')

<script type="text/javascript">

    let pengguna = {

        route: {

            datatable_url              : "{{ route('pengguna.index', ['id_peperiksaan'=> $peperiksaan->id]) }}",
            action_url                 : "/selenggara-data/pengguna",
            bandar_url                 : "{{ route('bandar.index') }}",
            sekolah_url                : "{{ route('sekolah.index') }}"
        },

        table:{

            name                       : "{{ $table_pengguna }}",

        }

    };
</script>

<script type="module" src="{{ asset('js/modules/pengguna.js') }}"></script>

@endpush
