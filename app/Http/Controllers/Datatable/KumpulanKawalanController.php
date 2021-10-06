<?php

namespace App\Http\Controllers\Datatable;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Requests\web\KumpulanKawalanRequest;
use App\Models\User;
use App\Models\UserPermission;
use App\Models\UserRole;
use Yajra\DataTables\DataTables;

class KumpulanKawalanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = UserRole::get();

            return Datatables::of($data)
                ->make(true);
        }
    }

    public function create()
    {
        //
    }

    public function store(KumpulanKawalanRequest $request)
    {

        $role  = UserRole::create($request->except('_token', 'permissions'));

        $role->fresh()->syncPermissions($request->permissions);

        return Response::json($role->fresh());
    }

    public function show(Request $request, $id)
    {
        //
    }

    public function edit($id)
    {
        $where = array('id' => $id);
        $data  = UserRole::with('userPermissions.subPermissions')->where($where)->first();

        return Response::json($data);
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'input_peranan_nama.required'           => 'Ruangan nama peranan MESTI diisi',
            'input_peranan_penerangan.required'     => 'Ruangan penerangan MESTI diisi',
            'input_peranan_nama.unique'             => 'Ruangan nama peranan sudah wujud',
        ];

        $validator = Validator::make($request->all(), [
            'input_peranan_nama'                    => 'required|unique:users__roles,name,' . $id ,
            'input_peranan_penerangan'              => 'required',
        ], $messages);

        if ($validator->fails())
        {
            return Response::json(array('errors'    => $validator->errors()->toArray()));
        }

        $where                                      = array('id' => $id);
        $userRole                                   = UserRole::where($where)->first();

        $userRole->name                             = $request->input_peranan_nama;
        $userRole->description                      = $request->input_peranan_penerangan;
        $userRole->syncPermissions($request->permissions);
        $userRole->save();
    }

    public function destroy($id)
    {
        $role = UserRole::where('id', $id)->first();

        $users = User::role($role->name)->get();

        foreach ($users as $user)
        {
            $user->removeRole($role->name);
        }

        $role->delete();

        return Response::json('');
    }
}
