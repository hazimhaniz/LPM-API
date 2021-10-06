<?php
namespace App\Modules\Pembayaran;

use App\Models\Bayaran\BayaranPendaftaranCalon;
use App\Models\Bayaran\BayaranPendaftaranCalonSekolah;
use App\Models\Peperiksaan\Peperiksaan;
use App\Models\Peperiksaan\RefPeperiksaan\JenisBayaran;
use App\Models\Peperiksaan\RefPeperiksaan\Pusat;
use GuzzleHttp\Client;

class Main{

    protected $token;
    protected $ref;
    protected $jumlahBayaran;
    protected $client;
    protected $peperiksaan;
    protected $role;

    public function setRole($role){
        $this->role = $role;
        return $this;
    }
    
    public function setPeperiksaan(Peperiksaan $peperiksaan){
        $this->peperiksaan = $peperiksaan;
        return $this;
    }

    public function setToken(){
        if( $this->peperiksaan->id == Peperiksaan::ID_PEPERIKSAAN_PT3 ) {

            $this->token = 'elpportal608f9770b1037';
        }

        else{

            $this->token = 'elpportal608f975a16136';
        }
    
        return $this;
    }

    public function setRef(){
        if( $this->peperiksaan->id == Peperiksaan::ID_PEPERIKSAAN_PT3 ) {

            $this->ref = '990301';
        }

        else{
            
            $this->ref = '990404';
        }

        return $this;
    }

    public function checkPembayaran($user, $id_pusat = null, $ids_calons = []){
        if($this->role === 'Calon'){
            return BayaranPendaftaranCalon::where('id_user', $user->id)
                    ->where('id_tahun_peperiksaan', $this->peperiksaan->id_tahun_peperiksaan_semasa)
                    ->where('jumlah_bayaran', $this->jumlahBayaran)
                    ->first();
        }
        else if($this->role === 'SUP'){
            
            $resit_list = [];
            $queryBayaran = BayaranPendaftaranCalon::whereIn('id_calon', $ids_calons)->get();

            if($queryBayaran->isNotEmpty()){
                foreach($queryBayaran as $bayaran){
                    array_push($resit_list, $bayaran->no_resit);
                }
            }
            
            return BayaranPendaftaranCalonSekolah::where('id_user', $user->id)
                    ->where('id_pusat', $id_pusat)
                    ->where('id_tahun_peperiksaan', $this->peperiksaan->id_tahun_peperiksaan_semasa)
                    ->where('jumlah_bayaran', $this->jumlahBayaran)
                    ->when(!empty($resit_list), function ($query, $resit_list) {
                        return $query->whereNotIn('no_resit', (array)$resit_list);
                    })
                    ->first();
        }else{
            return BayaranPendaftaranCalonSekolah::where('id_user', $user->id)
                    ->where('id_pusat', $id_pusat)
                    ->where('id_tahun_peperiksaan', $this->peperiksaan->id_tahun_peperiksaan_semasa)
                    ->where('jumlah_bayaran', $this->jumlahBayaran)
                    ->first();
        }
    }

    public function setJumlahBayaran(JenisBayaran $jumlahBayaran, $user = NULL, $jumlahCalon = 1){
        if($this->role === 'Calon'){

            $this->jumlahBayaran = $jumlahBayaran->jumlah;

            // logger($user);
            // if($user != null and $user->no_janaan_lp != null){
               
            //     $this->jumlahBayaran += 200;
            //     logger($this->jumlahBayaran);
            // }

            return $this;
        }else{

            $this->jumlahBayaran = $jumlahBayaran->jumlah * $jumlahCalon ;

            // if($user != null and $user->no_janaan_lp != null){
            //     foreach ($user as $value) {
            //         if($value->no_janaan_lp){
            //             $this->jumlahBayaran += 200;
            //         }
            //     }
            // }
        
            return $this;
        }
    }

    public function setClient(){

        $this->client = new Client([
            'base_uri'          => 'https://elp-lab.moe.gov.my/eportal/api/payment/' . $this->token . '/',
            'headers'           => [
                'Content-Type'  => 'application/json',
                'Accept'        => 'application/json'
            ],
            'verify'            => false
        ]);

        return $this;
    }

    public function getPembayaran($res){
        $response = $this->client->post('apigetformrequest', [
            'json' => [
                "RefNo" => $res->no_resit
            ],
        ]);

        return json_decode($response->getBody()->getContents())->data;
    }

    public function pembayaran($pembayar){

        $response = $this->client->post('apisetformrequest', [
            'json' => [
                "NamaPenuh"             => $pembayar->nama,
                "NoKP"                  => is_null($pembayar->no_kad_pengenalan) ? $pembayar->no_janaan_lp : $pembayar->no_kad_pengenalan,
                "NoTelefon"             => $pembayar->no_telefon,
                "Email"                 => $pembayar->emel,
                "Jumlah"                => $this->jumlahBayaran,
                "JenisPeperiksaan"      => $this->ref,
            ],
        ]);

        return json_decode($response->getBody()->getContents())->data;
    }
}