<?php $county_id = $this -> session -> userdata('county_id');?>
<?php
		
		?>		
<div id="dialog"></div>
	<div class="alert alert-info" >
  <b>Below is the project status in the county</b>
</div>
	 <div id="temp"></div>
	<?php echo $data ?>
	<div>
	
	<div id="container"  style="height:60%; width: 50%; margin: 0 auto; float: left">
	</div>
	<div id="container_monthly"  style="height:60%; width: 50%; margin: 0 auto;float: left"></div>	
	</div>
<script>
$(document).ready(function() {
	<?php echo @$graph_data_daily; ?>
	<?php echo @$graph_data_monthly; ?>
	
	$(".ajax_call").click( function (){
		
		$('.modal-dialog').addClass("modal-lg");
		var body_content='<table class="row-fluid table table-hover table-bordered table-update" width="100%">'+
		'<thead><tr><th>District Name</th><th>MFL No</th><th>Facility Name</th><th>Date Activated</th></tr></thead>'+
		'<tbody>'+			   	    
		'<?php	foreach($get_facility_data as $detail):
			     $facility_district = $detail['district'];
				 $facility_code = $detail['facility_code'];							
				 $facility_name = $detail['facility_name'];
				 $facility_activation_date = $detail['date'];
				 ;?>'+'<tr><td>'+'<?php echo $facility_district ;?>'+'</td>'
				 +'<td>'+'<?php echo $facility_code ;?>'+'</td>'
				 +'<td>'+'<?php echo $facility_name ;?>'+'</td>'
				 +'<td>'+'<?php echo $facility_activation_date ;?>'+'</td>'
				 +'</td></tr>'+'<?php endforeach;?>'
				 +'</tbody></table>';
        //hcmp custom message dialog
    dialog_box(body_content,'<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
    $('#communication_dialog').on('hidden.bs.modal', function (e) {  $('.modal-dialog').removeClass("modal-lg");
    $('.modal-body').html(''); refreshDatePickers();	})    
   
    });
	});
</script>
