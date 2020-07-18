@component('mail::message')
Dear Bapak/Ibu <strong> {{$requester_name}} </strong>
<br>
<br>
Proses pemenuhan FPTK dengan nomor  <strong> {{strtoupper($request_job_number)}}</strong>   yang diterima oleh Tim Rekrutmen pada tanggal  {{$required_date_fptk}}  saat ini sudah di tahap  
<strong>{{$process}}

{{-- </strong> dengan status <strong>{{$result}}</strong>. --}}
<br>
<br>
Silahkan klik  {{url('search-user-fptk?searchFPTK='.$request_job_number.'')}}  untuk seluruh proses rekrutmen yang sudah dilakukan.
<br>
<br>
Salam Hangat,
<br>
Tim Human Capital Development Puninar
<br>

@endcomponent
