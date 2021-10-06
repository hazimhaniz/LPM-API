<?php

namespace App\Models\Status;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusAgihan extends Model
{
    use HasFactory;

    protected $primaryKey       =   'id';
    protected $table            =   'status__status_agihan';

    protected $fillable         =   [
        'keterangan',
    ];

    protected $hidden           =   [
        'created_at',
        'updated_at',
    ];
}
