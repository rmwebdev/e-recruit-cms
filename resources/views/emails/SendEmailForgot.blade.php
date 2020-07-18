@component('mail::message')
Dear <strong>{{$name_holder}},</strong>
<br>
<br>
	Please click this button to reset your password.
<br>
<br>
@component('mail::button', ['url' => url('?candidate_id='.$candidate_id.'&key='.bcrypt($email)) ])
	Click Here
@endcomponent
<br>
<br>
<b>Best Regards,</b>
<br>
 Tim Human Capital Development Puninar
<br>
@endcomponent
