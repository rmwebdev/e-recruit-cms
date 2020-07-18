<table border="1">
    <thead>
    	<tr>
	        <th>REQUEST JOB NUMBER</th>
	        <th>POSITION NAME</th>
	        <th>NAME</th>
	        <th>AGE(YEAR)</th>
	        <th>LATEST COMPANY</th>
	        <th>LATEST POSITION</th>
	        <th>TOTAL EXPERIENCE</th>
	        <th>MAJOR</th>
	        <th>IPK</th>
        </tr>
    </thead>
    <tbody>
    @foreach($dataExport as $export)
    <tr>
    	<td>{{$export->request_job_number}}</td>
    	<td>{{$export->position_name}}</td>
    	<td>{{$export->name_holder}}</td>
    	<td>{{$export->age}}</td>
    	<td>{{$export->exp_company}}</td>
    	<td>{{$export->exp_position}}</td>
    	<td>{{$export->exp_total_experience}}</td>
    	<td>{{$export->edu_major}}</td>
    	<td>{{$export->edu_ipk}}</td>
    </tr>
    @endforeach
    </tbody>
</table>