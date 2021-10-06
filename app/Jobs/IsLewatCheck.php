<?php

namespace App\Jobs;

use App\Models\Peperiksaan\JadualKerja;
use App\Models\Peperiksaan\RefPeperiksaan\Pusat;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class IsLewatCheck implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {   Log::info('IsLewatCheck');
        $calonSekolah = JadualKerja::find(2);
        $calonPersendirian = JadualKerja::find(3);

        $this->calonSekolahLewat($calonSekolah);
        $this->calonPersendirianLewat($calonPersendirian);
    }

    /**
     * Handle for calon sekolah lewat
     */
    public function calonSekolahLewat($due){
        if (!Carbon::now()->between($due['tarikh_mula'], $due['tarikh_tamat'])) {
            $listPusat = Pusat::where('id_jenis_calon', '!=' , 13)
                    ->where('id_tahun_peperiksaan',8)
                    ->get();

            foreach ($listPusat as $pusat) {
                $pusat->updateOrCreate([
                    'id' => $pusat->id
                ],[
                    'id_status_tempoh_pendaftaran' => 2
                ]);
            }
        }

        $listPusat = Pusat::where('id_jenis_calon', '!=' , 13)
                    ->where('id_tahun_peperiksaan',8)
                    ->get();

        foreach ($listPusat as $pusat) {
            $pusat->updateOrCreate([
                'id' => $pusat->id
            ],[
                'id_status_tempoh_pendaftaran' => 1
            ]);
        }
    }

    /**
     * Handle for calon persendirian lewat
     */
    public function calonPersendirianLewat($due){
        if (!Carbon::now()->between($due['tarikh_mula'], $due['tarikh_tamat'])) {
            $listPusat = Pusat::where('id_jenis_calon', 13)
                    ->where('id_tahun_peperiksaan',8)
                    ->get();
            
            foreach ($listPusat as $pusat) {
                $pusat->updateOrCreate([
                    'id' => $pusat->id
                ],[
                    'id_status_tempoh_pendaftaran' => 2
                ]);
            }
        }
    }
}
