<?php

namespace App\Http\Controllers\Datatable;

use App\Models\RefDUN;
use App\Models\RefParlimen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Constant\DUN;
use App\Models\Constant\Parlimen;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class DUNController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if($request->ajax())
        {
            $type = $request->type;
            if($type == 'get_negeri') {
                $value = $request->value;
                $where = array('id_negeri' => $value);
                $data  = Parlimen::where($where)->get();
                return Response::json($data);
            } else {
                $data = DUN::with('negeri', 'parlimen')->get();

                return Datatables::of($data)
                        ->make(true);
            }
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $messages = [
            'kod_dun.required'                  => 'Kod DUN MESTI diisi dan unik',
            'keterangan_dun.required'               => 'Ruangan nama DUN MESTI diisi',
            'select_parlimen_dun.required'          => 'Sila pilih parlimen',
            'select_negeri_dun.required'            => 'Sila pilih negeri',
        ];
        
        $validator = Validator::make($request->all(), [
            'kod_dun'                           => 'required',
            'keterangan_dun'                    => 'required',
            'select_parlimen_dun'               => 'required',
            'select_negeri_dun'                 => 'required',
        ], $messages);

        if ($validator->fails())
        {
            return Response::json(['errors' => $validator->errors()->toArray()]);
        }

        $dun = new DUN;

        $dun->kod_dun                           = $request->kod_dun;
        $dun->keterangan                        = $request->keterangan;
        $dun->kod_parlimen                      = $request->select_parlimen;
        $dun->id_negeri                         = $request->select_negeri;

        $dun->save();
    }

    public function show(Request $request, $id)
    {
        //
    }

    public function edit($id)
    {
        $where = array('id' => $id);
        $data  = DUN::with('negeri', 'parlimen')->where($where)->first();

        return Response::json($data);
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'kod_dun.required'                  => 'Kod DUN MESTI diisi dan unik',
            'keterangan_dun.required'               => 'Ruangan nama DUN MESTI diisi',
            'select_parlimen_dun.required'          => 'Sila pilih parlimen',
            'select_negeri_dun.required'            => 'Sila pilih negeri',
        ];

        $validator = Validator::make($request->all(), [
            'kod_dun'                           => 'required',
            'keterangan_dun'                    => 'required',
            'select_parlimen_dun'               => 'required',
            'select_negeri_dun'                 => 'required',
        ], $messages);

        if ($validator->fails())
        {
            return Response::json(['errors' => $validator->errors()->toArray()]);
        }

        $where = array('id' => $id);
        $dun  = DUN::where($where)->first();

        $dun->kod_dun                           = $request->kod_dun;
        $dun->keterangan                        = $request->keterangan;
        $dun->kod_parlimen                      = $request->select_parlimen;
        $dun->id_negeri                         = $request->select_negeri;

        $dun->save();
    }

    public function destroy($id)
    {
        $data = DUN::where('id', $id)->delete();

        return Response::json($data);
    }
}
