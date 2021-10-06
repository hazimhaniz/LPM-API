<?php

namespace App\Models\Peperiksaan;

use App\Models\Peperiksaan\RefPeperiksaan\MataPelajaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;

class JadualPeperiksaan extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    use HasFactory, SoftDeletes;


    protected $primaryKey       =   'id';
    protected $table            =   'peperiksaan__jadual_peperiksaan';

    protected $fillable         =   [
        'id_peperiksaan',
        'id_tahun_peperiksaan',
        'tarikh_mula',
        'tarikh_tamat',
        'status'
    ];

    protected $hidden           =   [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function mataPelajaran(){
        return $this->belongsTo(MataPelajaran::class, 'id', 'id_mata_pelajaran');
    }
}
