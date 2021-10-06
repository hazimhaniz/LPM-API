<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

class MyReadFilter implements \PhpOffice\PhpSpreadsheet\Reader\IReadFilter
{
    private $startRow = 0;
    private $endRow   = 0;

    /**  Get the list of rows and columns to read  */
    public function __construct($startRow, $endRow) {
        $this->startRow = $startRow;
        $this->endRow   = $endRow;
    }

    public function readCell($column, $row, $worksheetName = '') {
        //  Only read the rows and columns that were configured
        if ($row >= $this->startRow && $row <= $this->endRow) {
           return true;
        }
        return false;
    }
}

class convertXlsxToJson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'xlsx:json'; //{from} {to}

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convert xlsx file to json file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // 
        /** Create a new Xls Reader  **/
        //    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        //    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xml();
        //    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Ods();
        //    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Slk();
        //    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Gnumeric();
        //    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        /** Load $inputFileName to a Spreadsheet Object  **/

        $path           = 'public/data/';
        $inputFileName  = Collection::make(['data2017','data2018','data2019','data2020']);
        $format         = '.xlsx';
        $rowmin         = 10;
        $rowmax         = 20;

        /**  Create a new Reader of the type defined in $inputFileType  **/
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');

        /**  Create an Instance of our Read Filter  **/
        $filterSubset = new MyReadFilter($rowmin,$rowmax);

        /**  Advise the Reader that we only want to load cell data  **/
        $reader->setReadFilter($filterSubset);

        collect($inputFileName)->each(
            function($fileName, $key) use($path, $format, $reader, $rowmin, $rowmax) {
                $file = Storage::disk('local')->path($path.$fileName.$format);

                $excelObj = $reader->load($file);
                $worksheet = $excelObj->getSheet(0);

                $data = [];
                for ($row = $rowmin; $row <= $rowmax; $row++) {

                    $S101 = $worksheet->getCell('AC'.$row)->getValue() == "X" ? 'S101' : null;
                    $S102 = $worksheet->getCell('AD'.$row)->getValue() == "X" ? 'S102' : null;
                    $S103 = $worksheet->getCell('AE'.$row)->getValue() == "X" ? 'S103' : null;
                    $S104 = $worksheet->getCell('AF'.$row)->getValue() == "X" ? 'S104' : null;
                    $S105 = $worksheet->getCell('AG'.$row)->getValue() == "X" ? 'S105' : null;
                    $S106 = $worksheet->getCell('AH'.$row)->getValue() == "X" ? 'S106' : null;
                    $S107 = $worksheet->getCell('AI'.$row)->getValue() == "X" ? 'S107' : null;
                    $S108 = $worksheet->getCell('AJ'.$row)->getValue() == "X" ? 'S108' : null;
                    $S109 = $worksheet->getCell('AK'.$row)->getValue() == "X" ? 'S109' : null;
                    $S110 = $worksheet->getCell('AL'.$row)->getValue() == "X" ? 'S110' : null;

                    $data[] = [
                        'nama' => $worksheet->getCell('H'.$row)->getValue(),
                        'nama_i18n' => (string)$worksheet->getCell('AS'.$row)->getValue(),
                        'no_kad_pengenalan' => $worksheet->getCell('I'.$row)->getValue(),
                        'no_pengenalan_lain' => $worksheet->getCell('AQ'.$row)->getValue(),
                        'tarikh_lahir'  => $worksheet->getCell('J'.$row)->getValue()."-".$worksheet->getCell('K'.$row)->getValue()."-"."19".$worksheet->getCell('L'.$row)->getValue(),
                        'id_jantina'    => $worksheet->getCell('M'.$row)->getValue(),
                        'id_keturunan'  => $worksheet->getCell('N'.$row)->getValue(),
                        'id_agama'      => $worksheet->getCell('O'.$row)->getValue(),
                        'id_warganegara'=> $worksheet->getCell('P'.$row)->getValue(),
                        'tahun_peperiksaan_terakhir'   => json_encode([$worksheet->getCell('T'.$row)->getValue(),$worksheet->getCell('W'.$row)->getValue(),$worksheet->getCell('Z'.$row)->getValue()]),
                        'angka_giliran_terakhir' => json_encode([$worksheet->getCell('S'.$row)->getValue(),$worksheet->getCell('V'.$row)->getValue(),$worksheet->getCell('Y'.$row)->getValue()]),
                        'jumlah_subjek'     => $worksheet->getCell('AB'.$row)->getValue(),
                        'mata_pelajaran'    => json_encode([$S101,$S102,$S103,$S104,$S105,$S106,$S107,$S108,$S109,$S110]),
                        'angka_giliran_spm' => $worksheet->getCell('AM'.$row)->getValue(),
                        'tahun_peperiksaan_spm' => $worksheet->getCell('AN'.$row)->getValue(),
                        ''
                    ];
                }

                Storage::put('public/json/data'.$key.'.json',  json_encode($data,JSON_PRETTY_PRINT));
        });
    }
    
}


