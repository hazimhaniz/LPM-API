<?php

namespace App\Models\Status;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPembayaran extends Model
{
    use HasFactory;

    const ID_BAYAR              =   1;
    const ID_BELUM_BAYAR        =   2;

    protected $primaryKey       =   'id';
    protected $table            =   'status__status_pembayaran';

    protected $fillable         =   [
        'keterangan',
    ];

    protected $hidden           =   [
        'created_at',
        'updated_at',
    ];
}
