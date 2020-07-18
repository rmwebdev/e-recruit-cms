<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Candidate;
use App\Models\JobFptk;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportData implements FromView 
{

	use Exportable;

	public function __construct(string $start,string $end,string $tipe)
	{
		$this->start = $start;
		$this->end = $end;
		$this->tipe = $tipe;

	}

  	public function registerEvents(): array
    {
        return [
            BeforeExport::class  => function(BeforeExport $event) {
                $event->writer->setCreator('Patrick');
            },
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

                $event->sheet->styleCells(
                    'B2:G8',
                    [
                        'borders' => [
                            'outline' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                                'color' => ['argb' => 'FFFF0000'],
                            ],
                        ]
                    ]
                );
            },
        ];
    }

	public function view(): View
	{
		$data;

		if($this->tipe == 'job_fptk')
		{
			$data = JobFptk::whereDate('received_date_fptk','>=',''.$this->start.'')->whereDate('received_date_fptk','<=',''.$this->end.'')->get();
			return view('backend.export_data.view_export_data_jobfptk', [
            	'dataExport' => $data
        	]);
		}
		else if($this->tipe == 'candidate')
		{
			$data = Candidate::whereDate('received_date','>=',''.$this->start.'')->whereDate('received_date','<=',''.$this->end.'')->get();
			return view('backend.export_data.view_export_data_candidate', [
           	 	'dataExport' => $data
        	]);
		}		

		
	}


}
