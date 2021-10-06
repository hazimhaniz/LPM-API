<?php

namespace App\Http\Controllers\Datatable;

use App\Http\Controllers\Controller;
use App\Models\Calon\CalonKeperluanKhas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class JenisKeperluanKhasController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = CalonKeperluanKhas::get();

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
            'kod_kecacatan.required'                  => 'Kod Kemasukan MESTI diisi dan unik',
            'keterangan.required'                      => 'Ruangan Diskripsi MESTI diisi',
        ];

        $validator = Validator::make($request->all(),
        [
            'kod_kecacatan'                           => 'required',
            'keterangan'                               => 'required',

        ], $messages);

        if ($validator->fails())
        {
            return Response::json(['errors' => $validator->errors()->toArray()]);
        }

        $data = new CalonKeperluanKhas();

        $data->kod_kecacatan                      = $request->kod_kecacatan;
        $data->keterangan                          = $request->keterangan;

        $data->save();

        return redirect()->route('console.selenggara-data');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $where = array('id' => $id);
        $data  = CalonKeperluanKhas::where($where)->first();

        return Response::json($data);
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'kod_kecacatan.required'                  => 'Kod Kecacatan MESTI diisi dan unik',
            'keterangan.required'                      => 'Ruangan Diskripsi MESTI diisi',
        ];

        $validator = Validator::make($request->all(),
        [
            'kod_kecacatan'                           => 'required',
            'keterangan'                               => 'required',

        ], $messages);

        if ($validator->fails())
        {
            return Response::json(['errors' => $validator->errors()->toArray()]);
        }

        $where = array('id' => $id);
        $data  = CalonKeperluanKhas::where($where)->first();

        $data->kod_kecacatan                      = $request->kod_kecacatan;
        $data->keterangan                          = $request->keterangan;

        $data->save();

        return redirect()->route('console.selenggara-data');
    }

    public function destroy($id)
    {
        $data = CalonKeperluanKhas::where('id', $id)->delete();

        return Response::json($data);
    }
}
