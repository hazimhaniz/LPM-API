<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Notifications\SendJpnSahLateNoti;
use App\Models\Permohonan\PermohonanCalon;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class IsJpnSahLate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public function __construct()
    { }

    /**
     * Handle the event.
     *
     * @param  SendJpnSahLateEvent  $event
     * @return void
     */
    
    public function handle()
    {   \Log::info("message_listener_xxx_jobs");

    try{

        $lebih7Hari = [];
        $calon_id = [];

        $now = Carbon::now();
        $allCalon = Permohonancalon::with('calon')->get();

        $allCalon->filter(function ($calon, $key) use(&$lebih7Hari, &$calon_id){
            array_push($calon_id, $calon->id);
            array_push($lebih7Hari, $calon->created_at->addDays(7));
        });

        (array)$combined = array_combine($calon_id, $lebih7Hari);

        $calonSahLewat = collect();
        collect($combined)->filter(function ($date, $id_calon) use($now, &$calonSahLewat){

            if($now > $date){
                $calon = Permohonancalon::with('calon')->whereIn('id_status_pengesahan',[0,99])
                ->where('id_calon', $id_calon)
                ->get();
                if($calon->isNotempty()){
                    $calonSahLewat->push($calon);
                }
            }
        });
        //noti utk umpk saja
        $user = new User;
        $role = $user->role('umpk')
        ->where('id_peperiksaan', 1)
        ->get();

        $calonSahLewat->each(function ($calon, $key) use ($role){
            \Log::info(DB::table('notifications')->all());
            Notification::send($role, new SendJpnSahLateNoti($calon));

        });

    }catch(\Exception $e){
        \Log::info($e->getMessage());
    }

        
    }
}
