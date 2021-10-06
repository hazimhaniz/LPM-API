<?php

namespace App\Http\Controllers\Datatable;

use App\Http\Controllers\Controller;
use App\Models\Peperiksaan\RefPeperiksaan\JenisCalon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class JenisCalonController extends Controller
{
    public function index(Request $request)
    {

        if($request->ajax())
        {

            $data = jenisCalon::with('peperiksaan')->when($request->id_peperiksaan, function($query) use ($request){
                $query->where('id_peperiksaan', $request->id_peperiksaan);
            })->get();

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
            'kod_jenis_calon.required'              => 'Kod Jenis Calon MESTI diisi dan unik',
            'keterangan.required'                   => 'Ruangan keterangan MESTI diisi',
        ];
        $validator = Validator::make($request->all(), [
            'kod_jenis_calon'                       => 'required',
            'keterangan'                            => 'required',
        ], $messages);

        if ($validator->fails())
        {
            return Response::json(['errors' => $validator->errors()->toArray()]);
        }

        $daerah = new jenisCalon();

        $daerah->kod_jenis_calon                    = $request->kod_jenis_calon;
        $daerah->id_peperiksaan                     = $request->id_peperiksaan;
        $daerah->keterangan                         = $request->keterangan;

        $daerah->save();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $where = array('id' => $id);
        $data  = jenisCalon::with('peperiksaan')->where($where)->first();

        return Response::json($data);
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'kod_jenis_calon.required'              => 'Kod Jenis Calon MESTI diisi dan unik',
            'keterangan.required'                   => 'Ruangan keterangan MESTI diisi',
        ];
        $validator = Validator::make($request->all(), [
            'kod_jenis_calon'                       => 'required',
            'keterangan'                            => 'required',
        ], $messages);

        if ($validator->fails())
        {
            return Response::json(['errors' => $validator->errors()->toArray()]);
        }

        $where = array('id' => $id);
        $daerah  = jenisCalon::where($where)->first();

        $daerah->kod_jenis_calon                    = $request->kod_jenis_calon;
        $daerah->id_peperiksaan                     = $request->id_peperiksaan;
        $daerah->keterangan                         = $request->keterangan;

        $daerah->save();

    }

    public function destroy($id)
    {
        $data = jenisCalon::where('id', $id)->delete();

        return Response::json($data);
    }
}
