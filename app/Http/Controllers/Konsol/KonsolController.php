<?php

namespace App\Http\Controllers\Konsol;

use App\Http\Controllers\Controller;
use App\Models\Peperiksaan\RefPeperiksaan\MataPelajaran;
use App\Models\Peperiksaan\Peperiksaan;
use App\Models\Audit;
use App\Models\Constant\DUN;
use App\Models\Constant\Daerah;
use App\Models\Constant\Negeri;
use App\Models\Constant\Parlimen;
use App\Models\Peperiksaan\RefPeperiksaan\Sekolah;
use App\Models\Peperiksaan\RefPeperiksaan\PPD;
use App\Models\User;
use App\Models\UserPermission;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class KonsolController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function aktifCalon(Request $request, $token)
    {

        return Crypt::decryptString($token);
    }

    function index()
    {
        $peperiksaans           = Peperiksaan::where('status', '=', true)->get();

        return view('pages.console.index', compact('peperiksaans'));
    }

    function pengurusanPengguna()
    {

        $users                  = User::get();
        $user_roles             = UserRole::where('status', '=', true)->get();
        $user_permissions       = UserPermission::with('subPermissions')->where('status', true)->where('type', 'main')->get();
        $sekolahs               = Sekolah::get();

        return view('pages.console.pengurusan_pengguna', compact('users', 'user_roles', 'user_permissions','sekolahs'));
    }

    function selenggaraData()
    {

        $dun                    = DUN::where('status',       true)->get();
        $daerah                 = Daerah::where('status',    true)->get();
        $negeri                 = Negeri::where('status',    true)->get();
        $parlimen               = Parlimen::where('status',  true)->get();
        $kod_ppd                = PPD::where('status',       true)->get();

        return view('pages.console.selenggaran_data', compact('daerah', 'negeri', 'parlimen', 'dun', 'kod_ppd'));
    }

    function mataPelajaran()
    {

        $peperiksaans           = Peperiksaan::where   ('status', '=', true)->get();
        $appKodMataPelajaran    = MataPelajaran::where ('status', '=', true)->get();

        return view('pages.console.data_source.mata_pelajaran', compact('peperiksaans', 'appKodMataPelajaran'));
    }

    function jejakAudit()
    {

        $audits                 = Audit::paginate(15);

        return view('pages.console.jejak_audit', compact('audits'));
    }
}
