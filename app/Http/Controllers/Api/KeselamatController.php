<?php

namespace App\Http\Controllers\Api;

use App\Repositories\KeselamatanRepository;
use Illuminate\Http\Request;

class KeselamatController extends BaseApiController
{
    private $keselamatanRepository;

    public function __construct(KeselamatanRepository $keselamatanRepository)
    {
        $this->keselamatanRepository = $keselamatanRepository;
    }

    public function logMasuk(Request $request, $peperiksaan)
    {
        return $this->keselamatanRepository->logMasuk($peperiksaan, $request);
    }

    public function logKeluar(Request $request, $peperiksaan)
    {
        return $this->keselamatanRepository->logKeluar($peperiksaan, $request);
    }
}
