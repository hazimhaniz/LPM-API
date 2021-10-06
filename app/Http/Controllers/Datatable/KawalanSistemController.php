<?php

namespace App\Http\Controllers\Datatable;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Requests\web\KawalanSistemRequest;
use App\Models\UserPermission;
use Yajra\DataTables\DataTables;

class KawalanSistemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = UserPermission::with('subPermissions')->where('type', 'main')
            ->get();

            return Datatables::of($data)
                ->make(true);
        }
    }

    public function create()
    {
        //
    }

    public function store(KawalanSistemRequest $request)
    {

        $userRole  = new UserPermission();

        $userRole->name                                     = $request->input_kawalan_sistem_nama;
        $userRole->description                              = $request->input_kawalan_sistem_penerangan;
        $userRole->status                                   = 1;
        $userRole->guard_name                               = 'web';

        $userRole->save();

        if($request->sub_permissions){

            foreach ($request->sub_permissions as $key => $value) {

                UserPermission::create([
                    'name' =>  $value,
                    'description' =>  $value,
                    'type' => 'sub',
                    'permission_id' => $userRole->id,
                    'guard_name' => 'web',
                    'status' => 1
                ]);
            }
        }

        Response::json('');
    }

    public function edit($id)
    {
        $data = UserPermission::with('subPermissions')
                ->where('type', 'main')
                ->where('id',  $id)
                ->first();

        return Response::json($data);
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'input_kawalan_sistem_nama.required'           => 'Ruangan nama peranan MESTI diisi',
            'input_kawalan_sistem_penerangan.required'     => 'Ruangan penerangan MESTI diisi',
            'input_kawalan_sistem_nama.unique'             => 'Ruangan nama peranan sudah wujud',
        ];

        $validator = Validator::make($request->all(), [
            'input_kawalan_sistem_nama'                    => 'required|unique:users__permissions,name,' . $id,
            'input_kawalan_sistem_penerangan'              => 'required',
        ], $messages);

        if ($validator->fails())
        {
            return Response::json(array('errors'    => $validator->errors()->toArray()));
        }

        $userRole  = UserPermission::where('id',  $id)->first();

        $userRole->name                                     = $request->input_kawalan_sistem_nama;
        $userRole->description                              = $request->input_kawalan_sistem_penerangan;

        $userRole->save();

        UserPermission::where('permission_id',  $id)->delete();

        if($request->sub_permissions){
            foreach ($request->sub_permissions as $key => $value) {
                UserPermission::create([
                    'name' =>  $value,
                    'description' =>  $value,
                    'type' => 'sub',
                    'permission_id' => $id,
                    'guard_name' => 'web',
                    'status' => 1
                ]);
            }
        }

        Response::json('');
    }

    public function destroy($id)
    {
        UserPermission::where('id', $id)->delete();
        UserPermission::where('permission_id', $id)->delete();

        return Response::json('');
    }
}
