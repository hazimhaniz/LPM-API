<?php

namespace App\Models\Constant;

use App\Models\Calon\Calon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Negara extends Model
{
    use HasFactory;

    protected $table = "ref_negara";

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function calon(){
        return $this->belongsToMany(Calon::class, 'id', 'id_negara');
    }
}
