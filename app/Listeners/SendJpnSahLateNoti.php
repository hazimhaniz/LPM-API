<?php

namespace App\Listeners;

use App\Events\SendJpnSahLateEvent;
use App\Models\Pemeriksa\Permohonan;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Permohonan\PermohonanCalon;
use App\Models\User;
use App\Notifications\SendJpnSahLateNoti as calonLewatNoti;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SendJpnSahLateNoti implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    
    use InteractsWithQueue;

    public $afterCommit = true;
    private $user;

    public function __construct(User $user)
    { 

        $this->user = $user;
        
    }

    /**
     * Handle the event.
     *
     * @param  SendJpnSahLateEvent  $event
     * @return void
     */

    public function handle(SendJpnSahLateEvent $event)
    {   \Log::info("message_listener_xxxssss");
        \Log::info (DB::table('notifications')->get());

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
        $role = $this->user->role('umpk')
        ->where('id_peperiksaan', $event->getpeperiksaan())
        ->get();

        $calonSahLewat->each(function ($calon, $key) use ($role){
            //DB::table('notifications')->where
            \Log::info (DB::table('notifications')->all());
            Notification::send($role, new calonLewatNoti($calon));

        });

    }catch(\Exception $e){
        \Log::info($e->getMessage());
    }

        
    }

}
