<?php

namespace App\Http\Controllers\Datatable;

use App\Http\Controllers\Controller;
use App\Models\Constant\Jantina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class JenisJantinaController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {

            $data = Jantina::get();

            return Datatables::of($data)
                    ->make(true);
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $messages = [
            'kod_jantina.required'                  => 'Kod Kemasukan MESTI diisi dan unik',
            'keterangan.required'                    => 'Ruangan Diskripsi MESTI diisi',
        ];

        $validator = Validator::make($request->all(),
        [
            'kod_jantina'                           => 'required|numeric',
            'keterangan'                             => 'required',

        ], $messages);

        if ($validator->fails())
        {
            return Response::json(['errors' => $validator->errors()->toArray()]);
        }

        $data = new Jantina();

        $data->kod_jantina                        = $request->kod_jantina;
        $data->keterangan                          = $request->keterangan;

        $data->save();

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $where = array('id' => $id);
        $data  = Jantina::where($where)->first();

        return Response::json($data);
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'kod_jantina.required'                      => 'Kod Kecacatan MESTI diisi dan unik',
            'keterangan.required'                       => 'Ruangan Diskripsi MESTI diisi',
        ];

        $validator = Validator::make($request->all(),
        [
            'kod_jantina'                               => 'required|numeric',
            'keterangan'                                => 'required',

        ], $messages);

        if ($validator->fails())
        {
            return Response::json(['errors' => $validator->errors()->toArray()]);
        }

        $where = array('id' => $id);
        $data  = Jantina::where($where)->first();

        $data->kod_jantina                              = $request->kod_jantina;
        $data->keterangan                               = $request->keterangan;

        $data->save();

    }

    public function destroy($id)
    {
        $data = Jantina::where('id', $id)->delete();

        return Response::json($data);
    }
}
