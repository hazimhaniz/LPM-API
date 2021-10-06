<?php

namespace App\Http\Controllers;

use App\Events\SendEmailEvent;
use App\Models\Calon\Calon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Symfony\Component\Process\Process;
use App\Repositories\PusatPeperiksaanRepository;
use App\Repositories\CalonRepository;
use App\Exports\calonBatalExport;
use Maatwebsite\Excel\Facades\Excel;


class CalonController extends Controller
{
    public function aktifCalon(Request $request)
    {
        $decrypted = Crypt::decryptString($request->token);

        $calon = Calon::findOrFail($decrypted);

        $details = [
            'title'                 => 'Pendaftaran Berjaya',
            'no_pengenalan_lain'   => $calon->no_pengenalan_lain,
            'no_kad_pengenalan'     => $calon->no_kad_pengenalan,
            'id_pengguna'           => is_null($calon->no_kad_pengenalan) ? $calon->no_janaan_lp : $calon->no_kad_pengenalan,
            'emails'                => $calon->emel,
            'nama'                  => $calon->nama,
            'token'                 => Crypt::encryptString($calon->id),
            'view'                  => 'emails.pendaftaranCalonBerjaya',
        ];

        if ($calon->aktif) {
            return view('emails.berjaya', compact('details', 'calon'));
        }

        event(new SendEmailEvent($details));

        $calon->update(['aktif' => true]);

        return view('emails.berjaya', compact('details', 'calon'));
    }


   public function cetakanPendaftaran($id_calon) {

    $calon = Calon::with('permohonan')->findOrFail($id_calon);

    // view()->share('calon', $calon);
    // $pdf = PDF::loadView('pdf.cetakan-pendaftaran', $calon );

    return view('pdf.cetakan-pendaftaran', compact('calon'));
  }

   public function cetakanLabelMeja($id_calon) {

    $calon = Calon::findOrFail($id_calon);

    return view('pdf.cetakan-label-meja', compact('calon'));
  }

  public function cetakanSemuaPusat(PusatPeperiksaanRepository $pusatRepository)
  {   
      return $pusatRepository->cetakanLaporanSemuaPusat();
  }

  public function cetakanLaporanCalon($peperiksaan, $id_jenis_pendaftaran,  CalonRepository $pusatRepository)
  {   
      return $pusatRepository->cetakanLaporanCalon($peperiksaan, $id_jenis_pendaftaran);
  }

  public function cetakanPembatalanCalon($id_peperiksaan, CalonRepository $calonRepository)
  {   
      return  $calonRepository->cetakanCalonDibatalkan($id_peperiksaan);
  }

  public function cetakanPmc( $id_peperiksaan, CalonRepository $calonRepository)
  {   
      return  $calonRepository->cetakanPmc($id_peperiksaan);
  }

  public function cetakanPembatalanCalonExcel()
  {   
    return Excel::download(new calonBatalExport, 'users.xlsx');
  }

}
