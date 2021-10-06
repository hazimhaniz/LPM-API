<?php

namespace App\Http\Controllers\Datatable;

use App\Http\Controllers\Controller;
use App\Models\Peperiksaan\Peperiksaan;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class JenisPeperiksaanController extends Controller
{

    public function index(Request $request)
    {
        if($request->ajax())
        {

            $data = Peperiksaan::get();

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
            'kod_peperiksaan.required'          => 'Kod Peperiksaan MESTI diisi dan unik',
            'keterangan.required'               => 'Ruangan nama peperiksaan MESTI diisi',
            'keterangan_panjang.required'       => 'Ruangan keterangan peperiksaan MESTI diisi',
        ];

        $validator = Validator::make($request->all(), [
            'kod_peperiksaan'                   => 'required',
            'keterangan'                        => 'required',
            'keterangan_panjang'                => 'required',
        ], $messages);

        if ($validator->fails())
        {
            return Response::json(['errors'     => $validator->errors()->toArray()]);
        }

        $daerah = new Peperiksaan();

        $daerah->kod_peperiksaan                = $request->kod_peperiksaan;
        $daerah->keterangan                     = $request->keterangan;
        $daerah->keterangan_panjang             = $request->keterangan_panjang;

        $daerah->save();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $where = array('id' => $id);
        $data  = Peperiksaan::where($where)->first();

        return Response::json($data);
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'kod_peperiksaan.required'          => 'Kod Peperiksaan MESTI diisi dan unik',
            'keterangan.required'               => 'Ruangan nama peperiksaan MESTI diisi',
            'keterangan_panjang.required'       => 'Ruangan keterangan peperiksaan MESTI diisi',
        ];

        $validator = Validator::make($request->all(), [
            'kod_peperiksaan'                   => 'required',
            'keterangan'                        => 'required',
            'keterangan_panjang'                => 'required',
        ], $messages);

        if ($validator->fails())
        {
            return Response::json(['errors'     => $validator->errors()->toArray()]);
        }

        $where = array('id' => $id);
        $daerah  = Peperiksaan::where($where)->first();

        $daerah->kod_peperiksaan                = $request->kod_peperiksaan;
        $daerah->keterangan                     = $request->keterangan;
        $daerah->keterangan_panjang             = $request->keterangan_panjang;

        $daerah->save();
    }

    public function destroy($id)
    {
        $data = Peperiksaan::where('id', $id)->delete();

        return Response::json($data);
    }
}
