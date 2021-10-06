<?php

namespace App\Exports;

use App\Models\Calon\Calon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class calonBatalExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Calon::onlyTrashed()->get();
    }


    public function view() : View
    {
        return view('excel.cetakanBatalCalon', [
            'calonDibatalkan' => Calon::onlyTrashed()->get()
        ]);
    }
}
