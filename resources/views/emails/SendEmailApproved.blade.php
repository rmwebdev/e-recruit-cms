@component('mail::message')
Dear Bapak/Ibu <strong>{{$requester_name}}</strong>
<br>
<br>
Permintaan tenaga kerja dengan nomor <strong>{{strtoupper($request_job_number)}}</strong>  telah diterima oleh Tim Rekrutmen pada tanggal <strong>{{$required_date_fptk}}</strong>. Mohon memastikan Jobdesc dari posisi yang diminta sudah dikirimkan melalui email ke eva.siburian@puninar.com. Proses pencarian kandidat baru akan dilakukan tim rekrutmen setelah Jobdesc diterima.
<br>
<br>
Silahkan klik  {{url('search-user-fptk?searchFPTK='.$request_job_number.'')}} untuk mengetahui tahapan proses pemenuhan yang sudah dilakukan Tim Rekrutmen Puninar Logistics.
<br>
<br>
Silahkan hubungi PIC Rekrutmen untuk membantu Bapak/Ibu:
<br>
1. Aldi – WA: 0857-7749-7191
<br>
2. Ata – WA: 0857-1157-7257
<br>
<br>
Salam Hangat,
<br>
Tim Human Capital Development Puninar

@endcomponent
