
<table class="table table-border">
    <thead>
        <tr>
            <th >BIL</th>
            <th >NAMA CALON</th>
            <th >ANGKA GILIRAN</th>
            <th >KOD PUSAT</th>
            <th >NAMA PUSAT</th>
            <th >JENIS PENDAFTARAN CALON</th>
            <th >NO KAD PENGENALAN / PASSPORT</th>
            <th >NO TELEFON</th>
        </tr>
    </thead>
    @foreach($calonDibatalkan as $key => $calon)
    <tbody>
        <tr> 
            <td>{{$key + 1}}</td>
            <td>{{ $calon->nama ?? '-' }}</td>
            <td>{{ $calon->angka_giliran ?? '-' }}</td>
            <td>{{ $calon->pusat->kod_pusat ?? '-' }}</td>
            <td>{{ $calon->pusat->nama_pusat ?? '-' }}</td>
            <td>{{ $calon->JenisPendaftaran->keterangan ?? '-' }}</td>
            <td>{{ $calon->no_kad_pengenalan ?? $calon->no_pengenalan_lain ?? '-' }}</td>
            <td>{{ $calon->no_telefon ?? '-' }}</td>
            
        </tr>
    </tbody>
    @endforeach
</table>


