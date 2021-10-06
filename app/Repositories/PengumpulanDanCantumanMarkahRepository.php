<?php

namespace App\Repositories;

use Exception;
use App\Models\Peperiksaan\RefPeperiksaan\Gred;
use App\Models\Peperiksaan\RefPeperiksaan\MataPelajaran;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class PengumpulanDanCantumanMarkahRepository extends BaseRepository
{
	public function gred()
	{
		$greds = Gred::all();

		return $greds;
	}

	public function mataPelajaran()
	{
		$mataPelajaran = MataPelajaran::all();

		return $mataPelajaran;
	}
}
