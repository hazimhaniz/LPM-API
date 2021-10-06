<?php

namespace App\Http\Controllers\Api;

use App\Repositories\PemeriksaRepository;
use App\Http\Requests\Pemeriksa\PermohonanPemeriksaRequest;
use App\Http\Requests\Pemeriksa\BorangPemeriksaRequest;
use Illuminate\Http\Request;

class PemeriksaController extends BaseApiController
{
    private $pemeriksaRepository;

    public function __construct(PemeriksaRepository $pemeriksaRepository)
    {
        $this->pemeriksaRepository = $pemeriksaRepository;
    }

    /*
    **  ========================== PEMERIKSA ==========================
    */

    // permohonan pemeriksa 
    public function permohonanPemeriksa(PermohonanPemeriksaRequest $request, $pemeriksa)
    {
        return $this->pemeriksaRepository->permohonanPemeriksa($pemeriksa, $request);
    }
    // senarai pemeriksa
    public function senaraiPermohonanPemeriksa(Request $request, $pemeriksa)
    {
        return $this->pemeriksaRepository->senaraiPermohonanPemeriksa($pemeriksa, $request);
    }
    // kemaskini pemeriksa
    public function kemaskiniPermohonanPemeriksa(PermohonanPemeriksaRequest $request, $pemeriksa)
    {
        return $this->pemeriksaRepository->kemaskiniPermohonanPemeriksa($pemeriksa, $request);
    }
    // borang jawapan 
    public function borangJawapan(BorangPemeriksaRequest $request, $borang)
    {
        return $this->pemeriksaRepository->borangJawapan($borang, $request);
    }
    // senarai borang jawapan
    public function senaraiBorangJawapan(Request $request, $borang)
    {
        return $this->pemeriksaRepository->senaraiBorangJawapan($borang, $request);
    }
    // kemaskini borang jawapan
    public function kemaskiniBorangJawapan(BorangPemeriksaRequest $request, $borang)
    {
        return $this->pemeriksaRepository->kemaskiniBorangJawapan($borang, $request);
    }
    public function pemeriksaRekod(Request $request, $borang)
    {
        return $this->pemeriksaRepository->pemeriksaRekod($borang, $request);
    }
    public function statusPengesahanRekod(Request $request, $pemeriksa)
    {
        return $this->pemeriksaRepository->statusPengesahanRekod($pemeriksa, $request);
    }
    public function statusKelulusanRekod(Request $request, $pemeriksa)
    {
        return $this->pemeriksaRepository->statusKelulusanRekod($pemeriksa, $request);
    }
    public function statusJanaanRekod(Request $request, $pemeriksa)
    {
        return $this->pemeriksaRepository->statusJanaanRekod($pemeriksa, $request);
    }


}
