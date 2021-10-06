<?php

namespace App\Models\Peperiksaan;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Wajaran extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    use HasFactory, SoftDeletes;

    protected $primaryKey = 'id';
    protected $table = 'wajaran_kertas_peperiksaan';

    protected $guarded = 
                        [
                            'id', 
                            'created_at', 
                            'updated_at'
                        ];

    protected $hidden = 
                        [
                            'created_at',
                            'updated_at',
                            'deleted_at',
                        ];

    public function peperiksaan()
    {
        return $this->belongsTo(Peperiksaan::class);
    }

    public function tahunPeperiksaan()
    {
        return $this->belongsTo(TahunPeperiksaan::class);
    }

    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class);
    }

    public function kertasPeperiksaan()
    {
        return $this->belongsTo(KertasPeperiksaan::class);
    }

    public function jadualPeperiksaan()
    {
        return $this->belongsTo(JadualPeperiksaan::class);
    }
}
