<?php

namespace App\Http\Controllers\Datatable;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\Models\Peperiksaan\RefPeperiksaan\PPD;

class PPDController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = PPD::with('negeri')->get();

            return Datatables::of($data)->make(true);
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validator = $this->validateRequest($request);

        if ($validator->fails())
        {
            return Response::json(
                [
                    'errors' => $validator->errors()->toArray()
                ]
            );
        }

        $data = new PPD;

        $data->kod_ppd                  = $request->kod_ppd;
        $data->nama_ppd                 = $request->nama_ppd;
        $data->id_negeri                = $request->select_negeri;

        $data->save();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $where                          = array('id' => $id);
        $data                           = PPD::where($where)->first();

        return Response::json($data);
    }

    public function update(Request $request, $id)
    {
        $validator = $this->validateRequest($request);

        if ($validator->fails())
        {
            return Response::json(
                [
                    'errors' => $validator->errors()->toArray()
                ]
            );
        }

        $where                          = array('id' => $id);
        $data                           = PPD::where($where)->first();

        $data->kod_ppd                  = $request->kod_ppd;
        $data->nama_ppd                 = $request->nama_ppd;
        $data->id_negeri                = $request->select_negeri;

        $data->save();
    }

    public function destroy($id)
    {
        $data = PPD::where('id', $id)->delete();

        return Response::json($data);
    }

    public function validateRequest($request)
    {
        $messages = [

            'kod_ppd.required'          => 'Kod PPD MESTI diisi dan unik',
            'nama_ppd.required'         => 'Ruangan nama PPD MESTI diisi',
            'select_negeri.required'    => 'Sila pilih negeri',

        ];
        
        $validator = Validator::make($request->all(), [

            'kod_ppd'                   => 'required',
            'nama_ppd'                  => 'required',
            'select_negeri'             => 'required',

        ], $messages);

        return $validator;
    }
}
