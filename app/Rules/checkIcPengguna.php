<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class checkIcPengguna implements Rule
{

    private $id;
    private $request;

    public function __construct($request, $id)
    {
        $this->request = $request;
        $this->id      = $id;
    }

    public function passes($attribute, $value)
    {

        $request = $this->request;

        return User::where('id_peperiksaan', $request['id_peperiksaan'])
        ->where('id', '!=' , $this->id)
        ->whereHas('kru', function($query) use ($request){
            $query->where('no_kad_pengenalan', $request['ic']);
        })
        ->first() == null;
    }

    public function message()
    {
        return 'IC Pengguna ini sudah wujud';
    }
}
