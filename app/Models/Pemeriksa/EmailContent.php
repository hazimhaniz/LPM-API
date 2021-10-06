<?php
namespace App\Models\Pemeriksa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class EmailContent extends Model
{
    //use HasFactory, SoftDeletes;
    use HasFactory;
    protected $primaryKey       =   'id';
    protected $table            =   'kru__email_content';

    protected $fillable         =   [
        'id_user',
        'id_kru',
        'id_pemeriksa',
        'tajuk_emel',
        'kandungan_emel',
        'tambahan_kandungan_emel',
        'kod_status',
        'status'
    ];

    protected $hidden           =   [
        'created_at',
        'updated_at',
    ];

}
