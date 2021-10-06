<?php

namespace App\Modules\Pusat;

use Illuminate\Support\Facades\DB;
use App\Models\Peperiksaan\Peperiksaan;
use App\Models\Pusat\PermohonanPusatLewat;
use App\Models\Peperiksaan\RefPeperiksaan\Pusat;

class Main {

    protected $pusat;
    protected $peperiksaan;

    /**
     * Set Peperiksaan
     * @param $peperiksaan = peperiksaan_id
     * @return instance of model peperiksaan
     */
    public function setPeperiksaan(Peperiksaan $peperiksaan){
        $this->peperiksaan = $peperiksaan;
        return $this;
    }

    /**
     * Set Pusat
     * @param $pusat = id pusat
     * @return isntance of model PermohonanPusat
     */
    public function setPusat(Pusat $pusat){
        $this->pusat = $pusat;
        return $this;
    }

    /**
     * Handle update status
     * 
     * @param $request = id_status
     * @return instance of model PermohonanPusat
     */
    public function updateStatus(){

        try {
            return DB::transaction(function () {

                $pusatLewat = PermohonanPusatLewat::updateOrCreate([
                    'id_pusat'          => $this->pusat->id,
                    'id_peperiksaan'    => $this->peperiksaan->id,
                ],[   
                    'status'            => false
                ]);

                return $pusatLewat->fresh();

            });

        } catch (\Throwable $th) {
            DB::rollBack();
            return $th;
        }
        
    }
}