<div class="card card-with-border">
    <div class="card-header">
        <h5 class="f-w-900 mb-3">Tahun Peperiksaan</h5>
        <div class="card-header-right">
            <button class="btn btn-outline-light-dark btn-pill btn-sm pr-3 pl-3" type="button" data-toggle="modal" data-target="#replicationYear">
                <i class="fa fa-calendar "></i> Tambah Tahun
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            @foreach ( $tahunPeperiksaans as $tahunPeperiksaan)
                <div class="col-xl-6 col-lg-12">
                    <div class="card social-widget-card card-with-border">
                        <div class="card-header text-center">
                            <div class="card-header-right">
                                <a href="#" data-original-title="Menu"> <i class="fa fa-ellipsis-v"></i></a>
                            </div>
                            <h2 class="f-w-900">{{ $tahunPeperiksaan->tahun }}</h2>
                            <span>Tahun Peperiksaan {{ $tahunPeperiksaan->tahun }}</span>
                            <div class="mt-3">
                              <a class="btn btn-primary btn-sm p-1 pl-3 pr-2 text-white"
                                  href="{{ route( 'peperiksaan.kemaskini' , [$peperiksaan->keterangan, $tahunPeperiksaan->tahun] ) }}">
                                  KEMASKINI <i class="icon-arrow-circle-right pl-1 text-white"></i>
                              </a>
                            </div>
                        </div>
                        <div class="p-15">
                        <div class="row">
                            <div class="col text-center b-r-light"><span>Pangkalan Data Utama</span>
                            <h6 class="counter mb-0">LPM{{ $tahunPeperiksaan->tahun }}</h6>
                            </div>
                            <div class="col text-center"><span>Pangkalan Data Web</span>
                            <h6 class="counter mb-0">LPMWEB{{ $tahunPeperiksaan->tahun }}</h6>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

{{-- MODAL REPLICATION YEAR --}}
<div class="modal fade" id="replicationYear" tabindex="-1" role="dialog" aria-labelledby="modalReplicationYearLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalReplicationYearLabel">Tambah Tahun Peperiksaan {{ucwords(strtolower($peperiksaan->keterangan_panjang)) }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close" data-original-title="" title=""><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form id="form_tahun_peperiksaan" action="{{ route('peperiksaan.replication.year') }}">
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="alert alert-light" role="alert">
                                    <p>Isi maklumat pada ruangan di bawah, dan tekan butang <strong>Simpan</strong> untuk menambah rekod ke pangkalan data</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                           <h6>Maklumat Peperiksaan</h6>
                        </div>
                        <div class="col-md-6">
                            <div class="media">
                                <label class="col-form-label m-r-10">Aktif</label>
                                <div class="media-body text-right icon-state">
                                    <label class="switch">
                                        <input type="checkbox" name="aktif" id="aktif" value="1" >
                                        <span class="switch-state bg-primary"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <hr>
                            @csrf
                            <div class="row form-group">
                                <div class="col-lg-12 my-2">
                                    <b>Peperiksaan</b>
                                    <input type="text" name="peperiksaan" class="form-control" value="{{ ucwords(strtolower($peperiksaan->keterangan_panjang)) }}" disabled>
                                    <input type="hidden" name="id_peperiksaan" class="form-control" value="2">
                                    <div class="c_postcode invalid-feedback text-right"></div>
                                </div>
                                
                                <div class="col-lg-12 my-2">
                                    @php
                                        $years = array_combine(range(date("Y"), 2025), range(date("Y"), 2025));
                                        array_shift($years);
                                    @endphp

                                    <b id="label_pilih_tahun">Pilih Tahun</b>
                                    <select class="custom-select" name="tahun" id="tahun" required>
                                        <option value="" disabled selected hidden style="color: #a9a9a9 !important;">- Pilih Tahun</option>
                                        @foreach($years as $year)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endforeach
                                    </select>
                                    <div class="c_tahun invalid-feedback text-right"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light" type="button" data-dismiss="modal">Tutup</button>
                <button class="btn btn-primary" id="btn_save" type="submit">Submit</button>
            </div>
        </div>
    </div>
 </div>

 @push('script')
    <script src="{{ asset('js/ref/ref_replicate.js') }}"></script>     
 @endpush