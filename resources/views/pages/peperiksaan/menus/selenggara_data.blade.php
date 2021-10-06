<div class="card card-with-border">
    <div class="card-header">
        <h5 class="f-w-900 mb-3">Selenggara Data</h5>
        <ul class="nav nav-pills nav-primary"  role="tablist" aria-orientation="vertical">
            <li class="nav-item"><a class="nav-link btn btn-outline-light-dark btn-sm m-1 active" data-toggle="tab" href="#datatable-jenis-calon">Jenis Calon</a></li>
            <li class="nav-item"><a class="nav-link btn btn-outline-light-dark btn-sm m-1" data-toggle="tab" href="#datatable-jenis-kemasukan">Jenis Kemasukan</a></li>
            <li class="nav-item"><a class="nav-link btn btn-outline-light-dark btn-sm m-1" data-toggle="tab" href="#datatable-daerah">Daerah</a></li>
        </ul>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="datatable-jenis-calon">
                        @include('datatable.jenis-calon')
                    </div>
                    <div class="tab-pane fade show" id="datatable-jenis-kemasukan">
                        @include('datatable.jenis-kemasukan')
                    </div>
                    <div class="tab-pane fade show" id="datatable-daerah">
                        @include('datatable.daerah')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>