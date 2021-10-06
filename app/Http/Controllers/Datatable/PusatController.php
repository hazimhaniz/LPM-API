<?php

namespace App\Http\Controllers\Datatable;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\Models\Peperiksaan\RefPeperiksaan\Pusat;

class PusatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = Pusat::get();

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

        $data = new Pusat;

        $data->kod_pusat                        = $request->kod_pusat;
        $data->nama_pusat                       = $request->nama_pusat;
        $data->id_sekolah                       = $request->id_sekolah ?? 0;
        $data->id_bilik_kebal                   = $request->id_bilik_kebal ?? 0;
        $data->jumlah_calon                     = $request->jumlah_calon ?? 0;
        $data->id_status_pendaftaran            = $request->id_status_pendaftaran ?? 0;
        $data->id_status_pendaftaran_calon      = $request->id_status_pendaftaran_calon ?? 0;
        $data->id_status_janaan_angka_giliran   = $request->id_status_janaan_angka_giliran ?? 0;
        $data->id_tahun_peperiksaan             = $request->id_tahun_peperiksaan ?? 0;

        $data->save();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $where                          = array('id' => $id);
        $data                           = Pusat::where($where)->first();

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
        $data                           = Pusat::where($where)->first();

        $data->kod_pusat                = $request->kod_pusat;
        $data->nama_pusat               = $request->nama_pusat;

        $data->sekoalah->save();
        $data->save();
    }

    public function destroy($id)
    {
        $data = Pusat::where('id', $id)->delete();

        return Response::json($data);
    }

    public function validateRequest($request)
    {
        $messages = [

            'kod_pusat.required'        => 'Kod Pusat MESTI diisi dan unik',
            'nama_pusat.required'       => 'Ruangan nama Pusat MESTI diisi',

        ];

        $validator = Validator::make($request->all(), [

            'kod_pusat'                 => 'required',
            'nama_pusat'                => 'required',

        ], $messages);

        return $validator;
    }
}
