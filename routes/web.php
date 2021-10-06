<?php

use App\Http\Controllers\Settings\PengesahanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

header('Access-Control-Allow-Origin:  *');
header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');
Route::get('api/docs', function(){
    return view('api.main');
});
Auth::routes();
Route::post('deploy',                                       'DeployController@deploy');
Route::get('aktif',                                         'CalonController@aktifCalon')->name('aktifCalon');

Route::get('cetakan-pendaftaran/{id_calon}',                'CalonController@cetakanPendaftaran');
Route::get('cetakan-label-meja/{id_calon}',                 'CalonController@cetakanLabelMeja');

//JPN CETAK LAPORAN PEMBATALAN CALON
Route::get('cetakan-laporan-pembatalan/{id_peperiksaan}',                     'CalonController@cetakanPembatalanCalon');
Route::get('cetakan-laporan-pembatalan-excel',               'CalonController@cetakanPembatalanCalonExcel');


// UMPK PELAPORAN CETAK
Route::get('cetakan-laporan-semua-pusat',                     'Api\PusatPeperiksaanController@cetakanSemuaPusat');
Route::get('cetakan-laporan-semua-pusat-web',                 'CalonController@cetakanSemuaPusat');
Route::get('cetakan-laporan-calon/{id_peperiksaan}/{id_jenis_pendaftaran}',                'CalonController@cetakanLaporanCalon');
Route::get('cetakan-laporan-pmc/{id_peperiksaan}',                     'CalonController@cetakanPmc');

Route::group([ 'middleware' => ['auth','role:SuperAdmin|JPN|UMPK'] ], function ()
{

    Route::name( 'console.' )->middleware('auth')->group( function () {

        Route::get('/',                                    'Konsol\KonsolController@index')->name('index');
        Route::get('selenggara-data',                      'Konsol\KonsolController@selenggaraData')->name('selenggara_data');
        Route::get('pengurusan-pengguna',                  'Konsol\KonsolController@pengurusanPengguna')->name('pengurusan_pengguna');
        Route::get('jejak-audit',                          'Konsol\KonsolController@jejakAudit')->name('jejak_audit');

    });

    Route::prefix( 'peperiksaan' )->name( 'peperiksaan.' )->middleware( 'auth' )->group( function () {

        Route::get('{kod_peperiksaan}',                    'Peperiksaan\PeperiksaanController@index')->name('dashboard');
        Route::get('{kod_peperiksaan}/{tahun}',            'Peperiksaan\PeperiksaanController@kemaskini')->name('kemaskini');

        require base_path('routes/includes/replication.php'); 
    });

});

Route::prefix( 'selenggara-data' )->group( function ()
{

    /* Resources Pengurusan Rujukan Data */

    Route::resource('kumpulan-kawalan',                    'Datatable\KumpulanKawalanController');
    Route::resource('kawalan-sistem',                      'Datatable\KawalanSistemController');
    Route::resource('mata-pelajaran',                      'Datatable\MataPelajaranController');
    Route::resource('kertas-peperiksaan',                  'Datatable\KertasPeperiksaanController');
    Route::resource('pengguna',                            'Datatable\PenggunaController');
    Route::resource('parlimen',                            'Datatable\ParlimenController');
    Route::resource('negeri',                              'Datatable\NegeriController');
    Route::resource('bandar',                              'Datatable\BandarController');
    Route::resource('daerah',                              'Datatable\DaerahController');
    Route::resource('agama',                               'Datatable\AgamaController');
    Route::resource('dun',                                 'Datatable\DUNController');


    Route::resource('sekolah',                             'Datatable\SekolahController');
    Route::resource('pusat',                               'Datatable\PusatController');
    Route::resource('ppd',                                 'Datatable\PPDController');

    Route::resource('jenis-peperiksaan',                   'Datatable\JenisPeperiksaanController');
    Route::resource('jenis-calon',                         'Datatable\JenisCalonController');
    Route::resource('jenis-kemasukan',                     'Datatable\JenisKemasukanController');
    Route::resource('jenis-keperluan-khas',                'Datatable\JenisKeperluanKhasController');
    Route::resource('jenis-jantina',                       'Datatable\JenisJantinaController');
    Route::resource('jenis-kes-kes',                       'Datatable\JenisKesKesController');

    Route::resource('jadual-kerja',                        'Datatable\JadualKerjaController');
    Route::resource('jadual-waktu-peperiksaan',            'Datatable\JadualWaktuPeperiksaanController');

});

Route::name( 'error.' )->group( function()
{
    Route::view('unauthenticated',                         'errors.unauthenticated')->name('unauthenticated');

});

// Pengesahan Through Email
Route::group(['prefix' => 'pengesahan', 'as' => 'pengesahan.'], function () {
    Route::group(['prefix' => 'pusat', 'as' => 'pusat.'], function () {
        Route::get('lewat', [PengesahanController::class, 'sahPusatLewat'])->name('lewat');
    });
});


require base_path('routes/includes/json.php');