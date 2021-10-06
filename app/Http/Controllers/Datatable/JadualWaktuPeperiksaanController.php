<?php

namespace App\Http\Controllers\Datatable;

use App\Http\Controllers\Controller;
use App\Models\Peperiksaan\JadualPeperiksaan;
use App\Models\Peperiksaan\RefPeperiksaan\MataPelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class JadualWaktuPeperiksaanController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = JadualPeperiksaan::with('mataPelajaran')
                ->when($request->id_tahun_peperiksaan, function($query) use ($request){
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

        $messages = [
            'tempoh_masa.required'                     => 'Ruangan tempoh masa MESTI diisi',
            'tarikh_mula.required'                     => 'Ruangan Mula MESTI diisi',
            'tarikh_tamat.required'                    => 'Ruangan Tamat MESTI diisi',
        ];

        $validator = Validator::make($request->all(), [
            'tempoh_masa'                              => 'required',
            'tarikh_mula'                              => 'required',
            'tarikh_tamat'                             => 'required',
        ], $messages);



        if ($validator->fails())
        {
            return Response::json(['errors' => $validator->errors()->toArray()]);
        }

        $data = new JadualPeperiksaan;

        $data->tempoh_masa                  = $request->tempoh_masa;
        $data->tarikh_mula                  = $request->tarikh_mula;
        $data->tarikh_tamat                 = $request->tarikh_tamat;
        $data->id_tahun_peperiksaan         = $request->id_tahun_peperiksaan;

        $data->save();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {

        $where = array('id' => $id);
        $data  = JadualPeperiksaan::where($where)->first();

        return Response::json($data);
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'tempoh_masa.required'                     => 'Ruangan tempoh masa MESTI diisi',
            'tarikh_mula.required'                     => 'Ruangan Mula MESTI diisi',
            'tarikh_tamat.required'                    => 'Ruangan Tamat MESTI diisi',
        ];

        $validator = Validator::make($request->all(), [
            'tempoh_masa'                              => 'required',
            'tarikh_mula'                              => 'required',
            'tarikh_tamat'                             => 'required',
        ], $messages);

        if ($validator->fails())
        {
            return Response::json(['errors' => $validator->errors()->toArray()]);
        }

        $where = array('id' => $id);
        $data  = JadualPeperiksaan::where($where)->first();

        $data->tempoh_masa                  = $request->tempoh_masa;
        $data->tarikh_mula                  = $request->tarikh_mula;
        $data->tarikh_tamat                 = $request->tarikh_tamat;

        $data->save();

    }

    public function destroy($id)
    {
        $data = JadualPeperiksaan::where('id', $id)->delete();

        return Response::json($data);
    }

    public function getListMatapelajaran(){

        return Response::json(MataPelajaran::where('status', 1)->get());
    }
}
