<?php

namespace App\Http\Controllers\Datatable;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Constant\Agama;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class AgamaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = Agama::get();

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
            'kod_agama.required'                => 'Kod Agama MESTI diisi dan unik',
            'keterangan_agama.required'         => 'Ruangan keterangan MESTI diisi',
        ];
        $validator = Validator::make($request->all(), [
            'kod_agama'                         => 'required',
            'keterangan_agama'                  => 'required',
        ], $messages);

        if ($validator->fails())
        {
            return Response::json(['errors'     => $validator->errors()->toArray()]);
        }

        $dun = new Agama;

        $dun->kod_agama                         = $request->kod_agama;
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
        $data  = Agama::where($where)->first();

        return Response::json($data);
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'kod_agama.required'                => 'Kod Agama MESTI diisi dan unik',
            'keterangan_agama.required'         => 'Ruangan keterangan MESTI diisi',
        ];

        $validator = Validator::make($request->all(), [

            'kod_agama'                         => 'required',
            'keterangan_agama'                  => 'required',
            
        ], $messages);

        if ($validator->fails())
        {
            return Response::json(['errors' => $validator->errors()->toArray()]);
        }

        $where = array('id' => $id);
        $dun  = Agama::where($where)->first();

        $dun->kod_agama                         = $request->kod_agama;
        $dun->keterangan                        = $request->keterangan;

        $dun->save();

    }

    public function destroy($id)
    {
        $data = Agama::where('id', $id)->delete();

        return Response::json($data);
    }
}
