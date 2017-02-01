
<?php //include('rca_sidabar.php');?>
<div class="" ="dash_main">

<div class="clc_contents">


		  <button id="btn_all_facilities" class=" btn btn-success">All Facilities</button>
	<div class="accordion-group">
		<div id="percentage_national" class="table_divs panel panel-success">
			  <div class="panel-heading accordion-heading " data-toggle="collapse" data-parent="#accordion2" href="#national_reports" style="font-size:13px;font-weight:bold" >BY REGION: <i>(Click to View)</i></div>
			  <div id="national_reports" class="accordion-body collapse">
				<div class="accordion-group inner_divs">	
			
			<!--by subcounty-->
				<div class="accordion-group inner_divs">
					<div id="percentage_national" class="table_divs panel panel-success">
						<div class="panel-heading accordion-heading " data-toggle="collapse" data-parent="#accordion2" href="#by_subcounty" style="font-size:13px;font-weight:bold" >BY SUB-COUNTY: <i>(Click to View)</i></div>
						<div id="by_subcounty" class="accordion-body collapse">
						<div class="accordion-inner inner_div_height">
						
						<select id="subcounty_select" class="form-control" style="width:15%;float:left;height:30px;font-size:12px;">
							<option value="0"> -- Select Sub-County--</option>							
						</select>&nbsp;&nbsp;&nbsp;
               			 <button type="button" id="btn_subcounty_select" class="btn btn-primary my_navs">Download Sub-County Report</button>
						  	
						</div>
						</div>
					</div>
				</div>
				</div>
			</div>
	</div>		

	<div class="accordion-group">
		<div id="by_commodities" class="table_divs panel panel-success">
			  <div class="panel-heading accordion-heading " data-toggle="collapse" data-parent="#accordion2" href="#by_commodity" style="font-size:13px;font-weight:bold" >BY COMMODITY: <i>(Click to View)</i></div>
			  <div id="by_commodity" class="accordion-body collapse">
			  <div class="accordion-inner div_height">
				  <button id="btn_screening" class=" btn btn-success">SCREENING - KHB</button> &nbsp;&nbsp;&nbsp;
				  <button id="btn_confirmatory" class=" btn btn-success">CONFIRMATORY - First Response</button>&nbsp;&nbsp;&nbsp;
				  <button id="btn_tiebreaker" class=" btn btn-success">TIE BREAKER</button>&nbsp;&nbsp;&nbsp;
				  <button id="btn_dbsbundles" class=" btn btn-success">DBS BUNDLES</button>			  	
			  </div>
			  </div>
			</div>
	</div>		
	<div class="accordion-group">
		<div id="by_dates" class="table_divs panel panel-success">
		<div class="panel-heading accordion-heading " data-toggle="collapse" data-parent="#accordion2" href="#by_date" style="font-size:13px;font-weight:bold" >BY DATE<i>(Click to View)</i></div>
		 <div id="by_date" class="accordion-body collapse">
			  <div class="accordion-inner div_height">
			
			<select id="date_select" class="form-control" style="width:15%;float:left;height:30px;font-size:12px;">
				<option value="0"> -- Select Period--</option>
				<?php 

		            for ($i=1; $i <=12 ; $i++) { 
		            $month = date('m', strtotime("-$i month")); 
		            $year = date('Y', strtotime("-$i month")); 
		            $month_value = $month.$year;
		            $month_text =  date('F', strtotime("-$i month")); 
		            $month_text = "-- ".$month_text." ".$year." --";
		         ?>

		        <option value="<?php echo $month_value ?>"><?php echo $month_text ?></option>;
		    <?php } ?>
			</select>&nbsp;&nbsp;&nbsp;
              <button type="button" id="btn_monthly_select" class="btn btn-primary my_navs">Download Monthly Report</button>
								
		</div>
		</div>
		</div>
		  

</div>
<!-- <div class="accordion-group">
		<div id="by_combinations" class="table_divs panel panel-success">
		<div class="panel-heading accordion-heading " data-toggle="collapse" data-parent="#accordion2" href="#by_combination" style="font-size:13px;font-weight:bold" >**SPECIFY TYPE OF REPORT TO DOWNLOAD**<i>(Click to View)</i></div>
		 <div id="by_combination" class="accordion-body collapse">
			  <div class="accordion-inner div_height">
			
			<select id="combination_select" class="form-control" style="width:15%;float:left;height:30px;font-size:12px;">
				<option value="0"> -- Select Region--</option>
				<option value="zone"> -- Select Zone--</option>
				<option value="county"> -- Select County--</option>
				<option value="district"> -- Select Sub County--</option>
			</select>
			<select id="combination_zone_select" class="form-control regions" style="width:15%;float:left;height:30px;font-size:12px;">
				<option value="0"> -- Select Zone--</option>
				<option value="A"> Zone A</option>
				<option value="B"> Zone B</option>
				<option value="C"> Zone C</option>
				<option value="D"> Zone D</option>
			</select>
			<select id="combination_county_select" class="form-control regions" style="width:15%;float:left;height:30px;font-size:12px;">
				<option value="0"> -- Select County--</option>
			</select>
			<select id="combination_subcounty_select" class="form-control regions" style="width:15%;float:left;height:30px;font-size:12px;">
				<option value="0"> -- Select Sub County--</option>
			</select>
			<select id="combination_commodity_select" class="form-control" style="width:15%;float:left;height:30px;font-size:12px;">
				<option value="0"> -- Select Commodity--</option>
				<option value="0"> -- Select Screening--</option>
				<option value="0"> -- Select Confirmatory--</option>
				<option value="0"> -- Select Tie Breaker--</option>
				<option value="0"> -- Select DBS Bundles--</option>
			</select>
			<select id="combination_month_select" class="form-control" style="width:15%;float:left;height:30px;font-size:12px;">
				<option value="0"> -- Select Period--</option>
			</select>&nbsp;&nbsp;&nbsp;
              <button type="button" id="btn_monthly_select" class="btn btn-primary my_navs">Download Monthly Report</button>
				
		</div>
		</div>
		</div>
		  <button id="btn_alert" class=" btn btn-success" data-toggle="modal" data-target="#download_modal">DOWNLOAD</button>
        <div id="message" type="text" style="margin-left: 0%; width:200px;color:blue;font-size:120%"></div>

</div> -->
</div> 
</div> 
<div class="clc_contents">
<div id="clc_contents">
	<div class="accordion-group">
		<div id="consumption_details" class="table_divs panel panel-success">
			  <div class="panel-heading accordion-heading " data-toggle="collapse" data-parent="#accordion2" href="#kit_consumption" style="font-size:13px;font-weight:bold" >CONSUMPTION DATA: <i>(Click to View)</i></div>
			  <div id="kit_consumption" class="accordion-body collapse">
				<div class="accordion-group inner_divs">
	<!--by zone-->
					<select id="date_select" class="form-control" style="width:15%;float:left;height:30px;font-size:12px;">
							<option value="0"> -- Select Period--</option>
							<?php 

					            for ($i=1; $i <=12 ; $i++) { 
					            $month = date('m', strtotime("-$i month")); 
					            $year = date('Y', strtotime("-$i month")); 
					            $month_value = $month.$year;
					            $month_text =  date('F', strtotime("-$i month")); 
					            $month_text = "-- ".$month_text." ".$year." --";
					         ?>

					        <option value="<?php echo $month_value ?>"><?php echo $month_text ?></option>;
						    <?php } ?>
						  </select>&nbsp;&nbsp;&nbsp;
	               		<button type="button" id="btn_consumption_select" class="btn btn-primary my_navs">Download Consumption Report</button>
						  
						  	
					  </div>
					  </div>
					</div>
				</div>
				</div>
				</div>

<style type="text/css">
	.table{
		font-size: 11px;
		/*margin: 1%;	*/
		width: 100%;	
	}
	.header_tr{
		background-color:#f5f5f5;
	}
	.table th{
		text-align: center;
	}

	.clc_contents  h6{		
		font-weight: bold;
		color: green;
		margin-top: 1%;
		margin-left: 1%;
	}
	.clc_contents {		
		
		width: 60%;
	}
	.inner_divs{
		width: 90%;
		height: 20%;
	}
	.div_height{
		margin-left: 1%;
		margin-top: 3%;
		height: 20%;

	}
	.inner_div_height{
		margin-left: 1%;
		margin-top: 3%;
		height: 50%;

	}
	.table_divs{
		margin-top: 1%;
		margin-left: 1%;
		/*border: 1px dotted green;*/
		width: 100%;
		height: auto;
	}
	
	
</style>
<script type="text/javascript">
	$(document).ready(function (e){

		$.ajax({
            url: "<?php echo base_url() . 'allocation_management/get_counties_districts'; ?>",
            dataType: 'json',
            success: function(s){
            	console.log(s);
                var districtslist = s.districts_list;
                var countieslist = s.counties_list;
				$('#county_select').html(countieslist);
				$('#subcounty_select').html(districtslist);
                
            },
            error: function(e){
                console.log(e.responseText);
            }            
        }); 
        $('#btn_all_facilities').button().click(function(e) {               
         
	        $('#message').html('The report for all Facilities AMCs is being generated. Please Wait...');                                         
	        $('#message').css('font-size','13px');                                         
	        $('#message').css('color','green');  
	        var url = "<?php echo base_url() . 'allocation_management/get_all_facilities_amcs'; ?>";
			window.location = url;
       
		});
		$('#btn_zone_a').button().click(function(e) {               
         
	        $('#message').html('The report for Zone A AMCs is being generated. Please Wait...');                                         
	        $('#message').css('font-size','13px');                                         
	        $('#message').css('color','green');  
	        var url = "<?php echo base_url() . 'allocation_management/get_zonal_facilities_amcs/A'; ?>";
			window.location = url;
       
		});
		$('#btn_zone_b').button().click(function(e) {               
         
	        $('#message').html('The report for Zone B AMCs is being generated. Please Wait...');                                         
	        $('#message').css('font-size','13px');                                         
	        $('#message').css('color','green');  
	        var url = "<?php echo base_url() . 'allocation_management/get_zonal_facilities_amcs/B'; ?>";
			window.location = url;
       
		});
		$('#btn_zone_c').button().click(function(e) {               
         
	        $('#message').html('The report for Zone C AMCs is being generated. Please Wait...');                                         
	        $('#message').css('font-size','13px');                                         
	        $('#message').css('color','green');  
	        var url = "<?php echo base_url() . 'allocation_management/get_zonal_facilities_amcs/C'; ?>";
			window.location = url;
       
		});
		$('#btn_zone_d').button().click(function(e) {               
         
	        $('#message').html('The report for Zone D AMCs is being generated. Please Wait...');                                         
	        $('#message').css('font-size','13px');                                         
	        $('#message').css('color','green');  
	        var url = "<?php echo base_url() . 'allocation_management/get_zonal_facilities_amcs/D'; ?>";
			window.location = url;
       
		});
		$('#btn_screening').button().click(function(e) {               
         
	        $('#message').html('The report for SCREENING-KHB AMCs is being generated. Please Wait...');                                         
	        $('#message').css('font-size','13px');                                         
	        $('#message').css('color','green');  
	        var url = "<?php echo base_url() . 'allocation_management/get_commodity_facilities_amcs/4'; ?>";
			window.location = url;
       
		});
		$('#btn_confirmatory').button().click(function(e) {               
         
	        $('#message').html('The report for CONFIRMATORY-First Response AMCs is being generated. Please Wait...');                                         
	        $('#message').css('font-size','13px');                                         
	        $('#message').css('color','green');  
	        var url = "<?php echo base_url() . 'allocation_management/get_commodity_facilities_amcs/5'; ?>";
			window.location = url;
       
		});
		$('#btn_tiebreaker').button().click(function(e) {               
         
	        $('#message').html('The report for Tie Breaker AMCs is being generated. Please Wait...');                                         
	        $('#message').css('font-size','13px');                                         
	        $('#message').css('color','green');  
	        var url = "<?php echo base_url() . 'allocation_management/get_commodity_facilities_amcs/5'; ?>";
			window.location = url;
       
		});
		$('#btn_dbsbundles').button().click(function(e) {               
         
	        $('#message').html('The report for DBS Bundles AMCs is being generated. Please Wait...');                                         
	        $('#message').css('font-size','13px');                                         
	        $('#message').css('color','green');  
	        var url = "<?php echo base_url() . 'allocation_management/get_commodity_facilities_amcs/22'; ?>";
			window.location = url;
       
		});

		// $('#btn_county_select').button().click(function(e) {               
		// 	var county_id = $('#county_select').val();			
         
	 //        $('#message').html('The report for County AMCs is being generated. Please Wait...');                                         
	 //        $('#message').css('font-size','13px');                                         
	 //        $('#message').css('color','green');  
	 //        var url = "<?php echo base_url() . 'allocation_management/get_county_facilities_amcs/'; ?>";
		// 	window.location = url+county_id;
       
		// });
		$('#btn_subcounty_select').button().click(function(e) {               
         
			var subcounty_id = $('#subcounty_select').val();			
	        $('#message').html('The report for Sub-County AMCs is being generated. Please Wait...');                                         
	        $('#message').css('font-size','13px');                                         
	        $('#message').css('color','green');  
	        var url = "<?php echo base_url() . 'allocation_management/get_subcounty_facilities_amcs/'; ?>";
			window.location = url+ subcounty_id;
       
		});
		$('#btn_monthly_select').button().click(function(e) {               
         
			var month = $('#date_select').val();			
	        $('#message').html('The report for Monthly AMCs is being generated. Please Wait...');                                         
	        $('#message').css('font-size','13px');                                         
	        $('#message').css('color','green');  
	        var url = "<?php echo base_url() . 'allocation_management/get_months_facilities_amcs/'; ?>";
			window.location = url+ month;
       
		});
		
		$('#combination_select').on('change', function() {
	 		region = this.value;
	 		// alert(region); // or $(this).val()
	 		if(region=='zone'){
	 			$('#combination_zone_select').show();
	 		}
	 		// else if(region=='county'){
	 		// 	$('#combination_county_select').show();

	 		// }else if(region=='district'){
	 		// 	$('#combination_subcounty_select').show();

	 		// }
		});
	});
// $(document).ajaxStart(function(){
// 	    $('#loading').show();
// 	 }).ajaxStop(function(){
// 	    $('#loading').hide();
// 	 });
</script>


	
</div>
<div class="modal" id="loading">
	
</div>
<style type="text/css">
	.modal
	{
	    display:    none;
	    position:   fixed;
	    z-index:    1000;
	    top:        0;
	    left:       0;
	    height:     100%;
	    width:      100%;
	    background: rgba( 255, 255, 255, .8 ) 
	                url('<?php echo base_url();?>assets/img/new_loader.gif') 
	                50% 50% 
	                no-repeat;
	}

	/* When the body has the loading class, we turn
	   the scrollbar off with overflow:hidden */
	body.loading {
	    overflow: hidden;   
	}

	/* Anytime the body has the loading class, our
	   modal element will be visible */
	body.loading .modal {
	    display: block;
	}

</style>
