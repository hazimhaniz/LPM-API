<?php

namespace App\Http\Controllers\Datatable;

use App\Http\Controllers\Controller;
use App\Models\Peperiksaan\JadualKerja;
use App\Models\Peperiksaan\RefPeperiksaan\JenisCalon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class JadualKerjaController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = JadualKerja::when($request->id_tahun_peperiksaan, function($query) use ($request){
                $query->where('id_tahun_peperiksaan', $request->id_tahun_peperiksaan);
            })->get();

            return Datatables::of($data)->make(true);
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $date = JadualKerja::where('id_tahun_peperiksaan', 8)
                    ->where('keterangan','Penyelenggaraan Data')
                    ->first();

        if($date != null) {
            $rule = 'required|after:'.$date->tarikh_tamat;
        }else{
            $rule = 'required';
        }

       
        $messages = [
            'keterangan.required'                      => 'Ruangan keterangan MESTI diisi',
            'tarikh_mula.required'                     => 'Ruangan Mula MESTI diisi',
            'tarikh_tamat.required'                    => 'Ruangan Tamat MESTI diisi',
        ];

        $validator = Validator::make($request->all(), [
            'keterangan'                               => 'required',
            'tarikh_mula'                              => $rule,
            'tarikh_tamat'                             => 'required|after:tarikh_mula',
        ], $messages);



        if ($validator->fails())
        {
            return Response::json(['errors' => $validator->errors()->toArray()]);
        }

        $data = new JadualKerja;

        $data->keterangan                   = $request->keterangan;
        $data->tarikh_mula                  = $request->tarikh_mula;
        $data->tarikh_tamat                 = $request->tarikh_tamat;
        $data->id_tahun_peperiksaan        = $request->id_tahun_peperiksaan;

        $data->save();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {

        $where = array('id' => $id);
        $data  = JadualKerja::where($where)->first();

        return Response::json($data);
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'keterangan.required'                      => 'Ruangan keterangan MESTI diisi',
            'tarikh_mula.required'                     => 'Ruangan Mula MESTI diisi',
            'tarikh_tamat.required'                    => 'Ruangan Tamat MESTI diisi',
        ];

        $validator = Validator::make($request->all(), [
            'keterangan'                               => 'required',
            'tarikh_mula'                              => 'required',
            'tarikh_tamat'                             => 'required',
        ], $messages);

        if ($validator->fails())
        {
            return Response::json(['errors' => $validator->errors()->toArray()]);
        }

        $where = array('id' => $id);
        $data  = JadualKerja::where($where)->first();

        $data->keterangan                   = $request->keterangan;
        $data->tarikh_mula                  = $request->tarikh_mula;
        $data->tarikh_tamat                 = $request->tarikh_tamat;


        $data->save();

    }

    public function destroy($id)
    {
        $data = JadualKerja::where('id', $id)->delete();

        return Response::json($data);
    }
}
