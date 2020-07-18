<script type="text/javascript">
	

$('.datepicker1').datepicker({uiLibrary: 'bootstrap4', format: 'yyyy-mm-dd'});
$('.datepicker2').datepicker({uiLibrary: 'bootstrap4', format: 'yyyy-mm-dd'});


$("#formExport").submit(function(event){

    event.preventDefault(); //prevent default action 
    var start = $('[name="cd_start"]').val();
    var end = $('[name="cd_end"]').val();
    var tipe = $('[name="itipe"]').val();

	if($('[name="cd_start"]').val() === "")
	{
		$('.cd_start').html('<strong>The  start date required</strong>');
		$('[name="cd_start"]').addClass('is-invalid');
        $('.cd_start').show();
		$('[name="cd_start"]').change(function(){
			$('[name="cd_start"]').removeClass('is-invalid');
            $('.cd_start').hide();
		})

		return false;
	}
	else if($('[name="cd_end"]').val() === "")
	{
    	$('.cd_end').html('<strong>The end daterequired</strong>');
    	$('[name="cd_end"]').addClass('is-invalid');
    	$('.cd_end').show();
    	$('[name="cd_end"]').change(function(){
			$('[name="cd_end"]').removeClass('is-invalid');
            $('.cd_end').hide();
		})
		return false;
    }
    else
    {

     	window.open('/export-data/exportData/?tipe='+tipe+'&start='+start+'&end='+end+'','_blank' );
    }
})
</script>