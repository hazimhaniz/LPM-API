<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\CalonRepository;
use App\Http\Requests\Calon\DaftarCalonRequest;
use App\Http\Requests\Calon\KemaskiniCalonRequest;
use App\Http\Requests\Calon\DaftarSenaraiCalonRequest;
use App\Http\Requests\Calon\DaftarCalonPersendirianRequest;
use App\Http\Requests\Calon\MuatNaikDokumenRequest;
use App\Http\Requests\Calon\PembatalanCalonRequest;
use App\Http\Requests\Calon\PembetulanCalonRequest;
use App\Http\Requests\Calon\PengesahanCalonRequest;
use App\Http\Requests\DaftarCalonRequest as RequestsDaftarCalonRequest;
use App\Http\Requests\kemaskiniCalonPt3Request;
use Validator;
class CalonController extends BaseApiController
{

    private $calonRepository;

    public function __construct(CalonRepository $calonRepository)
    {
        $this->calonRepository = $calonRepository;
    }

    /*
    **  ========================== DAFTAR CALON ==========================
    */

    public function daftarCalon(DaftarCalonRequest $request, $peperiksaan)
    {
        return $this->calonRepository->daftarCalon($peperiksaan, $request);
    }

    public function daftarSenaraiCalon(DaftarSenaraiCalonRequest $request, $peperiksaan)
    {
        return $this->calonRepository->daftarSenaraiCalon($peperiksaan, $request);
    }

    /*
    **  ========================== SEMAK CALON ==========================
    */

    public function semakCalon(Request $request, $peperiksaan)
    {
        return $this->calonRepository->semakCalon($peperiksaan, $request);
    }

    public function semakSenaraiCalon(Request $request, $peperiksaan)
    {
        return $this->calonRepository->semakSenaraiCalon($peperiksaan, $request);
    }

    public function semakSenaraiCalonSekolah(Request $request, $peperiksaan)
    {
        return $this->calonRepository->senaraiCalonSekolah($peperiksaan, $request);
    }

    public function semakSenaraiCalonLewat(Request $request, $peperiksaan)
    {
        return $this->calonRepository->senaraiCalonLewat($peperiksaan, $request);
    }

    public function semakSenaraiCalonPmc(Request $request, $peperiksaan)
    {
        return $this->calonRepository->senaraiCalonPmc($peperiksaan, $request);
    }

    public function getNotification(Request $request, $peperiksaan)
    {
        return $this->calonRepository->getNotification($peperiksaan, $request);
    }

    public function semakStatusPendaftaran(Request $request, $peperiksaan)
    {
        return $this->calonRepository->semakStatusPendaftaran($peperiksaan, $request);
    }

    public function senaraiCbk(Request $request, $peperiksaan)
    {
        return $this->calonRepository->senaraiCbk($peperiksaan, $request);
    }

    public function pengesahanCbk(Request $request, $peperiksaan)
    {
        return $this->calonRepository->pengesahanCbk($peperiksaan, $request);
    }

    /*
    **  ========================== TINDAKAN CALON ==========================
    */

    public function kemaskiniCalon(KemaskiniCalonRequest $request, $peperiksaan)
    {
        return $this->calonRepository->kemaskiniCalon($peperiksaan, $request);
    }

    public function kemaskiniCalonPT3(kemaskiniCalonPt3Request $request, $peperiksaan)
    {   
        return $this->calonRepository->kemaskiniCalon($peperiksaan, $request);
    }

    public function padamCalon(Request $request, $peperiksaan)
    {
        return $this->calonRepository->padamCalon($peperiksaan, $request);
    }

    /*
    **  ========================== CALON PERSENDIRIAN ==========================
    */

    public function daftarAkaunCalon(DaftarCalonPersendirianRequest $request, $peperiksaan)
    {
        return $this->calonRepository->daftarAkaunCalonPersendirian($peperiksaan, $request);
    }

    /*
    **  ========================== MATA PELAJARAN ==========================
    */

    public function daftarMataPelajaran(Request $request, $peperiksaan)
    {
        return $this->calonRepository->daftarMataPelajaran($peperiksaan, $request);
    }

    public function daftarSenaraiMataPelajaran(Request $request, $peperiksaan)
    {
        return $this->calonRepository->daftarSenaraiMataPelajaran($peperiksaan, $request);
    }

    public function semakMataPelajaran(Request $request, $peperiksaan)
    {
        return $this->calonRepository->semakMataPelajaran($peperiksaan, $request);
    }

    public function padamMataPelajaran(Request $request, $peperiksaan)
    {
        return $this->calonRepository->padamMataPelajaran($peperiksaan, $request);
    }

    /*
    **  ========================== MUAT NAIK DOKUMEN ==========================
    */

    public function muatNaikDokumen(MuatNaikDokumenRequest $request, $peperiksaan) {

        return $this->calonRepository->muatNaikDokumen($peperiksaan, $request);
    }

    public function padamDokumen(Request $request, $peperiksaan)
    {
        return $this->calonRepository->padamDokumen($peperiksaan, $request);
    }

    public function senaraiDokumen(Request $request, $peperiksaan)
    {
        return $this->calonRepository->senaraiDokumen($peperiksaan, $request);
    }

    /*
    **  ========================== INTEGRASI ==========================
    */

    public function semakCalonAPDM(Request $request, $peperiksaan)
    {
        return $this->calonRepository->semakCalonAPDM($peperiksaan, $request);
    }

    public function semakCalonJPN(Request $request, $peperiksaan)
    {
        return $this->calonRepository->semakCalonJPN($peperiksaan, $request);
    }

    /*
    **  ========================== PEMBAYARAN ==========================
    */

    public function pembayaranPendaftaranLewat(Request $request, $peperiksaan)
    {
        return $this->calonRepository->pembayaranPendaftaranLewat($peperiksaan, $request);
    }

    public function pembayaran(Request $request, $peperiksaan)
    {
        return $this->calonRepository->pembayaranPendaftaran($peperiksaan, $request);
    }

    public function pembayaranPT3(Request $request, $peperiksaan)
    {
        return $this->calonRepository->pembayaranPendaftaranPT3($peperiksaan, $request);
    }

    public function statusPembayaran(Request $request, $peperiksaan)
    {
        return $this->calonRepository->statusPembayaran($peperiksaan, $request);
    }

    public function senaraiPermohonanCalonLewat(Request $request, $peperiksaan)
    {
        return $this->calonRepository->senaraiPermohonanCalonLewat($peperiksaan, $request);
    }

    /*
    **  ========================== PENGESAHAN ==========================
    */
    
    /*
    **  ========================== PEMBETULAN ==========================
    */
    public function listPembetulanCalon(Request $request, $peperiksaan){

        return $this->calonRepository->listPembetulanCalon($request, $peperiksaan);
    }

    public function pembetulanCalon(Request $request, $peperiksaan){

        return $this->calonRepository->pembetulanCalon($peperiksaan, $request);
    }

    public function permohonanPembetulan(PembetulanCalonRequest $request, $peperiksaan) {
        //pt3
        if ($peperiksaan->id == 1){
            return $this->calonRepository->permohonanPembetulanPt3($peperiksaan, $request);
        }
        else{
            return $this->calonRepository->permohonanPembetulan($peperiksaan, $request);
        }
    }

    public function pembayaranPembetulan(Request $request, $peperiksaan){

        return $this->calonRepository->pembayaranPembetulan($peperiksaan, $request);
    }

    public function updateStatusPembetulan(Request $request, $peperiksaan){
        $this->validate($request,[
            'id'    => 'required',
        ]);

        return $this->calonRepository->updateStatusPembetulan($peperiksaan, $request);
    }
    /*
    **  ========================== End of Pembetulan ==========================
    */

    /*
    **  ========================== Pembatalan ==========================
    */
    public function permohonanPembatalan(PembatalanCalonRequest $request, $peperiksaan){

        return $this->calonRepository->permohonanPembatalan($peperiksaan, $request);
    }

    public function calonPembatalan(Request $request, $peperiksaan){

        return $this->calonRepository->calonPembatalan($peperiksaan, $request);
    }
    
    public function pengesahanPembatalan(Request $request, $peperiksaan){
        $this->validate($request,[
            'id'                      => 'required',
            'id_status_pengesahan'    => 'required',
        ]);

        return $this->calonRepository->pengesahanPembatalan($peperiksaan, $request);
    }


    public function calonPembatalanStatus(Request $request, $peperiksaan){
        
        return $this->calonRepository->calonPembatalanStatus($peperiksaan, $request);
    }

    public function senaraiCalonDibatalkan (Request $request, $peperiksaan){

        return $this->calonRepository->senaraiCalonDibatalkan($peperiksaan, $request);
    }
    /*
    **  ========================== End Of Pembatalan ==========================
    */
    public function permohonanCalon(Request $request, $peperiksaan)
    {
        return $this->calonRepository->permohonanCalon($peperiksaan, $request);
    }

    public function pengesahanCalon(PengesahanCalonRequest $request, $peperiksaan)
    {
        return $this->calonRepository->pengesahanCalon($peperiksaan, $request);
    }

    public function pengesahanPusat(Request $request, $peperiksaan)
    {
        return $this->calonRepository->pengesahanPusat($peperiksaan, $request);
    }

    public function pengesahanPusatLewat(Request $request, $peperiksaan)
    {
        return $this->calonRepository->pengesahanPusatLewat($peperiksaan, $request);
    }
    public function pengesahanCalonLewat(Request $request, $peperiksaan)
    {
        return $this->calonRepository->pengesahanCalonLewat($peperiksaan, $request);
    }

    public function statusPengesahan(Request $request, $peperiksaan)
    {
        return $this->calonRepository->statusPengesahan($peperiksaan, $request);
    }

    public function pengesahanPermohonanPindahCalon(Request $request, $peperiksaan)
    {
        return $this->calonRepository->pengesahanPermohonanPindahCalon($peperiksaan, $request);
    }

    /*
    **  ========================== SELENGGARA ==========================
    */

    public function janaNumberLP(Request $request, $peperiksaan)
    {
        return $this->calonRepository->janaNumberLP($peperiksaan, $request);
    }

    public function janaAngkaGiliran(Request $request, $peperiksaan)
    {
        return $this->calonRepository->janaAngkaGiliran($peperiksaan, $request);
    }

    /*
    **  ========================== CETAKAN ==========================
    */


    public function cetakanPendaftaran(Request $request)
    {
        return $this->calonRepository->cetakanPendaftaran($request);
    }

    public function cetakanLabelMeja(Request $request)
    {
        return $this->calonRepository->cetakanLabelMeja($request);
    }

    /*
    **  ========================== PERMOHONAN ==========================
    */

    public function permohonanPendaftaranLewat(Request $request, $peperiksaan)
    {
        return $this->calonRepository->permohonanPendaftaranLewat($peperiksaan, $request);
    }

    public function permohonanPindahCalon(Request $request, $peperiksaan)
    {
        return $this->calonRepository->permohonanPindahCalon($peperiksaan, $request);
    }

    public function senaraiPermohonanPindahCalon(Request $request, $peperiksaan)
    {
        return $this->calonRepository->senaraiPermohonanPindahCalon($peperiksaan, $request);
    }

    public function permohonanPembetulanMaklumatCalon(Request $request, $peperiksaan)
    {
        # code...
    }

    public function permohonanPembatalanPendaftaranCalon(Request $request, $peperiksaan)
    {
        # code...
    }

}
