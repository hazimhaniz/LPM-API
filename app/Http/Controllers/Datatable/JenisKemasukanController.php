<?php

namespace App\Http\Controllers\Datatable;

use App\Http\Controllers\Controller;
use App\Models\Peperiksaan\RefPeperiksaan\JenisKemasukan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class JenisKemasukanController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {

            $data = JenisKemasukan::with('peperiksaan')->when($request->id_peperiksaan, function($query) use ($request){
                $query->where('id_peperiksaan', $request->id_peperiksaan);
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
            'kod_kemasukan.required'                  => 'Kod Kemasukan MESTI diisi dan unik',
            'keterangan.required'                     => 'Ruangan keterangan MESTI diisi',
        ];

        $validator = Validator::make($request->all(),
        [
            'kod_kemasukan'                           => 'required',
            'keterangan'                              => 'required',

        ], $messages);

        if ($validator->fails())
        {
            return Response::json(['errors' => $validator->errors()->toArray()]);
        }

        $data = new JenisKemasukan();

        $data->kod_kemasukan                      = $request->kod_kemasukan;
        $data->id_peperiksaan                     = $request->id_peperiksaan;
        $data->keterangan                         = $request->keterangan;

        $data->save();

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $where = array('id' => $id);
        $data  = JenisKemasukan::with('peperiksaan')->where($where)->first();

        return Response::json($data);
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'kod_kemasukan.required'                  => 'Kod Kemasukan MESTI diisi dan unik',
            'keterangan.required'                     => 'Ruangan keterangan MESTI diisi',
        ];

        $validator = Validator::make($request->all(),
        [
            'kod_kemasukan'                           => 'required',
            'keterangan'                              => 'required',

        ], $messages);

        if ($validator->fails())
        {
            return Response::json(['errors' => $validator->errors()->toArray()]);
        }

        $where = array('id' => $id);
        $data  = JenisKemasukan::where($where)->first();

        $data->kod_kemasukan                      = $request->kod_kemasukan;
        $data->id_peperiksaan                     = $request->id_peperiksaan;
        $data->keterangan                         = $request->keterangan;

        $data->save();
    }

    public function destroy($id)
    {
        $data = JenisKemasukan::where('id', $id)->delete();

        return Response::json($data);
    }
}
