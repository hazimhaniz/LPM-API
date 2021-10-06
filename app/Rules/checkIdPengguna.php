<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class checkIdPengguna implements Rule
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
        return User::where('id_peperiksaan', $this->request['id_peperiksaan'])
        ->where('id_pengguna', $value)
        ->where('id', '!=' , $this->id)
        ->first() == null;
    }

    public function message()
    {
        return 'ID Pengguna ini sudah wujud';
    }
}
