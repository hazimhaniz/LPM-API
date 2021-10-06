<?php

namespace App\Http\Controllers\Peperiksaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Constant\Bandar;
use App\Models\Constant\Daerah;
use App\Models\Constant\DUN;
use App\Models\Constant\Negeri;
use App\Models\Constant\Parlimen;
use App\Models\Peperiksaan\Peperiksaan;
use App\Models\Peperiksaan\RefPeperiksaan\JenisSekolah;
use App\Models\Peperiksaan\RefPeperiksaan\PPD;
use App\Models\Peperiksaan\RefPeperiksaan\Sekolah;
use App\Models\Peperiksaan\TahunPeperiksaan;
use App\Models\UserRole;

class PeperiksaanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function index(Request $request, $kod_app)
    {

        $peperiksaan            = Peperiksaan::where('status', '=', true)
                                    ->where('keterangan', $kod_app)
                                    ->firstOrFail();

        $tahunPeperiksaans      = TahunPeperiksaan::select('id_peperiksaan', 'tahun')
                                    ->where('id_peperiksaan', $peperiksaan->id)
                                    ->orderBy('tahun', 'DESC')
                                    ->get();

        $dun                    = DUN::where     ('status', '=', true)->get();
        $bandar                 = Bandar::where  ('status', '=', true)->get();
        $daerah                 = Daerah::where  ('status', '=', true)->get();
        $negeri                 = Negeri::where  ('status', '=', true)->get();
        $parlimen               = Parlimen::where('status', '=', true)->get();
        $user_roles             = UserRole::where('status', true)->get()->except(2);
        $sekolahs               = Sekolah::get();


        return view('pages.peperiksaan.index', compact('peperiksaan', 'tahunPeperiksaans', 'user_roles', 'sekolahs', 'daerah', 'negeri', 'parlimen', 'dun', 'bandar'));
    }

    function kemaskini(Request $request, $kod_app, $tahun)
    {

        $peperiksaan            = Peperiksaan::where('status', '=', true)
                                    ->where('keterangan', $kod_app)
                                    ->firstOrFail();

        $tahunPeperiksaan       = TahunPeperiksaan::with('peperiksaan')
                                    ->where('id_peperiksaan', $peperiksaan->id)
                                    ->where('tahun', $tahun)
                                    ->firstOrFail();

        $jenis_sekolah          = JenisSekolah::where  ('status', '=', true)->where('id_peperiksaan', $peperiksaan->id)->get();
        $ppd                    = PPD::where     ('status', '=', true)->get();
        $dun                    = DUN::where     ('status', '=', true)->get();
        $bandar                 = Bandar::where  ('status', '=', true)->get();
        $daerah                 = Daerah::where  ('status', '=', true)->get();
        $negeri                 = Negeri::where  ('status', '=', true)->get();
        $parlimen               = Parlimen::where('status', '=', true)->get();

        return view('pages.tahun_peperiksaan.index', compact('tahunPeperiksaan', 'ppd', 'dun', 'daerah', 'negeri', 'jenis_sekolah'));
    }
}
