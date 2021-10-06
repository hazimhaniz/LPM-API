<?php

namespace App\Models\Calon;

use App\Models\Permohonan\PermohonanCalon;
use App\Models\Status\StatusPengesahan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class CalonPembatalanPendaftaran extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    use HasFactory;

    protected $primaryKey       =   'id';
    protected $table            =   'calon__pembatalan_pendaftaran';

    protected $guarded         =   ['id','created_at','updated_at'];

    public function calon(){
        
        return $this->hasOne(Calon::class, 'id', 'id_calon');
    }

    public function alamat(){

        return $this->hasOne(CalonAlamat::class, 'id_calon', 'id');
    }


    public function permohonan(){

        return $this->hasOne(PermohonanCalon::class, 'id_calon', 'id');
    }

    public function statusPengesahan(){

        return $this->hasOne(StatusPengesahan::class, 'id', 'id_status_pengesahan');
    }

}
