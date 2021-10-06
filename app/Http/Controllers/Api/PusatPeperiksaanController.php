<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Events\SendEmailEvent;
use Illuminate\Support\Facades\Crypt;
use App\Models\Peperiksaan\Peperiksaan;
use App\Models\Status\StatusPengesahan;
use App\Http\Requests\Pusat\DaftarPusatRequest;
use App\Repositories\PusatPeperiksaanRepository;
use App\Models\Peperiksaan\RefPeperiksaan\Pusat;
use App\Http\Requests\Pusat\KemaskiniPusatRequest;
use App\Http\Requests\Pusat\PermohonanPusatRequest;
use App\Http\Requests\Pusat\PengesahanPusatRequest;
use App\Http\Requests\Pusat\SemakPermohonanPusatRequest;
use App\Http\Requests\Pusat\PengesahanPermohonanPusatRequest;

class PusatPeperiksaanController extends BaseApiController
{
    private $pusatRepository;

    public function __construct(PusatPeperiksaanRepository $pusatRepository)
    {
        $this->pusatRepository = $pusatRepository;
    }

    /*
    **  ========================== PERMOHONAN PUSAT ==========================
    */

    public function permohonanPusatPeperiksaan(PermohonanPusatRequest $request, $peperiksaan)
    {
        return $this->pusatRepository->permohonanPusatPeperiksaan($peperiksaan, $request);
    }

    public function pengesahanPermohonanPusatPeperiksaan(PengesahanPermohonanPusatRequest $request, $peperiksaan)
    {
        return $this->pusatRepository->pengesahanPermohonanPusatPeperiksaan($peperiksaan, $request);
    }

    public function kemaskiniPermohonanPusatPeperiksaan(Request $request, $peperiksaan)
    {
        return $this->pusatRepository->kemaskiniPermohonanPusatPeperiksaan($peperiksaan, $request);
    }

    public function semakPermohonanPusatPeperiksaan(SemakPermohonanPusatRequest $request, $peperiksaan)
    {
        return $this->pusatRepository->semakPermohonanPusatPeperiksaan($peperiksaan, $request);
    }

    public function senaraiPermohonanPusatPeperiksaan(Request $request, $peperiksaan)
    {
        return $this->pusatRepository->senaraiPermohonanPusatPeperiksaan( $peperiksaan, $request);
    }

    public function SenaraiPermohonanPusatLewat(Request $request, $peperiksaan)
    {
        return $this->pusatRepository->SenaraiPermohonanPusatLewat( $peperiksaan, $request);
    }

    public function senaraiPermohonanCalonPusat(Request $request, $peperiksaan)
    {
        return $this->pusatRepository->senaraiPermohonanCalonPusat( $peperiksaan, $request);
    }

    /*
    **  ========================== DAFTAR PUSAT ==========================
    */

    public function daftarPusatPeperiksaan(DaftarPusatRequest $request, $peperiksaan)
    {
        return $this->pusatRepository->daftarPusatPeperiksaan($peperiksaan, $request);
    }

    public function pengesahanPusatPeperiksaan(PengesahanPusatRequest $request, $peperiksaan)
    {
        return $this->pusatRepository->pengesahanPusatPeperiksaan($peperiksaan, $request);
    }

    public function kemaskiniPusatPeperiksaan(KemaskiniPusatRequest $request, $peperiksaan)
    {
        return $this->pusatRepository->kemaskiniPusatPeperiksaan($peperiksaan, $request);
    }

    public function semakPusatPeperiksaan(Request $request, $peperiksaan)
    {
        return $this->pusatRepository->semakPusatPeperiksaan($peperiksaan, $request);
    }

    public function senaraiPusatPeperiksaan(Request $request, $peperiksaan)
    {
        return $this->pusatRepository->senaraiPusatPeperiksaan($peperiksaan, $request);
    }

    public function senaraiSemuaPusatPeperiksaan(Request $request, $peperiksaan)
    {
        return $this->pusatRepository->senaraiSemuaPusatPeperiksaan($peperiksaan, $request);
    }

    /*
    **  ========================== CETAKAN LAPORAN PUSAT ==========================
    */

    public function cetakanSemuaPusat(Request $request)
    {
        return $this->pusatRepository->cetakanLaporanSemuaPusat();
    }

    /**
     * New API V2 
     */


    /**
     * Handle update status for pusat
     */
    public function updateStatus(Peperiksaan $peperiksaan, Request $request){

        $pusat = Pusat::find($request->id);

        if($request->id_status_pengesahan == StatusPengesahan::DALAM_PENGESAHAN_KPP_UPU){
    
            $res = app('PusatModule')
                ->setPeperiksaan($peperiksaan)
                ->setPusat($pusat)
                ->updateStatus();

            $kpp = User::where('id_pengguna', 'kpp_upu')->where('id_peperiksaan', $peperiksaan->id)->first();

            $details = [
                'title'     => 'Permohonan Pusat Lewat',
                'emails'    => [$kpp->email],
                'pusat'     => $pusat,
                'token'     => Crypt::encrypt($res->id),
                'view'      => 'emails.pusat.permohonan-lewat'
            ];
        }

        event(new SendEmailEvent($details));

        return $res;
    }

}
