<?php

namespace App\Http\Controllers\Datatable;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\Models\Peperiksaan\RefPeperiksaan\Sekolah;
use App\Models\Constant\Bandar;
use App\Models\Constant\Daerah;
use App\Models\Constant\DUN;
use App\Models\Constant\Parlimen;
use App\Models\Peperiksaan\RefPeperiksaan\PPD;

class SekolahController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {

            $type = $request->type;
            $value = $request->value;

            if ($value || $type)
            {
                if ($type == 'get_negeri') {

                    $where = array('id_negeri' => $value);
                    $data  = Daerah::where($where)->get();

                    return Response::json($data);

                } else if ($type == 'get_daerah') {

                    $daerah  = Daerah::where('id', $value)->first();
                    $data  = Bandar::where('kod_daerah', $daerah->kod_daerah)->get();

                    return Response::json($data);

                } else if ($type == 'get_ppd') {

                    $where = array('id_negeri' => $value);
                    $data  = PPD::where($where)->get();

                    return Response::json($data);

                } else if ($type == 'get_parlimen') {

                    $where = array('id_negeri' => $value);
                    $data  = Parlimen::where($where)->get();

                    return Response::json($data);

                } else if ($type == 'get_dun') {

                    $data  = Parlimen::find($value);

                    $where = array('kod_parlimen' => $data->kod_parlimen);
                    $data  = DUN::where($where)->get();

                    return Response::json($data);

                } else if ($type == 'get_sekolah'){
                    $where = array('id_negeri' => $value);
                    $res = Sekolah::where('id_negeri', $value)->get();

                    return Response::json($res);
                } else {
                    $res = Sekolah::find($value);

                    return Response::json($res);
                }

            } else {

                $data = Sekolah::with('negeri')->get();

                return Datatables::of($data)->make(true);

            }
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validator = $this->validateRequest($request);
 
        if ($validator->fails()) {
            return Response::json(
                [
                    'errors' => $validator->errors()->toArray()
                ]
            );
        }

        $data = new Sekolah;

        $data->kod_sekolah                   = $request->kod_sekolah;
        $data->nama_sekolah                  = $request->nama_sekolah;
        $data->nama_pengetua                 = $request->nama_pengetua;
        $data->alamat_sekolah                = $request->alamat_sekolah;
        $data->poskod                        = $request->poskod_sekolah;
        // $data->id_jenis_calon                = $request->id_jenis_sekolah ?? 0; // no field in db??
        $data->id_jenis_sekolah              = $request->select_jenis_sekolah;
        $data->id_bandar                     = $request->select_bandar_sekolah;
        $data->id_lokasi                     = $request->select_lokasi_sekolah;
        $data->id_daerah                     = $request->select_daerah_sekolah;
        $data->id_negeri                     = $request->select_negeri_sekolah;
        $data->id_ppd                        = $request->select_ppd_sekolah;
        $data->id_parlimen                   = $request->select_parlimen_sekolah;
        $data->id_dun                        = $request->select_dun_sekolah;
        $data->no_telefon                    = $request->no_telefon;
        $data->no_faks                       = $request->no_faks;
        $data->emel_sekolah                  = $request->emel_sekolah;
        $data->status                        = 1;

        $data->save();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $where                          = array('id' => $id);
        $data                           = Sekolah::where($where)->first();

        return Response::json($data);
    }

    public function update(Request $request, $id)
    {
        $validator = $this->validateRequest($request);

        if ($validator->fails()) {
            return Response::json(
                [
                    'errors' => $validator->errors()->toArray()
                ]
            );
        }

        $where                               = array('id' => $id);
        $data                                = Sekolah::where($where)->first();


        $data->kod_sekolah                   = $request->kod_sekolah;
        $data->nama_sekolah                  = $request->nama_sekolah;
        $data->nama_pengetua                 = $request->nama_pengetua;
        $data->alamat_sekolah                = $request->alamat_sekolah;
        $data->poskod                        = $request->poskod_sekolah;
        // $data->id_jenis_calon                = $request->id_jenis_sekolah ?? 0; // no field in db??
        $data->id_jenis_sekolah              = $request->select_jenis_sekolah;
        $data->id_bandar                     = $request->select_bandar_sekolah;
        $data->id_lokasi                     = $request->select_lokasi_sekolah;
        $data->id_daerah                     = $request->select_daerah_sekolah;
        $data->id_negeri                     = $request->select_negeri_sekolah;
        $data->id_ppd                        = $request->select_ppd_sekolah;
        $data->id_parlimen                   = $request->select_parlimen_sekolah;
        $data->id_dun                        = $request->select_dun_sekolah;
        $data->no_telefon                    = $request->no_telefon;
        $data->no_faks                       = $request->no_faks;
        $data->emel_sekolah                  = $request->emel_sekolah;
        $data->status                        = 1;

        $data->save();
    }

    public function destroy($id)
    {
        $data = Sekolah::where('id', $id)->delete();

        return Response::json($data);
    }

    public function validateRequest($request)
    {
        $messages = [
            'kod_sekolah.required'              => 'Kod sekolah MESTI diisi dan unik',
            'nama_sekolah.required'             => 'Nama sekolah MESTI diisi dan unik',
            'nama_pengetua.required'            => 'Nama Pengetua MESTI diisi dan unik',
            'no_telefon.required'               => 'No Telefon MESTI diisi dan unik',
            'no_telefon.numeric'                => 'No Telefon MESTI diisi dengan nombor sahaja',
            'no_faks.required'                  => 'No Fax MESTI diisi dan unik',
            'no_faks.numeric'                   => 'No Fax MESTI diisi dengan nombor sahaja',
            'emel_sekolah.required'             => 'Email sekolah MESTI diisi dan unik',
            'alamat_sekolah.required'           => 'Alamat sekolah MESTI diisi dan unik',
            'poskod_sekolah.required'           => 'Poskod sekolah MESTI diisi dan unik',
            'poskod_sekolah.numeric'            => 'Poskod sekolah MESTI diisi dengan nombor sahaja',
            'select_negeri_sekolah.required'    => 'Sila pilih negeri',
            'select_daerah_sekolah.required'    => 'Sila pilih daerah',
            'select_bandar_sekolah.required'    => 'Sila pilih bandar',
            'select_ppd_sekolah.required'       => 'Sila pilih PPD',
            'select_parlimen_sekolah.required'  => 'Sila pilih Parlimen',
            'select_dun_sekolah.required'       => 'Sila pilih DUN',
            'select_jenis_sekolah.required'     => 'Sila pilih Jenis Sekolah',
            'select_lokasi_sekolah.required'    => 'Sila pilih Lokasi Sekolah',
        ];
        $validator = Validator::make($request->all(), [
            'kod_sekolah'                       => 'required',
            'nama_sekolah'                      => 'required',
            'nama_pengetua'                     => 'required',
            'no_telefon'                        => 'required|numeric|regex:/^[(]?[0-9]{3}[)]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/',
            'no_faks'                           => 'required|numeric|regex:/^\+?[0-9]{7,}$/',
            'emel_sekolah'                      => 'required|email:rfc,dns',
            'alamat_sekolah'                    => 'required|string',
            'poskod_sekolah'                    => 'required|numeric|regex:/^\+?[0-9]{5,}$/',
            'select_negeri_sekolah'             => 'required',
            'select_daerah_sekolah'             => 'required',
            'select_bandar_sekolah'             => 'required',
            'select_ppd_sekolah'                => 'required',
            'select_parlimen_sekolah'           => 'required',
            'select_dun_sekolah'                => 'required',
            'select_jenis_sekolah'              => 'required',
            'select_lokasi_sekolah'             => 'required',
        ], $messages);

        return $validator;
    }
}
