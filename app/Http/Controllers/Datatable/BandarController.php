<?php

namespace App\Http\Controllers\Datatable;
;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Constant\Bandar;
use App\Models\Constant\Daerah;
use Yajra\DataTables\DataTables;

class BandarController extends Controller
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
                $data  = Daerah::where($where)->get();

                return Response::json($data);

            } 

            if($type == 'get_bandar'){
                $bandar = Bandar::where('id_negeri', $request->value)->get();

                return Response::json($bandar);
            }

            $data = Bandar::with('negeri', 'daerah')->get();

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
            'keterangan_bandar.required'    => 'Ruangan nama bandar / kawasan MESTI diisi',
            'select_daerah_bandar.required' => 'Sila pilih daerah',
            'select_negeri_bandar.required' => 'Sila pilih negeri',
        ];

        $validator = Validator::make($request->all(), [
            'keterangan_bandar'             => 'required',
            'select_daerah_bandar'          => 'required',
            'select_negeri_bandar'          => 'required',
        ], $messages);

        if ($validator->fails())
        {
            return Response::json(['errors' => $validator->errors()->toArray()]);
        }

        $bandar = new Bandar();

        $bandar->keterangan = $request->keterangan;
        $bandar->kod_daerah = $request->select_daerah;
        $bandar->id_negeri  = $request->select_negeri;

        $bandar->save();
    }

    public function show(Request $request, $id)
    {
        //
    }

    public function edit($id)
    {
        $where = array('id' => $id);
        $data  = Bandar::with('negeri', 'daerah')->where($where)->first();

        return Response::json($data);
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'keterangan_bandar.required'    => 'Ruangan nama bandar / kawasan MESTI diisi',
            'select_daerah_bandar.required' => 'Sila pilih daerah',
            'select_negeri_bandar.required' => 'Sila pilih negeri',
        ];

        $validator = Validator::make($request->all(), [
            'keterangan_bandar'             => 'required',
            'select_daerah_bandar'          => 'required',
            'select_negeri_bandar'          => 'required',
        ], $messages);

        if ($validator->fails())
        {
            return Response::json(['errors' => $validator->errors()->toArray()]);
        }

        $where = array('id' => $id);
        $bandar  = Bandar::where($where)->first();

        $bandar->keterangan = $request->keterangan;
        $bandar->kod_daerah = $request->select_daerah;
        $bandar->id_negeri  = $request->select_negeri;

        $bandar->save();

    }

    public function destroy($id)
    {
        $data = Bandar::where('id', $id)->delete();

        return Response::json($data);
    }
}
