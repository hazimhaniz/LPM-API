<?php

namespace App\Observers;

use App\Models\Kru\Kru;
use App\Models\Kru\KruAlamat;

class KruObserver
{
    /**
     * Handle the Kru "created" event.
     *
     * @param  \App\Models\Kru\Kru  $kru
     * @return void
     */
    public function created(Kru $kru)
    {
        //
    }

    /**
     * Handle the Kru "updated" event.
     *
     * @param  \App\Models\Kru\Kru  $kru
     * @return void
     */
    public function updated(Kru $kru)
    {
        //
    }

    /**
     * Handle the Kru "deleted" event.
     *
     * @param  \App\Models\Kru\Kru  $kru
     * @return void
     */
    public function deleted(Kru $kru)
    {
        $kruAlamat = KruAlamat::where('id_kru', $kru->id)->first();
        
        if($kruAlamat){
            $kruAlamat->delete();
        }
    }

    /**
     * Handle the Kru "restored" event.
     *
     * @param  \App\Models\Kru\Kru  $kru
     * @return void
     */
    public function restored(Kru $kru)
    {
        //
    }

    /**
     * Handle the Kru "force deleted" event.
     *
     * @param  \App\Models\Kru\Kru  $kru
     * @return void
     */
    public function forceDeleted(Kru $kru)
    {
        //
    }
}
