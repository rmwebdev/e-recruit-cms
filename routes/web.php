<?php
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/','Auth\LoginController@index');


Route::get('/getDataJobRegis','Backend\JobRegisController@getData')->name('getDataJobRegis');
Route::get('/getDataRecProcess','Backend\RecProcessController@getData')->name('getDataRecProcess');


Route::group(['namespace' => 'Frontend','middleware'=>'web'], function()
{ 
	Route::get('/search-user-fptk','SearchFptkController@searchFPTK')->name('searchFPTK');
	Route::get('/home','FrontendController@index')->name('home');
	Route::get('/detail-job','FrontendController@detail_job')->name('detail_job');
	Route::post('/search-user-fptk/getData','SearchFptkController@getData')->name('search-user-fptk.getData');
	Route::post('/search-user-fptk/getDataWithStatus','SearchFptkController@getDataWithStatus')->name('search-user-fptk.getDataWithStatus');

    Route::get('/','FrontendController@index')->name('frontend.index');
    Route::post('/emailCheck','FrontendController@emailCheck')->name('frontend.emailCheck');
    Route::post('/sendEmailForgot','FrontendController@sendEmailForgot')->name('frontend.sendEmailForgot');
    Route::post('/regisCandidate','FrontendController@regisCandidate')->name('frontend.regisCandidate');
    Route::post('/actionForgotPassword','FrontendController@actionForgotPassword')->name('frontend.actionForgotPassword');
    Route::get('/formForgotPassword/{id}','FrontendController@formForgotPassword')->name('frontend.formForgotPassword');
    Route::post('/loginCandidate','FrontendController@loginCandidate')->name('frontend.loginCandidate');
    Route::post('/saveJob','FrontendController@saveJob')->name('frontend.saveJob');
    Route::get('/getDescJob','FrontendController@getDescJob')->name('frontend.getDescJob');
    Route::get('/logout','FrontendController@logout')->name('frontend.logout');
    Route::get('/sendEmailToCandidate','FrontendController@sendEmailToCandidate')->name('frontend.sendEmailToCandidate');
    Route::get('/refreshCaptcha','FrontendController@refreshCaptcha')->name('frontend.refreshCaptcha');
    Route::get('/activatedAccount','FrontendController@activatedAccount')->name('frontend.activatedAccount');
    Route::get('/confirmationEmail','FrontendController@confirmationEmail')->name('frontend.confirmationEmail');
    Route::get('/cek_ktp/frontend','FrontendController@cek_ktp')->name('frontend.cek_ktp');
    Route::get('/qr-code','FrontendController@qr_code')->name('frontend.qr-code');
    Route::get('/scan-qr-code','FrontendController@scan_qr_code')->name('frontend.scan-qr-code');
    Route::get('/action-scan-qr-code','FrontendController@action_scan_qr_code')->name('frontend.action-qr-code');
    Route::get('/close_warning','FrontendController@close_warning')->name('frontend.close_warning');



    Route::get('/qr_code_suci','FrontendController@qr_code_suci')->name('frontend.qr_code_suci');
    Route::get('/to_other_url','FrontendController@to_other_url')->name('frontend.to_other_url');
    Route::post('/qr_action_suci','FrontendController@qr_action_suci')->name('frontend.qr_action_suci');

});


Route::group(['namespace' => 'Frontend','name'=>'candidate-regis','middleware'=>'frontend'], function()
{ 
	
	Route::get('/form-candidate','FormCandidateController@create')->name('form-candidate.create');
	Route::post('/form-candidate/update','FormCandidateController@update')->name('form-candidate.update');
	Route::get('/form-candidate/confirmation','FormCandidateController@confirmation')->name('form-candidate.confirmation');
	Route::post('/form-candidate/actionConfirmation','FormCandidateController@actionConfirmation')->name('form-candidate.actionConfirmation');
	Route::post('/form-candidate/saveReschedule','FormCandidateController@saveReschedule')->name('form-candidate.saveReschedule');
	Route::post('/form-complete/formAssessment','FormCompleteController@formAssessment')->name('form-complete.formAssessment');

	Route::get('/form-complete','FormCompleteController@index')->name('form-complete');
	Route::post('/form-complete/store','FormCompleteController@store')->name('form-complete.store');
	Route::get('/form-complete/familyInfo','FormCompleteController@familyInfo')->name('form-complete.familyInfo');
	Route::get('/form-complete/orgInfo','FormCompleteController@orgInfo')->name('form-complete.orgInfo');
	Route::get('/form-complete/personalInfo','FormCompleteController@personalInfo')->name('form-complete.personalInfo');
	Route::get('/form-complete/courseInfo','FormCompleteController@courseInfo')->name('form-complete.courseInfo');
	Route::get('/form-complete/langSkill','FormCompleteController@langSkill')->name('form-complete.langSkill');
	Route::get('/form-complete/eduBack','FormCompleteController@eduBack')->name('form-complete.eduBack');
	Route::get('/form-complete/jobExp','FormCompleteController@jobExp')->name('form-complete.jobExp');
	Route::get('/form-complete/other','FormCompleteController@other')->name('form-complete.other');
	Route::post('/form-complete/saveFamily','FormCompleteController@saveFamily')->name('form-complete.saveFamily');
	Route::post('/form-complete/saveOrgInfo','FormCompleteController@saveOrgInfo')->name('form-complete.saveOrgInfo');
	Route::post('/form-complete/saveCourse','FormCompleteController@saveCourse')->name('form-complete.saveCourse');
	Route::post('/form-complete/saveJobInterest','FormCompleteController@saveJobInterest')->name('form-complete.saveJobInterest');
	Route::post('/form-complete/saveLangSkill','FormCompleteController@saveLangSkill')->name('form-complete.saveLangSkill');
	Route::post('/form-complete/saveEmergencyContact','FormCompleteController@saveEmergencyContact')->name('form-complete.saveEmergencyContact');
	
	Route::post('/form-complete/saveEduBack','FormCompleteController@saveEduBack')->name('form-complete.saveEduBack');
	Route::post('/form-complete/saveJobExp','FormCompleteController@saveJobExp')->name('form-complete.saveJobExp');
	Route::post('/form-complete/saveSkill','FormCompleteController@saveSkill')->name('form-complete.saveSkill');
	Route::post('/form-complete/updateJobExp','FormCompleteController@updateJobExp')->name('form-complete.updateJobExp');
	Route::post('/form-complete/updateFamily','FormCompleteController@updateFamily')->name('form-complete.updateFamily');
	Route::post('/form-complete/updateOrgInfo','FormCompleteController@updateOrgInfo')->name('form-complete.updateOrgInfo');
	Route::post('/form-complete/updateEmergencyContact','FormCompleteController@updateEmergencyContact')->name('form-complete.updateEmergencyContact');
	Route::post('/form-complete/updateCourse','FormCompleteController@updateCourse')->name('form-complete.updateCourse');
	Route::post('/form-complete/updateLangSkill','FormCompleteController@updateLangSkill')->name('form-complete.updateLangSkill');
	Route::post('/form-complete/updateJobInterest','FormCompleteController@updateJobInterest')->name('form-complete.updateJobInterest');
	Route::post('/form-complete/updateEduBack','FormCompleteController@updateEduBack')->name('form-complete.updateEduBack');
	Route::post('/form-complete/updateJobExp','FormCompleteController@updateJobExp')->name('form-complete.updateJobExp');
	Route::post('/form-complete/updateSkill','FormCompleteController@updateSkill')->name('form-complete.updateSkill');
	Route::delete('/form-complete/deleteFamily/{id}','FormCompleteController@deleteFamily');
	Route::delete('/form-complete/deleteCourse/{id}','FormCompleteController@deleteCourse');
	Route::delete('/form-complete/deleteEmergencyContact/{id}','FormCompleteController@deleteEmergencyContact');
	Route::delete('/form-complete/deleteLangSkill/{id}','FormCompleteController@deleteLangSkill');
	Route::delete('/form-complete/deleteOrganization/{id}','FormCompleteController@deleteOrganization');
	Route::delete('/form-complete/deleteEduBack/{id}','FormCompleteController@deleteEduBack');
	Route::delete('/form-complete/deleteJobExp/{id}','FormCompleteController@deleteJobExp');
	Route::delete('/form-complete/deleteSkill/{id}','FormCompleteController@deleteSkill');
	Route::delete('/form-complete/deleteJobInterest/{id}','FormCompleteController@deleteJobInterest');
	Route::post('/form-complete/getDropDownFamily','FormCompleteController@getDropDownFamily')->name('form-complete.getDropDownFamily');

	Route::post('/form-complete/getDropDownSkill','FormCompleteController@getDropDownSkill')->name('form-complete.getDropDownSkill');
	Route::post('/form-complete/changePhoto','FormCompleteController@changePhoto')->name('form-complete.changePhoto');
	Route::post('/form-complete/changeCV','FormCompleteController@changeCV')->name('form-complete.changeCV');

	Route::post('/form-complete/getDropJob','FormCompleteController@getDropJob')->name('form-complete.getDropJob');
	Route::post('/form-complete/fetch','FormCompleteController@fetch')->name('form-complete.fetch');
	Route::get('/form-complete/refreshAlert','FormCompleteController@refreshAlert')->name('form-complete.refreshAlert');
	
	Route::post('/form-complete/getDropDownEducation','FormCompleteController@getDropDownEducation')->name('form-complete.getDropDownEducation');
});



Auth::routes();


Route::group(['namespace' => 'Backend',['middleware'=>'permission:read-regis|delete-regis|update-regis|create-regis|create-employee-outsource|update-employee-outsource|read-employee-outsource|delete-employee-outsource']], function()
{ 
Route::get('/candidate-regis','CandidateRegisController@index')->name('candidate-regis');
Route::get('/candidate-regis-reg','CandidateRegisController@index_reg')->name('candidate-regis-reg');
Route::get('/candidate-regis/create','CandidateRegisController@create')->name('candidate-regis.create');
Route::post('/candidate-regis/save','CandidateRegisController@save')->name('candidate-regis.save');
Route::get('/candidate-regis/create_candidate','CandidateRegisController@create_candidate')->name('candidate-regis.create_candidate');
Route::post('/candidate-regis/emailCheck','CandidateRegisController@emailCheck')->name('candidate-regis.emailCheck');
Route::get('/candidate-regis/edit/{id}','CandidateRegisController@edit')->name('candidate-regis.edit');
Route::get('/candidate-regis/return_candidate/{id}','CandidateRegisController@return_candidate')->name('candidate-regis.return_candidate');
Route::post('/candidate-regis/update/','CandidateRegisController@update')->name('candidate-regis.update');
Route::post('/candidate-regis/update-candidate-outsource/','CandidateRegisController@update_candidate_outsource')->name('candidate-regis.update-candidate-outsource');
Route::get('/candidate-regis/show/{id}','CandidateRegisController@show')->name('candidate-regis.show');
Route::post('/candidate-regis/uploadCandidate/','CandidateRegisController@uploadCandidate')->name('candidate-regis.uploadCandidate');
Route::post('/getData','CandidateRegisController@getData')->name('candidate-regis.getData');
Route::post('/candidate_regis','CandidateRegisController@candidate_regis')->name('candidate-regis.candidate_regis');
Route::get('/candidate-regis/detail_candidate/{id}','CandidateRegisController@detail_candidate')->name('candidate-regis.detail_candidate');
Route::get('/candidate-regis/form_return_candidate','CandidateRegisController@form_return_candidate')->name('candidate-regis.form_return_candidate');
Route::get('/candidate-regis/get_employee','CandidateRegisController@get_employee')->name('candidate-regis.get_employee');
Route::post('/update_return_employee','CandidateRegisController@update_return_employee')->name('candidate-regis.update_return_employee');
Route::post('/approved_return_employee','CandidateRegisController@approved_return_employee')->name('candidate-regis.approved_return_employee');

	//Tambahan dendy 20.12.2019
	Route::get('/assessment-candidate-regis/{id}','CandidateRegisController@assessment_candidate_regis')->name('assessment-candidate-regis');
	Route::get('/candidate-regis/delete/{id}','CandidateRegisController@delete_candidate')->name('candidate-regis.delete');
	Route::post('/candidate-regis/delete-candidate-outsource/','CandidateRegisController@delete_candidate_outsource')->name('candidate-regis.delete-candidate-outsource');
});


Route::group(['namespace' => 'Backend',['middleware' => 'permission:create-fptk-outsource|read-fptk-outsource|update-fptk-outsource|delete-fptk-outsource']], function()
{ 
	Route::get('/create-fptk-outsource','FptkOutSourceController@index')->name('create-fptk-outsource');
	Route::get('/create-candidate-outsource','FptkOutSourceController@create_candidate_outsource')->name('create-candidate-outsource');
	Route::get('/add-fptk-resource','FptkOutSourceController@add_fptk_resource')->name('add-fptk-resource');
	Route::post('/save-fptk-outsource','FptkOutSourceController@save_fptk_outsource')->name('save-fptk-outsource');
	Route::post('/save-fptk-outsource-submission','FptkOutSourceController@save_fptk_outsource_submission')->name('save-fptk-outsource-submission');
	Route::get('/edit-fptk-outsource/{id}','FptkOutSourceController@edit_fptk_outsource')->name('edit-fptk-outsource');
	Route::get('/delete-fptk-outsource/{id}','FptkOutSourceController@delete_fptk_outsource')->name('delete-fptk-outsource');
	Route::post('/update-fptk-outsource','FptkOutSourceController@update_fptk_outsource')->name('update-fptk-outsource');
	Route::get('/approved-fptk-outsource','FptkOutSourceController@approved_fptk_outsource')->name('approved-fptk-outsource');
	Route::get('/get-req','FptkOutSourceController@get_req')->name('get-req');
	Route::post('/update-fptk','FptkOutSourceController@update_fptk')->name('update-fptk');
	Route::post('/get-fptk-outsource','FptkOutSourceController@get_fptk_outsource')->name('get-fptk-outsource');

	//Tambahan dendy 16.12.2019
	Route::get('/view-fptk-outsource-candidate','FptkOutSourceController@view_fptk_outsource_candidate')->name('view-fptk-outsource-candidate');
	Route::get('/view-histori-fptk-outsource-candidate','FptkOutSourceController@view_histori_fptk_outsource_candidate')->name('view-histori-fptk-outsource-candidate');
	Route::get('/assessment-fptk-outsource/{id}','FptkOutSourceController@assessment_fptk_outsource')->name('assessment-fptk-outsource');
});


Route::group(['namespace' => 'Backend','name'=>'candidate-final'], function()
{ 
Route::get('/candidate-final/{id}','CandidateFinalController@index')->name('candidate-final');
Route::get('/candidate-final-add','CandidateFinalController@add')->name('candidate-final.add');
Route::post('/candidate-final/store','CandidateFinalController@store')->name('candidate-final.store');
Route::get('/candidate-final/familyInfo/{id}','CandidateFinalController@familyInfo')->name('candidate-final.familyInfo');
Route::get('/candidate-final/orgInfo/{id}','CandidateFinalController@orgInfo')->name('candidate-final.orgInfo');
Route::get('/candidate-final/personalInfo/{id}','CandidateFinalController@personalInfo')->name('candidate-final.personalInfo');
Route::get('/candidate-final/courseInfo/{id}','CandidateFinalController@courseInfo')->name('candidate-final.courseInfo');
Route::get('/candidate-final/langSkill/{id}','CandidateFinalController@langSkill')->name('candidate-final.langSkill');
Route::get('/candidate-final/eduBack/{id}','CandidateFinalController@eduBack')->name('candidate-final.eduBack');
Route::get('/candidate-final/jobExp/{id}','CandidateFinalController@jobExp')->name('candidate-final.jobExp');
Route::get('/candidate-final/other/{id}','CandidateFinalController@other')->name('candidate-final.other');
Route::post('/candidate-final/saveFamily','CandidateFinalController@saveFamily')->name('candidate-final.saveFamily');
Route::post('/candidate-final/saveEmergencyContact','CandidateFinalController@saveEmergencyContact')->name('candidate-final.saveEmergencyContact');
Route::post('/candidate-final/saveOrgInfo','CandidateFinalController@saveOrgInfo')->name('candidate-final.saveOrgInfo');
Route::post('/candidate-final/saveCourse','CandidateFinalController@saveCourse')->name('candidate-final.saveCourse');
Route::post('/candidate-final/saveLangSkill','CandidateFinalController@saveLangSkill')->name('candidate-final.saveLangSkill');
Route::post('/candidate-final/saveEduBack','CandidateFinalController@saveEduBack')->name('candidate-final.saveEduBack');
Route::post('/candidate-final/saveJobExp','CandidateFinalController@saveJobExp')->name('candidate-final.saveJobExp');
Route::post('/candidate-final/saveJobInterest','CandidateFinalController@saveJobInterest')->name('candidate-final.saveJobInterest');
Route::post('/candidate-final/saveSkill','CandidateFinalController@saveSkill')->name('candidate-final.saveSkill');



/* for add in admin candidate  */
Route::post('/candidate-final-add/save_candidate','CandidateFinalController@save_candidate')->name('candidate-final-add.save_candidate');
Route::get('/candidate-final-add/familyInfo','CandidateFinalController@addfamilyInfo')->name('candidate-final-add.addfamilyInfo');
Route::get('/candidate-final-add/orgInfo','CandidateFinalController@orgInfo')->name('candidate-final-add.orgInfo');
Route::get('/candidate-final-add/personalInfo','CandidateFinalController@addPersonalInfo')->name('candidate-final-add.personalInfo');
Route::get('/candidate-final-add/courseInfo','CandidateFinalController@courseInfo')->name('candidate-final-add.courseInfo');
Route::get('/candidate-final-add/langSkill','CandidateFinalController@langSkill')->name('candidate-final-add.langSkill');
Route::get('/candidate-final-add/eduBack','CandidateFinalController@eduBack')->name('candidate-final-add.eduBack');
Route::get('/candidate-final-add/jobExp','CandidateFinalController@jobExp')->name('candidate-final-add.jobExp');
Route::get('/candidate-final-add/other','CandidateFinalController@other')->name('candidate-final-add.other');
Route::post('/candidate-final-add/saveFamily','CandidateFinalController@saveFamily')->name('candidate-final-add.saveFamily');
Route::post('/candidate-final-add/saveEmergencyContact','CandidateFinalController@saveEmergencyContact')->name('candidate-final-add.saveEmergencyContact');
Route::post('/candidate-final-add/saveOrgInfo','CandidateFinalController@saveOrgInfo')->name('candidate-final-add.saveOrgInfo');
Route::post('/candidate-final-add/saveCourse','CandidateFinalController@saveCourse')->name('candidate-final-add.saveCourse');
Route::post('/candidate-final-add/saveLangSkill','CandidateFinalController@saveLangSkill')->name('candidate-final-add.saveLangSkill');
Route::post('/candidate-final-add/saveEduBack','CandidateFinalController@saveEduBack')->name('candidate-final-add.saveEduBack');
Route::post('/candidate-final-add/saveJobExp','CandidateFinalController@saveJobExp')->name('candidate-final-add.saveJobExp');
Route::post('/candidate-final-add/saveJobInterest','CandidateFinalController@saveJobInterest')->name('candidate-final-add.saveJobInterest');
Route::post('/candidate-final-add/saveSkill','CandidateFinalController@saveSkill')->name('candidate-final-add.saveSkill');
Route::post('/candidate-final-add/getDropDownFamily','CandidateFinalController@getDropDownFamily')->name('candidate-final-add.getDropDownFamily');


Route::post('/candidate-final-add/updateJobExp','CandidateFinalController@updateJobExp')->name('candidate-final-add.updateJobExp');
Route::post('/candidate-final-add/updateFamily','CandidateFinalController@updateFamily')->name('candidate-final-add.updateFamily');
Route::post('/candidate-final-add/updateOrgInfo','CandidateFinalController@updateOrgInfo')->name('candidate-final-add.updateOrgInfo');
Route::post('/candidate-final-add/updateCourse','CandidateFinalController@updateCourse')->name('candidate-final-add.updateCourse');
Route::post('/candidate-final-add/updateLangSkill','CandidateFinalController@updateLangSkill')->name('candidate-final-add.updateLangSkill');
Route::post('/candidate-final-add/updateEduBack','CandidateFinalController@updateEduBack')->name('candidate-final-add.updateEduBack');
Route::post('/candidate-final-add/updateJobInterest','CandidateFinalController@updateJobInterest')->name('candidate-final-add.updateJobInterest');
Route::post('/candidate-final-add/updateSkill','CandidateFinalController@updateSkill')->name('candidate-final-add.updateSkill');
Route::post('/candidate-final-add/updateEmergencyContact','CandidateFinalController@updateEmergencyContact')->name('candidate-final-add.updateEmergencyContact');


Route::post('/candidate-final-add/changePhoto','CandidateFinalController@changePhoto')->name('candidate-final-add.changePhoto');
Route::post('/candidate-final-add/changeCV','CandidateFinalController@changeCV')->name('candidate-final-add.changeCV');
Route::delete('/candidate-final-add/deleteFamily/{id}','CandidateFinalController@deleteFamily');
Route::delete('/candidate-final-add/deleteCourse/{id}','CandidateFinalController@deleteCourse');
Route::delete('/candidate-final-add/deleteLangSkill/{id}','CandidateFinalController@deleteLangSkill');
Route::delete('/candidate-final-add/deleteOrganization/{id}','CandidateFinalController@deleteOrganization');
Route::delete('/candidate-final-add/deleteEduBack/{id}','CandidateFinalController@deleteEduBack');
Route::delete('/candidate-final-add/deleteJobExp/{id}','CandidateFinalController@deleteJobExp');
Route::delete('/candidate-final-add/deleteJobInterest/{id}','CandidateFinalController@deleteJobInterest');
Route::delete('/candidate-final-add/deleteSkill/{id}','CandidateFinalController@deleteSkill');
Route::delete('/candidate-final-add/deleteEmergencyContact/{id}','CandidateFinalController@deleteEmergencyContact');




Route::post('/candidate-final-add/getDropDownEducation','CandidateFinalController@getDropDownEducation')->name('candidate-final-add.getDropDownEducation');
Route::post('/candidate-final-add/getDropDownSkill','CandidateFinalController@getDropDownSkill')->name('candidate-final-add.getDropDownSkill');
Route::post('/candidate-final-add/getDropJob','CandidateFinalController@getDropJob')->name('candidate-final-add.getDropJob');
Route::post('/candidate-final-add/fetch','CandidateFinalController@fetch')->name('candidate-final-add.fetch');

/* end add candidate */


Route::post('/candidate-final/updateJobExp','CandidateFinalController@updateJobExp')->name('candidate-final.updateJobExp');
Route::post('/candidate-final/updateFamily','CandidateFinalController@updateFamily')->name('candidate-final.updateFamily');
Route::post('/candidate-final/updateOrgInfo','CandidateFinalController@updateOrgInfo')->name('candidate-final.updateOrgInfo');
Route::post('/candidate-final/updateCourse','CandidateFinalController@updateCourse')->name('candidate-final.updateCourse');
Route::post('/candidate-final/updateLangSkill','CandidateFinalController@updateLangSkill')->name('candidate-final.updateLangSkill');
Route::post('/candidate-final/updateEduBack','CandidateFinalController@updateEduBack')->name('candidate-final.updateEduBack');
Route::post('/candidate-final/updateJobInterest','CandidateFinalController@updateJobInterest')->name('candidate-final.updateJobInterest');
Route::post('/candidate-final/updateSkill','CandidateFinalController@updateSkill')->name('candidate-final.updateSkill');
Route::post('/candidate-final/updateEmergencyContact','CandidateFinalController@updateEmergencyContact')->name('candidate-final.updateEmergencyContact');
Route::post('/candidate-final/changePhoto','CandidateFinalController@changePhoto')->name('candidate-final.changePhoto');
Route::post('/candidate-final/changeCV','CandidateFinalController@changeCV')->name('candidate-final.changeCV');
Route::delete('/candidate-final/deleteFamily/{id}','CandidateFinalController@deleteFamily');
Route::delete('/candidate-final/deleteCourse/{id}','CandidateFinalController@deleteCourse');
Route::delete('/candidate-final/deleteLangSkill/{id}','CandidateFinalController@deleteLangSkill');
Route::delete('/candidate-final/deleteOrganization/{id}','CandidateFinalController@deleteOrganization');
Route::delete('/candidate-final/deleteEduBack/{id}','CandidateFinalController@deleteEduBack');
Route::delete('/candidate-final/deleteJobExp/{id}','CandidateFinalController@deleteJobExp');
Route::delete('/candidate-final/deleteJobInterest/{id}','CandidateFinalController@deleteJobInterest');
Route::delete('/candidate-final/deleteSkill/{id}','CandidateFinalController@deleteSkill');
Route::delete('/candidate-final/deleteEmergencyContact/{id}','CandidateFinalController@deleteEmergencyContact');

Route::post('/candidate-final/getDropDownFamily','CandidateFinalController@getDropDownFamily')->name('candidate-final.getDropDownFamily');
Route::get('/candidate-final/cek_ktp/backend','CandidateFinalController@cek_ktp')->name('backend.cek_ktp');

Route::post('/candidate-final/getDropDownEducation','CandidateFinalController@getDropDownEducation')->name('candidate-final.getDropDownEducation');
Route::post('/candidate-final/getDropDownSkill','CandidateFinalController@getDropDownSkill')->name('candidate-final.getDropDownSkill');
Route::post('/candidate-final/getDropJob','CandidateFinalController@getDropJob')->name('candidate-final.getDropJob');
Route::post('/candidate-final/fetch','CandidateFinalController@fetch')->name('candidate-final.fetch');


});


Route::group(['namespace' => 'Backend',['middleware'=>'create-rec-dashboard|read-rec-dashboard|update-rec-dashboard|delete-rec-dashboard|invited-candidate'] ], function()
{ 
Route::get('/rec-process','RecProcessController@index')->name('rec-process');
Route::get('/detail-rec-process','RecProcessController@detail_rec_process')->name('detail-rec-process');
Route::post('/rec-process/getData','RecProcessController@getData')->name('rec-process.getData');
Route::get('/rec-process/getDataWithStatus','RecProcessController@getDataWithStatus')->name('rec-process.getDataWithStatus');
Route::get('/rec-process/edit_rec_process/{id}','RecProcessController@edit_rec_process')->name('rec-process.edit_rec_process');
Route::post('/rec-process/updateStatus','RecProcessController@updateStatus')->name('rec-process.updateStatus');
Route::post('/rec-process/updateRecProcessStatus','RecProcessController@updateRecProcessStatus')->name('rec-process.updateRecProcessStatus');
Route::post('/rec-process/updateRecProcessEmail','RecProcessController@updateRecProcessEmail')->name('rec-process.updateRecProcessEmail');
Route::post('/rec-process/sendEmailMass','RecProcessController@sendEmailMass')->name('rec-process.sendEmailMass');
Route::post('/rec-process/inputReason','RecProcessController@inputReason')->name('rec-process.inputReason');
Route::get('/rec-process/get_result_process/{id}','RecProcessController@get_result_process')->name('rec-process.get_result_process');
Route::post('/rec-process/showNotification','RecProcessController@showNotification')->name('rec-process.showNotification');
Route::post('/rec-process/send_reschedule','RecProcessController@send_reschedule')->name('rec-process.send_reschedule');
Route::post('/rec-process/send_decline','RecProcessController@send_decline')->name('rec-process.send_decline');
Route::get('/rec-process/get_history_psychotest','RecProcessController@get_history_psychotest')->name('rec-process.get_history_psychotest');
Route::post('/rec-process/changeCV','RecProcessController@changeCV_baru')->name('rec-process.changeCV_baru');


Route::get('/rec-process/view_all','RecProcessController@view_all')->name('rec-process.view_all');
Route::get('/calender','RecProcessController@calender')->name('rec-process.calender');


});


Route::group(['namespace' => 'Backend',['middleware'=>'permission:create-job-regis|read-job-regis|update-job-regis|delete-job-regis'] ], function()
{ 
	Route::get('/job-regis','JobRegisController@index')->name('job-regis');
	Route::post('/job-regis/getData','JobRegisController@getData')->name('job-regis.getData');
	Route::post('/job-regis/updateJobRegis','JobRegisController@updateJobRegis')->name('job-regis.updateJobRegis');
	Route::get('/job-regis/edit_job_regis/{id}','JobRegisController@edit_job_regis')->name('job-regis.edit_job_regis');
	Route::post('/job-regis/GetStatus','JobRegisController@GetStatus')->name('job-regis.GetStatus');
	
	Route::post('/job-regis/getCanSLAJoin','JobRegisController@getCanSLAJoin')->name('job-regis.getCanSLAJoin');
	Route::post('/job-regis/getCanSLA','JobRegisController@getCanSLA')->name('job-regis.getCanSLA');
});

Route::group(['namespace' => 'Backend',['middleware'=>'permission:create-user|update-user|delete-user|read-user|create-role|update-role|delete-role|read-role|create-permission|read-permission|update-permission|delete-permission|create-menu|read-menu|update-menu|delete-menu']], function()
{ 
	Route::get('/setting-role','SettingController@index')->name('setting-role');
	Route::get('/setting-menu','SettingController@index_menu')->name('setting-menu');


	Route::get('/setting-role/destroy/{id}','SettingController@destroy')->name('setting-role');
	Route::post('/setting-role/store','SettingController@store')->name('setting-role.store-role');
	Route::get('/setting-role/edit/{id}','SettingController@edit')->name('setting-role.edit');	


	Route::get('/setting-menu/destroy/{id}','SettingController@destroy_menu')->name('setting-menu');

	Route::get('/setting-user/destroy/{id}','SettingController@destroy_user')->name('setting-user');
	Route::get('/setting-user/edit_user/{id}','SettingController@edit_user')->name('setting-user.edit_user');
	Route::post('/setting-user/update_user/{id}','SettingController@update_user')->name('setting-user.update_user');
	Route::post('/setting-user/save_role','SettingController@save_role')->name('setting-user.save_role');


	Route::post('/setting-menu/store','SettingController@store_menu')->name('setting-menu.store-menu');
	Route::get('/setting-menu/edit/{id}','SettingController@edit_menu')->name('setting-menu.edit');	


	Route::get('/add-user','SettingController@add_user')->name('setting.add-user');
	Route::post('/setting-user/store','SettingController@store_user')->name('setting-user.store-user');


	Route::get('/setting-user/get_data_user','SettingController@get_data_user')->name('setting-user.get_data_user');




	Route::get('/setting-permission','SettingController@index_perm')->name('setting-permission');
	Route::get('/setting-permission/destroy_perm/{id}','SettingController@destroy_perm')->name('setting-permission');
	Route::post('/setting-permission/store_perm','SettingController@store_perm')->name('setting-permission.store');
	Route::get('/setting-permission/edit_perm/{id}','SettingController@edit_perm')->name('setting-permission.edit');


	Route::get('/role-permission/{id}','SettingController@role_permission')->name('setting-permission.role_permission');
	Route::post('/save-role-permission','SettingController@save_role_permission')->name('setting-permission.save_role_permission');
	// 
});


// Route::post('/new-login','Auth\LoginController@new_login')->name('new-login');


Route::group(['namespace' => 'Backend',['middleware'=>'permission:read-export|read-dashboard|setting-banner|view-absen
'] ], function()
{ 
	Route::get('/export-data','ExportDataController@index')->name('export-data');
	
	Route::get('/export-data/exportData','ExportDataController@exportData')->name('export-data.exportData');
	Route::get('/dashboard','DashboardController@index')->name('dashboard');
	Route::get('/dashboard-outsource','DashboardController@dashboard_outsource')->name('dashboard-outsource');
	Route::post('/dashboard/getData','DashboardController@getData')->name('dashboard.getData');
	Route::get('/dashboard/search_dashboard','DashboardController@search_dashboard')->name('dashboard.search_dashboard');
	Route::post('/dashboard/getDataWithStatus','DashboardController@getDataWithStatus')->name('dashboard.getDataWithStatus');
	Route::get('/search-fptk','DashboardController@searchFPTK')->name('dashboard.searchFPTK');

	Route::get('/index_user','SettingController@index_user')->name('setting.index_user');

	Route::get('/dashboard/absensi','DashboardController@absensi')->name('dashboard.absensi');
	Route::post('/dashboard/getDataAbsensi','DashboardController@getDataAbsensi')->name('dashboard.getDataAbsensi');
	Route::post('/dashboard/actionCreateUser','DashboardController@actionCreateUser')->name('dashboard.actionCreateUser');
	Route::post('/dashboard/action_change_password','DashboardController@action_change_password')->name('dashboard.action_change_password');
	Route::get('/dashboard/change_password','DashboardController@change_password')->name('dashboard.change_password');
	Route::get('/setting-banner','DashboardController@setting_banner')->name('dashboard.setting-banner');
	Route::post('/action-setting-banner','DashboardController@action_setting_banner')->name('dashboard.action-setting-banner');
	Route::delete('/delete-setting-banner/{id}','DashboardController@delete_setting_banner')->name('dashboard.delete-setting-banner');
	Route::get('/edit-setting-banner','DashboardController@edit_setting_banner')->name('dashboard.edit-setting-banner');


	// Tambahana Dendy 20.12.2019
	Route::get('/dashboard/absensiAll','DashboardController@absensiAll')->name('dashboard.absensiAll');
	Route::post('/dashboard/getDataAbsensiAll','DashboardController@getDataAbsensiAll')->name('dashboard.getDataAbsensiAll');
});