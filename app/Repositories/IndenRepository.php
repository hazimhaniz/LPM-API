<?php

namespace App\Repositories;

use Exception;
use App\Models\Constant\Negeri;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PHPJasper\PHPJasper;
use JasperPHP\JasperPHP as JasperPHP;


class IndenRepository extends BaseRepository
{
	public function pusatByDaerah($peperiksaan, $request)
	{
		Log::info("--- sspat :: IndenRepository :: pusatByDaerah ---");
		$idNegeri = $request->negeri;
		$idDaerah = $request->daerah;
		$jsonPeriksa = json_decode($peperiksaan, true);
		$idTahunPeriksa = $jsonPeriksa['id_tahun_peperiksaan_semasa'];

		Log::info("idNegeri: ".$idNegeri);
		Log::info("idDaerah: ".$idDaerah);
		Log::info("idTahunPeriksa: ".$idTahunPeriksa);

		$q = DB::table('ref_peperiksaan__kod_pusat as p')
			->join('ref_peperiksaan__kod_sekolah as s', function ($join) {
				$join->on('p.id_sekolah', '=', 's.id');
			})
			->select(
				'p.id',
				'p.kod_pusat',
				'p.nama_pusat as keterangan',
				'p.id_sekolah',
				'p.id_tahun_peperiksaan',
				's.kod_sekolah',
				's.id_negeri',
				's.id_daerah'
			)
			->where('p.id_tahun_peperiksaan', '=', $idTahunPeriksa)
			->orderBy('p.nama_pusat', 'ASC');

		if (!empty($idNegeri)) {
			$q->where('s.id_negeri', '=', $idNegeri);
		}
		if (!empty($idDaerah)) {
			$q->where('s.id_daerah', '=', $idDaerah);
		}
		$data = $q->get();
		return $data;
	}

	public function cariBilikKebal($peperiksaan, $request)
	{
		$idNegeri = $request->negeri;
		$idDaerah = $request->daerah;
		$idPusat = $request->pusat;
		$jsonPeriksa = json_decode($peperiksaan, true);
		$idTahunPeriksa = $jsonPeriksa['id_tahun_peperiksaan_semasa'];

		$q = DB::table('ref_peperiksaan__kod_pusat as p')
			->join('ref_peperiksaan__kod_sekolah as s', function ($join) {
				$join->on('p.id_sekolah', '=', 's.id');
			})
			->select(
				'p.id',
				'p.kod_pusat',
				'p.nama_pusat as keterangan',
				'p.id_sekolah',
				'p.id_tahun_peperiksaan',
				's.kod_sekolah',
				's.id_negeri',
				's.id_daerah'
			)
			->where('p.id_tahun_peperiksaan', '=', $idTahunPeriksa)
			->orderBy('p.nama_pusat', 'ASC');

		if (!empty($idNegeri)) {
			$q->where('s.id_negeri', '=', $idNegeri);
		}
		if (!empty($idDaerah)) {
			$q->where('s.id_daerah', '=', $idDaerah);
		}
		if (!empty($idPusat)) {
			$q->where('p.id', '=', $idPusat);
		}
		$data = $q->get();
		return $data;
	}

	public function lapMpNeg($peperiksaan, $request)
	{
		Log::info("--- Sspat :: IndenRepository :: lapMpNeg ---");
		$input = app_path().'/Jasper/hello.jasper';
		$output = public_path() . '/laporan';


		Log::info("app_path: ".app_path());
		Log::info("public_path: ".public_path());
		Log::info("input: ".$input);
		Log::info("output: ".$output);
	
		$dbConnection = config('database.connections.generic');

		//$dbConnection => 

		Log:info("--- dbConnetion ---");
		//Log::info($dbConnection);

		$options = [
			'format' => ['pdf'],
			'params' => [],
			'locale' => 'en',
			'db_connection' => [
				'driver' => 'mysql', 
				'username' => 'root',
				'password' => 'password',
				'host' => '127.0.0.1',
				'database' => 'sppat',
				'port' => '3307',
				//'jdbc_driver' => 'com.mysql.cj.jdbc.Driver',
				//'jdbc_driver' => 'com.mysql.jdbc.Driver',
				//'jdbc_url' => 'jdbc:mysql://127.0.0.1:3306/sppat',
				'jdbc_url' => 'jdbc:mysql://localhost:3307/sppat',
				'jdbc_driver' => 'org.mariadb.jdbc.Driver',
				//'jdbc_url' => 'jdbc:mariadb://localhost:3307/sppat'
			]
		];

		$jasper = new PHPJasper; 
		try {
			Log::info("jasper process");
			$x = $jasper->process(
				$input,
				$output,
				$options
			)->execute();

			$x = $jasper->process(
				$input,
				$output,
				$options
				)->output();
			
			Log::info($x);

		} catch (Exception $e) {
			Log::error($e->getMessage());
		}
	}

    public function negerippdsekolah($peperiksaan, $request)
    {
		$data = Negeri::select('id', 'kod_negeri', 'keterangan')
				->whereHas('ppd.sekolah.pusat.tahunPeperiksaan.peperiksaan', function($query) use ($peperiksaan) {
					$query->where('id'  , $peperiksaan->id);
				})
                ->when($request->id, function($query) use ($request){
                    $query->where('id', $request->id);
                })
				// ->whereHas('ppd.sekolah.pusat', function($q){
				// 	$q->whereJsonContains('ids_mata_pelajaran', '30');
				// })
				
				// ->whereHas('ppd.sekolah.pusat', function($q){ 
				// 	return collect($q->whereNotNull('ids_mata_pelajaran')->get())
				// 	->each( function($pusat){ 
				// 		if(array_intersect(json_decode($pusat->ids_mata_pelajaran), array(1,2,3))) {return $pusat;}  
				// 	}); 
				// })
				// ->whereHas('ppd.sekolah', function($query ){ return $query; })
				// ->whereHas('ppd.sekolah.pusat', function($q){ 
				// 	return collect($q)->each( function($pusat){ 
				// 		if(array_intersect(json_decode($pusat->ids_mata_pelajaran ?? json_encode(array())), array(55, 71))) {return $pusat;}  
				// 	}); 
				// })
                ->with('ppd.sekolah.pusat')
                ->get();

				// Negeri::with('ppd','ppd.sekolah')
				// ->whereHas('ppd.sekolah', function($query ){ return $query; })
				// ->whereHas('ppd.sekolah.pusat', function($q){ 
				// 	return collect($q)->each( function($pusat){ 
				// 		if(array_intersect(json_decode($pusat->ids_mata_pelajaran ?? json_encode(array())), array(1,2,3))) {return $pusat;}  
				// 	}); 
				// })->get();

		// $data = Negeri::with('ppd')
		// 	->whereHas('ppd.sekolah.pusat', function($q){ 
		// 	return collect($q->whereNotNull('ids_mata_pelajaran')->get())
		// 	->each( function($pusat){ 
		// 		if(array_intersect(json_decode($pusat->ids_mata_pelajaran), array(1,2,3))) {return $pusat;}  
		// 	}); })->first();

        return $data;
    }
}
