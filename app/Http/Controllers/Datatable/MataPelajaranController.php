<?php

namespace App\Http\Controllers\Datatable;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\MataPelajaranRequest;
use App\Models\Peperiksaan\RefPeperiksaan\MataPelajaran;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\DataTables;

class MataPelajaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $data = MataPelajaran::with('peperiksaan')
            ->where('id_peperiksaan', $request->id_peperiksaan)
            ->get();

        return Datatables::of($data)->make(true);
    }

    public function create()
    {
        //
    }

    public function store(MataPelajaranRequest $request)
    {
        MataPelajaran::create($request->except('action', '_method', 'hidden_id'));     
    }

    public function show($id)
    {
        $data = MataPelajaran::with('peperiksaan')
            ->where('kod_peperiksaan', $id)
            ->get();

        return Datatables::of($data)->make(true);
    }

    public function edit($id)
    {
        $data  = MataPelajaran::with('peperiksaan')
            ->where('id',$id)
            ->first();

        return Response::json($data);
    }

    public function update(MataPelajaranRequest $request, $id)
    {
        MataPelajaran::where('id', $id)
            ->update($request->except('action', '_method', 'hidden_id', 'id_peperiksaan'));
    }

    public function destroy($id)
    {
        $data = MataPelajaran::where('id', $id)->delete();

        return Response::json($data);
    }
}
