<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Peperiksaan\RefPeperiksaan\Pusat;
use App\Models\Pusat\PermohonanPusatLewat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PengesahanController extends Controller
{
    /**
     * Handle activation pusat lewat
     */
    public function sahPusatLewat(Request $request){

        $id = Crypt::decrypt($request->token);

        $permohonan = PermohonanPusatLewat::findOrFail($id);

        $permohonan->update(['status' => true]);

        $pusat = Pusat::where('id', $permohonan->id)->first();

        return view('emails.pusat.sah-pusat', compact('pusat'));
    }
}
