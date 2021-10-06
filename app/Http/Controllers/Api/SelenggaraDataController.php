<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Constant\Negara;
use App\Repositories\SelenggaraDataRepository;
use Illuminate\Http\Request;
class SelenggaraDataController extends Controller
{
    private $selenggaraDataRepository;

    public function __construct(SelenggaraDataRepository $selenggaraDataRepository)
    {
        $this->selenggaraDataRepository = $selenggaraDataRepository;
    }

    function peperiksaan(Request $request, $peperiksaan)
    {
        return $this->selenggaraDataRepository->peperiksaan($peperiksaan, $request);
    }

    function tahunPeperiksaan(Request $request, $peperiksaan)
    {
        return $this->selenggaraDataRepository->tahunPeperiksaan($peperiksaan, $request);
    }

    function kumpulanKawalan(Request $request, $peperiksaan)
    {
        return $this->selenggaraDataRepository->kumpulanKawalan($peperiksaan, $request);
    }

    function jenisKemasukan(Request $request, $peperiksaan)
    {
        return $this->selenggaraDataRepository->jenisKemasukan($peperiksaan, $request);
    }

    function jenisKecacatan(Request $request, $peperiksaan)
    {
        return $this->selenggaraDataRepository->jenisKecacatan($peperiksaan, $request);
    }

    function jenisCalon(Request $request, $peperiksaan)
    {
        return $this->selenggaraDataRepository->jenisCalon($peperiksaan, $request);
    }

    function jenisPendaftaran(Request $request, $peperiksaan)
    {
        return $this->selenggaraDataRepository->jenisPendaftaran($peperiksaan, $request);
    }

    function mataPelajaran(Request $request, $peperiksaan)
    {
        return $this->selenggaraDataRepository->mataPelajaran($peperiksaan, $request);
    }

    function jenisJantina(Request $request, $peperiksaan)
    {
        return $this->selenggaraDataRepository->jenisJantina($peperiksaan, $request);
    }

    function jenisKeturunan(Request $request, $peperiksaan)
    {
        return $this->selenggaraDataRepository->jenisKeturunan($peperiksaan, $request);
    }

    function agama(Request $request, $peperiksaan)
    {
        return $this->selenggaraDataRepository->agama($peperiksaan, $request);
    }

    function daerah(Request $request, $peperiksaan)
    {
        return $this->selenggaraDataRepository->daerah($peperiksaan, $request);
    }

    function negeri(Request $request, $peperiksaan)
    {
        return $this->selenggaraDataRepository->negeri($peperiksaan, $request);
    }

    function bandar(Request $request, $peperiksaan)
    {
        return $this->selenggaraDataRepository->bandar($peperiksaan, $request);
    }

    function sekolah(Request $request, $peperiksaan)
    {
        return $this->selenggaraDataRepository->sekolah($peperiksaan, $request);
    }

    function pusat(Request $request, $peperiksaan)
    {
        return $this->selenggaraDataRepository->pusat($peperiksaan, $request);
    }

    function jadualKerja(Request $request, $peperiksaan)
    {
        return $this->selenggaraDataRepository->jadualKerja($peperiksaan, $request);
    }

    /**
     * New API V2 
     */
    public function negara(Request $request, $peperiksaan){
        return Negara::where('status', true)
                ->when($request->id, fn($q) => $q->where('id',$request->id))
                ->get();
    }
}
