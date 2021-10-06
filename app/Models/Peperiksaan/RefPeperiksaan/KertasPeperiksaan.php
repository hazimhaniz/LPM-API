<?php

namespace App\Models\Peperiksaan\RefPeperiksaan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KertasPeperiksaan extends Model
{
    use HasFactory;

    protected $table = 'ref_kertas_peperiksaan';
    protected $guarded = ['id', 'created_at', 'updated_at'];

}
