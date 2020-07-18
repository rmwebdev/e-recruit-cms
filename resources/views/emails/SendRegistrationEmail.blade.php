@component('mail::message')
Dear <b> {{$candidate}},</b>
<br>

Please click this button to activate your account.

@component('mail::button', ['url' => url('activatedAccount?result='.$password.'&id='.base64_encode($candidate_id).'')])
Click Here
@endcomponent

<b>Best Regards,</b><br>
Tim Human Capital Development Puninar
@endcomponent
