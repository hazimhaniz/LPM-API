<?php

namespace App\Models\Kru;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KruAlamat extends Model
{
    use HasFactory, SoftDeletes;


    protected $primaryKey       =   'id';
    protected $table            =   'kru__alamat';

    protected $guarded         =   ['id', 'created_at', 'updated_at', 'deleted_at'];

    protected $hidden           =   [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
