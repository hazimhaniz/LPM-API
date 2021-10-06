<?php

namespace App\Models\Status;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPermohonanPertama extends Model
{
    use HasFactory;

    protected $primaryKey       =   'id';
    protected $table            =   'status__status_permohonan_pertama';

    protected $fillable         =   [
        'keterangan',
    ];

    protected $hidden           =   [
        'created_at',
        'updated_at',
    ];
}
