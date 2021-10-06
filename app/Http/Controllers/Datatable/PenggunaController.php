<?php

namespace App\Http\Controllers\Datatable;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Requests\web\PenggunaRequest;
use App\Models\Calon\Calon;
use App\Models\Constant\Bandar;
use App\Models\Kru\Kru;
use App\Models\Kru\KruAlamat;
use App\Models\Peperiksaan\Peperiksaan;
use App\Models\UserRole;
use App\Models\User;
use App\Rules\checkIcPengguna;
use App\Rules\checkIdPengguna;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class PenggunaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {

            $type = $request->type;

            if ($type == 'get_negeri') {

                $value = $request->value;
                $where = array('id_negeri' => $value);
                $data  = Bandar::where($where)->get();

                return Response::json($data);

            } else {

                $data = User::with('kru', 'roles', 'kru.alamat')
                    ->whereHas('kru', function ($query) use ($request) {
                        $query->where('id_peperiksaan', $request->id_peperiksaan);
                    })
                    ->get();

                return Datatables::of($data)->make(true);
            }
        }
    }

    public function create()
    {
        //
    }

    public function store(PenggunaRequest $request)
    {
        $role   = UserRole::where('id', $request->select_peranan)->first();

        $user = User::create([
            'email'             => $request->email,
            'password'          => Hash::make($request->password_1),
            'id_pengguna'       => $request->id_pengguna,
            'id_peperiksaan'    => $request->id_peperiksaan,
            'id_jenis_pengguna' => 1
        ]);

        $user->fresh()->syncRoles([$role->name]);
    
        $this->createKru($user->fresh(), $request);

        return redirect()->back();
    }

    public function show(Request $request, $id)
    {
        //
    }

    public function edit($id)
    {
        $data = User::with('kru', 'roles:id,name,description', 'kru.alamat')
            ->where('id', $id)
            ->first()
            ->makeVisible('kru', 'kru.alamat');

        return Response::json($data);
    }

    public function update(Request $request, $id)
    {
        $rules = array(
            'select_peranan'                => 'required',
            'id_pengguna'                   => 'required|alpha_num',
            'email'                         => 'required|email|unique:users,email',
            'password_1'                    => 'min:6|required_with:password_2|same:password_2',
            'password_2'                    => 'min:6',
            'name'                          => 'required|min:6',
            'ic'                            => 'required|regex:/^\d{12}$/|unique:kru,no_kad_pengenalan',
            'phone'                         => 'required|regex:/^[(]?[0-9]{3}[)]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/',
            'address'                       => 'required|min:10',
            'postcode'                      => 'required|max:5|regex:/\b\d{5}\b/',
            'select_pengguna_negeri'        => 'required',
            'select_pengguna_bandar'        => 'required',
        );

        $messages = [
            'select_peranan.required'                   => 'Ruangan peranan mesti dipilih',
            'id_pengguna.required'                      => 'Ruangan kata nama mesti diisi',
            'id_pengguna.alpha_num'                     => 'Kata nama hanya huruf dan nombor sahaja dibenarkan. Tanda space tidak dibenarkan',
            'id_pengguna.unique'                        => 'Kata nama yang dimasukkan telah wujud di dalam pangkalan data. Sila pilih kata nama lain',
            'email.required'                            => 'Ruangan email mesti diisi',
            'email.email'                               => 'Alamat email yang dimasukkan tidah sah',
            'password_1.required_with'                  => 'Ruangan kata laluan mesti diisi',
            'password_1.same'                           => 'Kata laluan dimasukkan tidak sepadan dengan yang ditaip semula. Sahkan kemasukkan',
            'name.required'                             => 'Ruangan nama mesti diisi',
            'ic.required'                               => 'Ruangan no kad pengenalan mesti diisi',
            'ic.digits'                                 => 'Ruangan no kad pengenalan hendaklah diisi dalam bilangan 12 angka tanpa huruf atau simbol Cth: 960112011234',
            'ic.unique'                                 => 'No kad pengenalan telah wujud dengan Sistem Maklumat Perpaduan.',
            'phone.required'                            => 'Ruangan no telefon mesti diisi',
            'phone.digits_between'                      => 'uangan no telefon hendaklah dalam bilangan antara 10 hingga 12 angka tanpa huruf atau simbol',
            'address.required'                          => 'Alamat 1 mesti diisi',
            'postcode.required'                         => 'Ruangan Poskod mestilah diisi',
            'postcode.max'                              => 'Ruangan Poskod mestilah tidak melebihi 5 digit',
            'postcode.regex'                            => 'Ruangan Poskod mestilah dalam bentuk digit dan tidak melebihi 5 digit',
            'select_pengguna_negeri.required'           => 'Sila pillih negeri',
            'select_pengguna_bandar.required'           => 'Sila pilih bandar',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return Response::json(['errors' => $validator->errors()->toArray()]);
        } else {

            $where  = array('id' => $id);
            $user   = User::where($where)->first();
            $role   = UserRole::where('id', $request->select_peranan)->first();

            $user->id_pengguna              = $request->id_pengguna;
            $user->email                    = $request->email;
            $user->password                 = Hash::make($request->password_1);
            $user->syncRoles([$role->name]);

            $user->save();

            $kru = Kru::updateOrCreate([
                'id_user' => $user->id,
            ], [
                'no_kad_pengenalan' => preg_replace('/[^0-9]/', '', $request->ic),
                'no_pengenalan_lain' => NULL,
                'nama' => $request->name,
                'nama_i18n' => '',
                'no_telefon_bimbit' => $request->phone,
                'no_telefon_rumah' => '',
                'emel' => $request->email,
                'jawatan_perkhidmatan' => '',
                'gred_jawatan' => '',
                'id_jantina' => 0,
                'id_keturunan' => 0,
                'id_agama' => 0,
                'id_sekolah' => $request->select_sekolah,
                'id_jenis_perkhidmatan' => 0,
                'tarikh_lahir' => Carbon::now(),
                'tarikh_bersara' => Carbon::now(),
                'no_cukai_pendapatan' => '',
                'no_gaji' => '',
                'gaji_pokok' => 0.0,
            ]);

            KruAlamat::updateOrCreate([
                'id_kru' => $kru->id,
            ], [
                'jenis_alamat' => 0,
                'alamat' => $request->address,
                'poskod' => $request->postcode,
                'id_bandar' => $request->select_pengguna_bandar,
                'id_negeri' => $request->select_pengguna_negeri,
            ]);

            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $data = User::destroy($id);

        return Response::json($data);
    }

    public function createKru($user, $request){

        Kru::updateOrCreate([
            'id_user' => $user->id,
            'id_peperiksaan' => $request->id_peperiksaan,
            'id_pengguna' => $request->id_pengguna,
        ],[
            
            'no_kad_pengenalan' => preg_replace('/[^0-9]/', '', $request->ic),
            'no_pengenalan_lain' => NULL,
            'nama' => $request->name,
            'nama_i18n' => '',
            'no_telefon_bimbit' => $request->phone,
            'no_telefon_rumah' => '',
            'emel' => $request->email,
            'jawatan_perkhidmatan' => '',
            'gred_jawatan' => '',
            'id_jantina' => 0,
            'id_keturunan' => 0,
            'id_agama' => 0,
            'id_sekolah' => $request->select_sekolah,
            'id_jenis_perkhidmatan' => 0,
            'tarikh_lahir' => Carbon::now(),
            'tarikh_bersara' => Carbon::now(),
            'no_cukai_pendapatan' => '',
            'no_gaji' => '',
            'gaji_pokok' => 0.0,
            'aktif' => true,
        ]);

        KruAlamat::updateOrCreate([
            'id_kru' => $user->id
        ],[
            'jenis_alamat' => 0,
            'alamat' => $request->address,
            'poskod' => $request->postcode,
            'id_bandar' => $request->select_pengguna_bandar,
            'id_negeri' => $request->select_pengguna_negeri,
        ]);
    }
}
