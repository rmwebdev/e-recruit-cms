<table border="1">
    <thead>
    <tr>
        <th>JOB NUMBER</th>
        <th>POSITION NAME</th>
        <th>GOLONGAN</th>
        <th>RECRUITMENT TYPE</th>
        <th>RECEIVED DATE</th>
        <th>REQUIRED DATE</th>
        <th>REQUESTED STAFF</th>
        <th>EMPLOYMENT TYPE</th>
        <th>HIRED</th>
        <th>WORK LOCATION</th>
    </tr>
    </thead>
    <tbody>
    @foreach($dataExport as $export)
    <tr>
    	<td>{{$export->request_job_number}}</td>
    	<td>{{$export->position_name}}</td>
    	<td>{{$export->golongan}}</td>
    	<td>{{$export->recruitment_type}}</td>
    	<td>{{$export->received_date_fptk}}</td>
    	<td>{{$export->required_date_fptk}}</td>
    	<td>{{$export->requested_staff}}</td>
    	<td>{{$export->employment_type}}</td>
    	<td>{{$export->hired}}</td>
    	<td>{{$export->work_location}}</td>
    </tr>
    @endforeach
    </tbody>
</table>