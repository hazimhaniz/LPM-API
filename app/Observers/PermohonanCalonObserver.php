<?php

namespace App\Observers;

use App\Models\Permohonan\PermohonanCalon as PermohonanPermohonanCalon;
use App\Models\Permohonan\PermohonanCalon;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;


class PermohonanCalonObserver
{
    /**
     * Handle the PermohonanCalon "created" event.
     *
     * @param  \App\Models\PermohonanCalon  $permohonanCalon
     * @return void
     */

    public function __construct(){

       $this->checkJpnSahLewat();

    }
    //cek if jpn x sah dalam tempoh 7 hari
    public function checkJpnSahLewat(){
        
        $lebih7Hari = [];
        $calon_id = [];

        $now = Carbon::now();
        $allCalon = PermohonanCalon::all();

        $allCalon->filter(function ($calon, $key) use(&$lebih7Hari, &$calon_id){

            Log::info($calon->id);
            array_push($calon_id, $calon->id);
            array_push($lebih7Hari, $calon->created_at->addDays(7));
        });

        (array)$combined = array_combine($calon_id, $lebih7Hari);
        Log::info($calon_id);
        Log::info($lebih7Hari);
        Log::info($combined);

        

        //collect($combined)->each(function ($item, $key) {
            dd(99);
        //     if()

            
        // });

    



        // $calonNotSahIn7Days = PermohonanCalon::where('id_status_pengesahan', '=', 0)
        //                       ->where ;


    }


    public function created(PermohonanCalon $permohonanCalon)
    {
        
    }

    /**
     * Handle the PermohonanCalon "updated" event.
     *
     * @param  \App\Models\PermohonanCalon  $permohonanCalon
     * @return void
     */
    public function updated(PermohonanCalon $permohonanCalon)
    {
        //
    }

    /**
     * Handle the PermohonanCalon "deleted" event.
     *
     * @param  \App\Models\PermohonanCalon  $permohonanCalon
     * @return void
     */
    public function deleted(PermohonanCalon $permohonanCalon)
    {
        //
    }

    /**
     * Handle the PermohonanCalon "restored" event.
     *
     * @param  \App\Models\PermohonanCalon  $permohonanCalon
     * @return void
     */
    public function restored(PermohonanCalon $permohonanCalon)
    {
        //
    }

    /**
     * Handle the PermohonanCalon "force deleted" event.
     *
     * @param  \App\Models\PermohonanCalon  $permohonanCalon
     * @return void
     */
    public function forceDeleted(PermohonanCalon $permohonanCalon)
    {
        //
    }
}
