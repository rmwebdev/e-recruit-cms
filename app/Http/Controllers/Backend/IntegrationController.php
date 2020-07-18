<?php

namespace App\Http\Controllers\Backend;;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
// use Yajra\Datatables\Datatables;

// use Auth;
// use Validator;
// use DB;
// use GuzzleHttp;
use Log;
// use DOMDocument;
// use file_get_html;
// use Session;
// use Firebase\JWT\JWT;

// use Illuminate\Support\Facades\Mail;
// use App\Mail\SendEmailProcess;
// use App\Mail\SendEmailFailedProcess;
// use App\Mail\SendEmailApproved;
// use App\Mail\SendConfirmationAttending;
// use App\Mail\SendEmailToCandidate;

use App\Models\Candidate;
// use App\Models\JobFptk;
// use App\Models\Parameters;
// use App\Models\User;
// use App\Models\TrHistoryProcess;

use GuzzleHttp as GuzzleHttp;


class IntegrationController extends Controller
{

	public function postUserToPsikonogram ($request)
	{
		Log::channel('integration_psikonogram')->info('IntegrationController.postUserToPsikonogram => begin');

		try {
			if (isset($request['candidate_id'])) {
				if ($request['candidate_id']!=null||$request['candidate_id']!='') {
					$candidates = new Candidate;
					$candidate = $candidates->where('candidate_id',$request['candidate_id'])->whereNull('status_user')->take(1)->get();

					if (count($candidate)>0) {
						$client = new GuzzleHttp\Client([
					        'headers'=>['Content-type'=>'application/json'],
					        'auth' => ['ws_erec', '3reC!!!'],
					        'http_errors'=>false
					    ]);

					    $url='https://middleware.puninar.com:9091/services-post-erec-to-psikonogram';
					    $array_content=[
					        'data_type'=>'invited',
					        'data_detail'=>$candidate[0],
					        'data_source'=>[
					            'system'=>'erec_registration_invitation',
					            'env'=>'dev'
					        ]
					    ];

					    $json_content=json_encode($array_content);
					    $res = $client->post($url, ['body'=>$json_content]);
					    $response = json_decode($res->getBody());

					    Log::channel('integration_psikonogram')->info('IntegrationController.postUserToPsikonogram => response');
					    Log::channel('integration_psikonogram')->info( json_decode(json_encode($response),1) );

					    $resp = json_decode(json_encode($response),1);
					    if (isset($resp['stat'])&&isset($resp['msg'])) {
					    	if ($resp['stat']==1&&$resp['msg']=='success') {
					    		$candidate_update = $candidates->where('candidate_id',$request['candidate_id'])
					    		->update([
					    			'status_user'=>'REGISTERED_ON_PSYCHOTEST'
					    		]);
					    	}
					    }

					    return 1;
					} else {
						Log::channel('integration_psikonogram')->info('IntegrationController.postUserToPsikonogram => candidate not found');
						return 2;
					}
				} else {
					return 2;
				}
			} else {
				return 2;
			}
		} catch (Exception $e) {
			Log::channel('integration_psikonogram')->info('IntegrationController.postUserToPsikonogram => exception');
			Log::channel('integration_psikonogram')->info($e->getMessage());

			return 2;
		}


		
	}

}