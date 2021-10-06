<div class="card card-with-border">
    <div class="card-header">
        <h5 class="f-w-900 mb-3">Pengurusan Jadual</h5>
        <ul class="nav nav-pills nav-primary"  role="tablist" aria-orientation="vertical">
            <li class="nav-item"><a class="nav-link btn btn-outline-light-dark btn-sm m-1 active" data-toggle="tab" href="#datatable-jadual-kerja">Jadual Kerja</a></li>
            <li class="nav-item"><a class="nav-link btn btn-outline-light-dark btn-sm m-1" data-toggle="tab" href="#datatable-jadual-waktu-peperiksaan">Jadual Waktu Peperiksaan</a></li>
        </ul>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="datatable-jadual-kerja">
                        @include('datatable.jadual-kerja')
                    </div>
                    <div class="tab-pane fade show" id="datatable-jadual-waktu-peperiksaan">
                        @include('datatable.jadual-waktu-peperiksaan')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>