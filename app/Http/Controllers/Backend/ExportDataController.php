<?php

namespace App\Http\Controllers\Backend;;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\ExportData;
use Validator;
use Maatwebsite\Excel\Facades\Excel;

class ExportDataController extends Controller
{
    //
    public function __construct()
	{
		$this->middleware('auth');
	}

    public function index()
    {
    	return view('backend.export_data.index_export_data');
    }

    public function exportData(Request $request)
    {
    	if($request->tipe == 'job_fptk')
    	{	
    		$tipe = 'JOBFPTK';
    	}
    	else if($request->tipe == 'candidate')
    	{
    		$tipe = 'CANDIDATE';
    	}
    	return Excel::download(new ExportData($request->start,$request->end,$request->tipe),''.date('YmdHis').$tipe.'.xlsx');
        
    }
}
