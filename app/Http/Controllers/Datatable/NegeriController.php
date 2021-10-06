<?php

namespace App\Http\Controllers\Datatable;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Constant\Negeri;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class NegeriController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = Negeri::get();

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
            'kod_negeri.required'                => 'Kod Negeri MESTI diisi dan unik',
            'keterangan_negeri.required'         => 'Ruangan nama Negeri MESTI diisi',
        ];

        $validator = Validator::make($request->all(), [
            'kod_negeri'                         => 'required',
            'keterangan_negeri'                  => 'required',
        ], $messages);

        if ($validator->fails())
        {
            return Response::json(['errors'     => $validator->errors()->toArray()]);
        }

        $dun = new Negeri;

        $dun->kod_negeri                         = $request->kod_negeri;
        $dun->keterangan                        = $request->keterangan;

        $dun->save();
    }

    public function show(Request $request, $id)
    {
        //
    }

    public function edit($id)
    {
        $where = array('id' => $id);
        $data  = Negeri::where($where)->first();

        return Response::json($data);
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'kod_negeri.required'                => 'Kod Negeri MESTI diisi dan unik',
            'keterangan_negeri.required'         => 'Ruangan nama Negeri MESTI diisi',
        ];

        $validator = Validator::make($request->all(), [
            'kod_negeri'                         => 'required',
            'keterangan_negeri'                  => 'required',
        ], $messages);

        if ($validator->fails())
        {
            return Response::json(['errors'     => $validator->errors()->toArray()]);
        }

        $where = array('id' => $id);
        $dun  = Negeri::where($where)->first();

        $dun->kod_negeri                         = $request->kod_negeri;
        $dun->keterangan                         = $request->keterangan;

        $dun->save();
    }

    public function destroy($id)
    {
        $data = Negeri::where('id', $id)->delete();

        return Response::json($data);
    }
}
