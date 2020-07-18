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
			$data_return['stat'] = 0;
			$data_return['msg'] = '';
			if (isset($request['candidate_id'])) {
				if ($request['candidate_id']!=null||$request['candidate_id']!='') {
					$candidates = new Candidate;
					$candidate = $candidates->where('candidate_id',$request['candidate_id'])
					->whereNull('status_user')
					->whereNull('status_contract')
					->take(1)
					->get();

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
					    	if ($resp['stat']==1) {
					    		$candidate_update = $candidates->where('candidate_id',$request['candidate_id'])
					    		->update([
					    			'status_user'=>'REGISTERED_ON_PSYCHOTEST'
					    		]);
					    		$data_return['stat'] = 1;
								$data_return['msg'] = $candidate[0]->email.' has been registered on psiko.puninar.com.';
					    	} elseif ($resp['stat']==2) {
					    		$data_return['stat'] = 2;
								$data_return['msg'] = $candidate[0]->email.' already exists on psiko.puninar.com.';
					    	} else {
					    		$data_return['stat'] = 2;
								$data_return['msg'] = 'Upss (XR01). Please contact Administrator.';
					    	}
					    } else {
					    	$data_return['stat'] = 3;
							$data_return['msg'] = 'Upss (XR02). Please contact Administrator.';
					    }
					} else {
						$data_return['stat'] = 3;
						$data_return['msg'] = 'candidate_id not found.';
					}
				} else {
					$data_return['stat'] = 3;
					$data_return['msg'] = 'candidate_id is not defined.';					
				}
			} else {
				$data_return['stat'] = 3;
				$data_return['msg'] = 'candidate_id is not set.';
			}
			Log::channel('integration_psikonogram')->info('IntegrationController.postUserToPsikonogram => data_return');
			Log::channel('integration_psikonogram')->info($data_return);

			// only stat (1,3) will be shown on alert front-end
			return json_encode($data_return);
		} catch (Exception $e) {
			Log::channel('integration_psikonogram')->info('IntegrationController.postUserToPsikonogram => exception');
			Log::channel('integration_psikonogram')->info($e->getMessage());
			$data_return['stat'] = 3;
			$data_return['msg'] = $e->getMessage();
			return json_encode($data_return);
		}


		
	}

}