<?php

use App\Http\Controllers\Api\PusatPeperiksaanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix( '{peperiksaan}' )->group( function () {

    /*
    ---- KESELAMATAN ----
    */

    Route::prefix( 'keselamatan' )->group(function ()
    {

        /*
        ---- Login Pengguna ----
        */
        Route::post('log-masuk',                                                        'Api\KeselamatController@logMasuk');

        Route::middleware('auth:sanctum')->group(function ()
        {

            Route::post('log-keluar',                                                   'Api\KeselamatController@logKeluar');

        });

        /*
        ---- Aktif Pengguna ----
        */

        Route::post('daftar-akaun-calon',                                               'Api\CalonController@daftarAkaunCalon');
        Route::get('aktif',                                                             'Api\CalonController@aktifCalon');

    });



    /*
    ----  PUSAT ----
    */

    Route::prefix( 'pusat-peperiksaan' )->group(function ()
    {

        /* Permohonan Pusat Peperiksaan */

        Route::post('permohonan-pusat-peperiksaan',                                 'Api\PusatPeperiksaanController@permohonanPusatPeperiksaan');
        Route::get('semak-permohonan-pusat-peperiksaan',                            'Api\PusatPeperiksaanController@semakPermohonanPusatPeperiksaan');
        Route::get('senarai-permohonan-pusat-peperiksaan',                          'Api\PusatPeperiksaanController@senaraiPermohonanPusatPeperiksaan');
        Route::post('pengesahan-permohonan-pusat-peperiksaan',                      'Api\PusatPeperiksaanController@pengesahanPermohonanPusatPeperiksaan');
        Route::post('kemaskini-permohonan-pusat-peperiksaan',                       'Api\PusatPeperiksaanController@kemaskiniPermohonanPusatPeperiksaan');
        Route::get('senarai-permohonan-calon-pusat',                                'Api\PusatPeperiksaanController@senaraiPermohonanCalonPusat');

        Route::get('senarai-permohonan-pusat-lewat',                                'Api\PusatPeperiksaanController@SenaraiPermohonanPusatLewat');
        /* Semak Pusat Peperiksaan */

        Route::post('daftar-pusat-peperiksaan',                                     'Api\PusatPeperiksaanController@daftarPusatPeperiksaan');
        Route::post('pengesahan-daftar-pusat-peperiksaan',                          'Api\PusatPeperiksaanController@pengesahanPusatPeperiksaan');
        Route::get('semak-pusat-peperiksaan',                                       'Api\PusatPeperiksaanController@semakPusatPeperiksaan');
        Route::get('senarai-pusat-peperiksaan',                                     'Api\PusatPeperiksaanController@senaraiPusatPeperiksaan');
        Route::get('senarai-semua-pusat-peperiksaan',                               'Api\PusatPeperiksaanController@senaraiSemuaPusatPeperiksaan');
        Route::patch('kemaskini-pusat-peperiksaan',                                 'Api\PusatPeperiksaanController@kemaskiniPusatPeperiksaan');

    });


    /*
    ---- CALON ----
    */

    Route::prefix( 'calon' )->middleware( 'auth:sanctum' )->group( function ()
    {

        /*
        ---- Pendaftaran Calon
        */

        // Daftar Calon
        Route::post('daftar-calon',                                                 'Api\CalonController@daftarCalon');
        Route::post('daftar-senarai-calon',                                         'Api\CalonController@daftarSenaraiCalon');
        Route::patch('kemaskini-calon',                                             'Api\CalonController@kemaskiniCalon');

        Route::patch('kemaskini-calon-pt3',                                             'Api\CalonController@kemaskiniCalonPt3');

        Route::get('senarai-permohonan-calon',                                      'Api\CalonController@permohonanCalon');

        Route::get('semak-calon',                                                   'Api\CalonController@semakCalon');
        Route::get('semak-senarai-calon',                                           'Api\CalonController@semakSenaraiCalon');
        Route::get('semak-status-pendaftaran',                                      'Api\CalonController@semakStatusPendaftaran');

        Route::delete('padam-calon',                                                'Api\CalonController@padamCalon');

        // Daftar Mata Pelajaran
        Route::post('daftar-mata-pelajaran',                                        'Api\CalonController@daftarMataPelajaran');
        Route::post('daftar-senarai-mata-pelajaran',                                'Api\CalonController@daftarSenaraiMataPelajaran');

        Route::get('semak-mata-pelajaran',                                          'Api\CalonController@semakMataPelajaran');
        Route::delete('padam-mata-pelajaran',                                       'Api\CalonController@padamMataPelajaran');

        // Muat Naik Dokumen
        Route::post('padam-dokumen',                                                'Api\CalonController@padamDokumen');
        Route::post('muat-naik-dokumen',                                            'Api\CalonController@muatNaikDokumen');
        Route::get('semak-dokumen',                                                 'Api\CalonController@senaraiDokumen');

        // Pembayaran
        Route::get('pembayaran-pendaftaran-lewat',                                  'Api\CalonController@pembayaranPendaftaranLewat');
        Route::get('pembayaran-pt3',                                                 'Api\CalonController@pembayaranPT3');
        Route::get('pembayaran',                                                    'Api\CalonController@pembayaran');
        Route::get('status-pembayaran',                                             'Api\CalonController@statusPembayaran');

        // Pengesahan
        Route::post('pengesahanPusat',                                              'Api\CalonController@pengesahanPusat');
        Route::post('pengesahanPusatLewat',                                         'Api\CalonController@pengesahanPusatLewat');
        Route::post('pengesahanCalon',                                              'Api\CalonController@pengesahanCalon');
        Route::post('pengesahanCalonLewat',                                         'Api\CalonController@pengesahanCalonLewat');
        Route::get('status-pengesahan',                                             'Api\CalonController@statusPengesahan');

        Route::post('pengesahan-permohonan-pindah-calon',                           'Api\CalonController@pengesahanPermohonanPindahCalon');

        // Selenggara
        Route::post('jana-number-lp',                                               'Api\CalonController@janaNumberLP');
        Route::post('jana-angka-giliran',                                           'Api\CalonController@janaAngkaGiliran');


        /*
        ---- Permohonan Calon
        */
        Route::group(['prefix' => '/permohonan'], function(){
            Route::group(['prefix' => '/pembetulan'], function(){
                Route::get('/', ['uses' => 'Api\CalonController@listPembetulanCalon']);
                Route::get('/calon', ['uses' => 'Api\CalonController@pembetulanCalon']);
                Route::post('/', ['uses' => 'Api\CalonController@permohonanPembetulan']);
                Route::post('/pembayaran', ['uses' => 'Api\CalonController@PembayaranPembetulan']);
                Route::post('/status', ['uses' => 'Api\CalonController@updateStatusPembetulan']);
            });

            Route::group(['prefix' => '/pembatalan'], function(){
                Route::post('/', ['uses' => 'Api\CalonController@permohonanPembatalan']);
                Route::get('/calon', ['uses' => 'Api\CalonController@calonPembatalan']);
                Route::get('/status', ['uses' => 'Api\CalonController@calonPembatalanStatus']);
                Route::patch('/pengesahan', ['uses' => 'Api\CalonController@pengesahanPembatalan']);
                Route::get('/dibatalkan', ['uses' => 'Api\CalonController@senaraiCalonDibatalkan']);
            });
        });
        Route::post('permohonan-pembatalan-pendaftaran-calon',                      'Api\CalonController@permohonanPembatalanPendaftaranCalon');
        Route::post('permohonan-pembetulan-maklumat-calon',                         'Api\CalonController@permohonanPembetulanMaklumatCalon');

        Route::post('permohonan-pindah-calon',                                      'Api\CalonController@permohonanPindahCalon');
        Route::get('senarai-permohonan-pindah-calon',                               'Api\CalonController@senaraiPermohonanPindahCalon');

        Route::post('permohonan-pendaftaran-lewat',                                 'Api\CalonController@permohonanPendaftaranLewat');
        Route::get('senarai-permohonan-calon-lewat',                                'Api\CalonController@senaraiPermohonanCalonLewat');

        /* Senarai Calon */

        Route::get('semak-calon-jpn',                                               'Api\CalonController@semakCalonJPN');
        Route::get('semak-calon-apdm',                                              'Api\CalonController@semakCalonAPDM');
        Route::get('senarai-calon-sekolah',                                         'Api\CalonController@semakSenaraiCalonSekolah');
        Route::get('senarai-calon-lewat',                                         'Api\CalonController@semakSenaraiCalonLewat');
        Route::get('senarai-calon-pmc',                                         'Api\CalonController@semakSenaraiCalonPmc');


        /* Jana number Calon */

        Route::post('jana-number-lp',                                               'Api\CalonController@janaNumberLP');
        Route::post('jana-angka-giliran',                                           'Api\CalonController@janaAngkaGiliran');

        // get system notification
        Route::get('get-notification',                                       
        'Api\CalonController@getNotification');

    });
    
    /*
    ----- PEMERIKSA -----
    Jay update
    */
    // Route::prefix( 'pemeriksa' )->group(function ()
    Route::prefix( 'pemeriksa' )->middleware( 'auth:sanctum' )->group(function ()
    {
      /* Permohonan Pemeriksa */
      Route::post('permohonan-pemeriksa',                                 'Api\PemeriksaController@permohonanPemeriksa');
      Route::get('senarai-permohonan-pemeriksa',                          'Api\PemeriksaController@senaraiPermohonanPemeriksa');
      Route::patch('kemaskini-permohonan-pemeriksa',                      'Api\PemeriksaController@kemaskiniPermohonanPemeriksa');
       /* Borang Jawapan Pemeriksa */
       Route::post('borang-jawapan',                                       'Api\PemeriksaController@borangJawapan');
       Route::get('senarai-borang-jawapan',                                'Api\PemeriksaController@senaraiBorangJawapan');
       Route::patch('kemaskini-borang-jawapan',                            'Api\PemeriksaController@kemaskiniBorangJawapan');
       Route::get('pemeriksa-rekod',                                       'Api\PemeriksaController@pemeriksaRekod');
       /* status Rekod */
       Route::get('status-pengesahan-data',                                'Api\PemeriksaController@statusPengesahanRekod');
       Route::get('status-kelulusan-data',                                 'Api\PemeriksaController@statusKelulusanRekod');
       Route::get('status-janaan-data',                                    'Api\PemeriksaController@statusJanaanRekod');
    
    });

    Route::prefix( 'selenggara-data' )->group(function ()
    {

        /*
        ---- API Rujukan Data ----
        */

        Route::get('peperiksaan',                                                       'Api\SelenggaraDataController@peperiksaan');
        Route::get('tahun-peperiksaan',                                                 'Api\SelenggaraDataController@tahunPeperiksaan');
        Route::get('kumpulan-kawalan',                                                  'Api\SelenggaraDataController@kumpulanKawalan');
        Route::get('mata-pelajaran',                                                    'Api\SelenggaraDataController@mataPelajaran');
        Route::get('sekolah',                                                           'Api\SelenggaraDataController@sekolah');
        Route::get('pusat',                                                             'Api\SelenggaraDataController@pusat');
        Route::get('ppd',                                                               'Api\SelenggaraDataController@ppd');

        Route::get('jadual-kerja',                                                      'Api\SelenggaraDataController@jadualKerja');

        Route::get('jenis-pendaftaran', ['uses' => 'Api\SelenggaraDataController@jenisPendaftaran']);
        Route::get('jenis-kemasukan',                                                   'Api\SelenggaraDataController@jenisKemasukan');
        Route::get('jenis-kecacatan',                                                   'Api\SelenggaraDataController@jenisKecacatan');
        Route::get('jenis-keturunan',                                                   'Api\SelenggaraDataController@jenisKeturunan');
        Route::get('jenis-jantina',                                                     'Api\SelenggaraDataController@jenisJantina');
        Route::get('jenis-calon',                                                       'Api\SelenggaraDataController@jenisCalon');

        Route::get('agama',                                                             'Api\SelenggaraDataController@agama');
        Route::get('bandar',                                                            'Api\SelenggaraDataController@bandar');
        Route::get('daerah',                                                            'Api\SelenggaraDataController@daerah');
        Route::get('negeri',                                                            'Api\SelenggaraDataController@negeri');
        

    });

    Route::prefix( 'inden' )->group(function ()
    {

        /*
        ---- API Rujukan Data ----
        */

        Route::get('/senarai-pusat-peperiksaan',    'Api\IndenController@pusatByDaerah');
        Route::post('/cari-bilik-kebal',             'Api\IndenController@cariBilikKebal');

        // Pengurusan CBK
        Route::get('/senarai-cbk',      'Api\CalonController@senaraiCbk');
        Route::post('/pengesahan-cbk',  'Api\CalonController@pengesahanCbk');
   
        Route::get('negerippdsekolah',                                                  'Api\IndenController@negerippdsekolah');
    });
});
