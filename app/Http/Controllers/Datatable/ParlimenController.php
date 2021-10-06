<?php

namespace App\Http\Controllers\Datatable;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Constant\Parlimen;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class ParlimenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if($request->ajax())
        {

            $data = Parlimen::with('negeri')->get();

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
            'kod_parlimen.required'         => 'Kod parlimen MESTI diisi dan unik',
            'keterangan_parlimen.required'  => 'Ruangan nama parlimen MESTI diisi',
            'select_negeri.required'        => 'Sila pilih negeri',
            'select_ppd.required'           => 'Sila pilih daerah'
        ];

        $validator = Validator::make($request->all(), [
            'kod_parlimen'                  => 'required',
            'keterangan_parlimen'           => 'required',
            'select_negeri'                 => 'required',
            'select_ppd'                    => 'required'
        ], $messages);

        if ($validator->fails())
        {
            return Response::json(['errors' => $validator->errors()->toArray()]);
        }

        $parlimen = new Parlimen;

        $parlimen->kod_parlimen              = $request->kod_parlimen;
        $parlimen->keterangan                = $request->keterangan;
        $parlimen->id_negeri                 = $request->select_negeri;
        $parlimen->id_kod_ppd                = $request->kod_ppd;

        $parlimen->save();

    }

    public function show(Request $request)
    {
        //
    }

    public function edit($id)
    {
        $where = array('id' => $id);
        $data  = Parlimen::where($where)->first();

        return Response::json($data);
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'kod_parlimen.required'         => 'Kod parlimen MESTI diisi dan unik',
            'keterangan_parlimen.required'           => 'Ruangan nama parlimen MESTI diisi',
            'select_negeri.required'        => 'Sila pilih negeri',
            'select_ppd.required'           => 'Sila pilih daerah'
        ];
        
        $validator = Validator::make($request->all(), [
            'kod_parlimen'                  => 'required',
            'keterangan_parlimen'           => 'required',
            'select_negeri'                 => 'required',
            'select_ppd'                    => 'required'
        ], $messages);

        if ($validator->fails())
        {
            return Response::json(['errors' => $validator->errors()->toArray()]);
        }

        $where = array('id' => $id);
        $parlimen  = Parlimen::where($where)->first();

        $parlimen->kod_parlimen                  = $request->kod_parlimen;
        $parlimen->keterangan                    = $request->keterangan;
        $parlimen->id_negeri                    = $request->select_negeri;

        $parlimen->save();
    }

    public function destroy(Request $request, $id)
    {
        $data = Parlimen::where('id', $id)->delete();

        return Response::json($data);
    }
}
