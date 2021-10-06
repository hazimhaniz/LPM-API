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
use App\Repositories\IndenRepository;
use Illuminate\Support\Facades\Log;

class IndenController extends BaseApiController
{
    private $indenRepository;

    public function __construct(IndenRepository $indenRepository)
    {
        $this->indenRepository = $indenRepository;
    }

    function pusatByDaerah(Request $request, $peperiksaan)
    {
        Log::info("--- sspat :: IndenController :: pusatByDaerah ---");
        return $this->indenRepository->pusatByDaerah($peperiksaan, $request);
    }

    function cariBilikKebal(Request $request, $peperiksaan)
    {
        return $this->indenRepository->cariBilikKebal($peperiksaan, $request);
    }

    function lapMpNeg(Request $request, $peperiksaan)
    {
        Log::info("--- Sspat :: IndenController :: lapMpNeg ---");
        return $this->indenRepository->lapMpNeg($peperiksaan, $request);
    }
    
    function negerippdsekolah(Request $request, $peperiksaan)
    {
        return $this->indenRepository->negerippdsekolah($peperiksaan, $request);
    }
 
}
