@php

$table_jadual_waktu_peperiksaan     = 'jadual-waktu-peperiksaan';

@endphp

<div class="p-0">
    <div class="row clearfix">
        <div class="col-12">
            <div class="text-right mb-4">
                <a href="javascript:void(0);"
                    class="btn btn-pill btn-light btn-xs pr-3 pl-3 py-1 text-dark "
                    data-toggle="modal"
                    data-target="#modal-{{ $table_jadual_waktu_peperiksaan }}">
                    <i class="fa fa-plus text-dark" aria-hidden="true"></i> Tambah {{ $table_jadual_waktu_peperiksaan }}
                </a>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="display datatables" id="table-{{ $table_jadual_waktu_peperiksaan }}" style="width: 100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Keterangan</th>
                            <th>Tempoh Masa</th>
                            <th>Waktu Mula</th>
                            <th>Waktu Tamat</th>
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
<div class="modal fade" id="modal-{{ $table_jadual_waktu_peperiksaan }}" tabindex="-1" role="dialog" aria-labelledby="modal-{{ $table_jadual_waktu_peperiksaan }}-label" aria-hidden="true">
    <div class="modal-lg modal-dialog"  role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modal-{{ $table_jadual_waktu_peperiksaan }}-label">Tambah {{ ucfirst($table_jadual_waktu_peperiksaan) }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <form action="#" id="{{ $table_jadual_waktu_peperiksaan }}_form">
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
                            <label for="keterangan">Keterangan :</label>
                            <input type="string" class="form-control" placeholder="Keterangan" name="keterangan" id="keterangan">
                        </div>
                    </div>

                    <div class="col-md-12">
                        {{-- <div class="form-group">
                            <label for="mata_pelajaran">Mata Pelajaran :</label>
                            <select class="custom-select" name="mata_pelajaran" id="mata_pelajaran">
                            </select>
                        </div> --}}
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="waktu_mula">Mula :</label>
                            <input type="datetime-local" class="form-control" data-language="en" placeholder="tarikh mula" name="waktu_mula" id="waktu_mula">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="waktu_tamat">Tamat :</label>
                            <input type="datetime-local" class="form-control" data-language="en" placeholder="tarikh tamat" name="waktu_tamat" id="waktu_tamat">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="durasi">Durasi :</label>
                            <input type="string" class="form-control" placeholder="Tempoh Masa" name="durasi" id="durasi" readonly>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="status">Status :</label>
                            <select class="custom-select" name="status" id="status">
                                <option>Aktif</option>
                                <option>Tak Aktif</option>
                            </select>
                        </div>
                    </div>

                    <input type="hidden" name="id_tahun_peperiksaan" value="{{ $tahunPeperiksaan->id }}">
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" id="btn-save-{{ $table_jadual_waktu_peperiksaan }}">Simpan</button>
                <input type="hidden" name="action" id="action_{{ $table_jadual_waktu_peperiksaan }}" value="add" />
                <input type="hidden" name="_method" id="method_{{ $table_jadual_waktu_peperiksaan }}" value="" />
                <input type="hidden" name="hidden_id" id="hidden_id_{{ $table_jadual_waktu_peperiksaan }}" />
            </div>
            </form>
        </div>
    </div>
</div>

@push('script')


<script type="text/javascript">

    var jadual_waktu_peperiksaan = {

        route: {

            datatable_url         : "{{ route('jadual-waktu-peperiksaan.index', ['id_tahun_peperiksaan'=> $tahunPeperiksaan->id]) }}",
            action_url            : "{{ route('jadual-waktu-peperiksaan.index') }}/",
            store_url             : "{{ route('jadual-waktu-peperiksaan.store') }}",

        },

        table:{

            name                  : "{{ $table_jadual_waktu_peperiksaan }}",

        }

    };
</script>

<script src="{{ asset('js/ref/ref_jadual_waktu_peperiksaan.js') }}"></script>

@endpush

