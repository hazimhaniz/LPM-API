<?php

namespace App\Http\Controllers\Datatable;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Constant\Daerah;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class DaerahController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if($request->ajax())
        {

            $data = Daerah::with('negeri')->get();

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
            'kod_daerah.required'       => 'Kod daerah MESTI diisi dan unik',
            'keterangan.required'       => 'Ruangan keterangan MESTI diisi',
            'select_negeri.required'    => 'Sila pilih negeri',
        ];
        $validator = Validator::make($request->all(), [
            'kod_daerah'                => 'required',
            'keterangan'                => 'required',
            'select_negeri'             => 'required',
        ], $messages);

        if ($validator->fails())
        {
            return Response::json(['errors' => $validator->errors()->toArray()]);
        }

        $daerah = new Daerah;

        $daerah->kod_daerah              = $request->kod_daerah;
        $daerah->keterangan              = $request->keterangan;
        $daerah->id_negeri               = $request->select_negeri;

        $daerah->save();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $where = array('id' => $id);
        $data  = Daerah::where($where)->first();

        return Response::json($data);
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'kod_daerah.required'       => 'Kod daerah MESTI diisi dan unik',
            'keterangan.required'       => 'Ruangan keterangan MESTI diisi',
            'select_negeri.required'    => 'Sila pilih negeri',
        ];
        $validator = Validator::make($request->all(), [
            'kod_daerah'                => 'required',
            'keterangan'                => 'required',
            'select_negeri'             => 'required',
        ], $messages);

        if ($validator->fails())
        {
            return Response::json(['errors' => $validator->errors()->toArray()]);
        }

        $where = array('id' => $id);
        $daerah  = Daerah::where($where)->first();

        $daerah->kod_daerah              = $request->kod_daerah;
        $daerah->keterangan              = $request->keterangan;
        $daerah->id_negeri               = $request->select_negeri;

        $daerah->save();
    }

    public function destroy($id)
    {
        $data = Daerah::where('id', $id)->delete();

        return Response::json($data);
    }
}
