@component('mail::message')
<?php
	echo $msg;
?>
@component('mail::button', ['url' => url('confirmationEmail')])
Click Here
@endcomponent

@endcomponent
