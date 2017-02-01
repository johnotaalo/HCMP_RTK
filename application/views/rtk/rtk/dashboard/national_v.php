<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>HCMP | <?php echo $title;?> </title>    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo base_url().'assets/img/coat_of_arms.png'?>" type="image/x-icon" />
  <link href="<?php echo base_url().'assets/css/style.css'?>" type="text/css" rel="stylesheet"/>     
    <link href="<?php echo base_url().'assets/css/styles.css'?>" type="text/css" rel="stylesheet"/>
    
  <link href="<?php echo base_url().'assets/boot-strap3/css/bootstrap.min.css'?>" type="text/css" rel="stylesheet"/>
  <link href="<?php echo base_url().'assets/boot-strap3/css/bootstrap-responsive.css'?>" type="text/css" rel="stylesheet"/>
  <link href="<?php echo base_url().'assets/css/jquery-ui.css'?>" type="text/css" rel="stylesheet"/>
  <link href="<?php echo base_url().'assets/css/normalize.css'?>" type="text/css" rel="stylesheet"/>
  <link href="<?php echo base_url().'assets/css/dashboard.css'?>" type="text/css" rel="stylesheet"/>
  <link href="<?php echo base_url().'assets/css/jquery-ui-1.10.4.custom.min.css'?>" type="text/css" rel="stylesheet"/>
  <link href="<?php echo base_url().'assets/css/font-awesome.min.css'?>" type="text/css" rel="stylesheet"/>
  <link rel="stylesheet" href="<?php echo base_url().'assets/css/pace-theme-flash.css'?>" />
    <link href="<?php echo base_url().'assets/datatable/TableTools.css'?>" type="text/css" rel="stylesheet"/>
  <link href="<?php echo base_url().'assets/datatable/dataTables.bootstrap.css'?>" type="text/css" rel="stylesheet"/>
  
  <script src="<?php echo base_url().'assets/scripts/pace.js'?>" type="text/javascript"></script>    
  <script src="<?php echo base_url().'assets/scripts/jquery.js'?>" type="text/javascript"></script> 
     <script src="<?php echo base_url().'assets/scripts/select2.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url();?>assets/highcharts/highcharts.js"></script>
  <script src="<?php echo base_url();?>assets/highcharts/exporting.js"></script>
  <script src="<?php echo base_url().'assets/scripts/jquery-ui.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/scripts/validator.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/scripts/jquery.validate.js'?>" type="text/javascript"></script> 
  <script src="<?php echo base_url().'assets/scripts/waypoints.js'?>" type="text/javascript"></script> 
  <script src="<?php echo base_url().'assets/scripts/waypoints-sticky.min.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/boot-strap3/js/bootstrap.min.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/scripts/typehead/typeahead.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/scripts/typehead/handlebars.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url();?>assets/FusionCharts/FusionCharts.js" type="text/javascript"></script>

	<!-- <link href="<?php echo base_url().'assets/metro-bootstrap/docs/font-awesome.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/metro-bootstrap/css/metro-bootstrap.css'?>" type="text/css" rel="stylesheet"/>
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script>
   paceOptions = {
  ajax: false, // disabled
  document: true, // 
  eventLag: true,
  restartOnPushState: false,
  elements:{
  	selectors:['body']
  } // 
  
};
 
    function load(time){
      var x = new XMLHttpRequest()
      x.open('GET', document.URL , true);
      x.send();
    };
    setTimeout(function(){
      Pace.ignore(function(){
        load(3100);
      });
    },4500);

    Pace.on('hide', function(){
   //   console.log('done');
    });

    var url="<?php echo base_url(); ?>";
    </script>
    <style>
.panel-success>.panel-heading {
color: white;
background-color: #528f42;
border-color: #528f42;
border-radius:0;

}
.navbar-default {
background-color: white;
border-color: #e7e7e7;
}
.modal-content
{
  border-radius: 0 !important;
}
#navigate ul {
	text-align: left;
	display: inline;
	margin: 0;
	padding: 13px 4px 17px 0;
	list-style: none;
}
/*
 * For National Outlook only as it doesnt display properly
 */
#navigate ul li {
	display: inline-block;
	margin-right: -4px;
	position: relative;
	padding: 13px 18px;
	background: #29527b; /* Old browsers */
	cursor: pointer;
	-webkit-transition: all 0.2s;
	-moz-transition: all 0.2s;
	-ms-transition: all 0.2s;
	-o-transition: all 0.2s;
	transition: all 0.2s;
}
.filter_row{
  border-bottom: 1px solid #528f42;    
  background-color: #F0F5E6;
  margin-left: -10px;
  margin-top: -10px;
  width: 100%;  
  padding-bottom: 1%;
}

</style>
  </head> 
<body style="padding-top: 0;">
	<div class="container-fluid navbar-default navbar-fixed-top" role="navigation" style="background-color:white;border-bottom:1px solid #528f42;margin-bottom:10px;padding:1%;">
        <div class="container-fluid">
            <div class="navbar-header" id="st-trigger-effects">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>          

        </div>
        <div class="navbar-header" >  
            <a href="<?php echo base_url().'national';?>">  
            <center>
              <img style="display:inline-block;"  src="<?php echo base_url();?>assets/img/coat_of_arms_dash.png" class="img-responsive " alt="Responsive image" id="logo" ></a>
              <div id="logo_text" >
                    <span style="display: block; font-weight: bold; font-size: 14px; margin:2px;">Ministry of Health</span>
                    <span style="display: block; font-size: 12px;font-weight: bold;">Rapid Test Kits System(RTKs)</span>  
                </div>
              </center> 
        </div>
        
        <div class="collapse navbar-collapse navbar-right">
          <ul class="nav navbar-nav navbar-right">            
            <li class=""><a href="<?php echo base_url().'national/reports';?>">EID/VL</a></li>            
            <li class=""><a href="<?php echo base_url().'national/search';?>">CD4</a></li>
            <li class=""><a href="<?php echo base_url().'national/search';?>"></a></li>
            <li class="" style="background: #144d6e; color: white;"><a style="background: #144d6e; color: white;" href="<?php echo base_url().'user/login';?>"><span class="glyphicon glyphicon-user"></span>RTK Log In</a></li>
            
                    
          </ul>
          
                                        
        </div><!--/.nav-collapse -->

      </div>
    </div>

<div style="margin-left: 2%;margin-right: 2%;margin-top: 3%;" class="inner_wrapper"> 
 <div class="row" style="margin-top: 0%;">
     <div class="col-md-4" style="margin-top: 6.5%;"> <!-- map -->
      <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title" style="display:inline-block;">National Overview</h3>
            </div>
      <div class="panel-body">
      *Click on a County to View Data
      <div id="map" style="width:400px; height: 400px;">
                   
                   <script>
var map= new FusionMaps ("assets/FusionMaps/FCMap_KenyaCounty.swf","KenyaMap","100%","100%","0","0");
map.setJSONData(<?php
echo $maps; ?>
    );
    map.render("map");
                    </script>


        </div>
        <div style="width:130px;margin-left:30%;padding:2%">
            <div style="display:inline-block;width:10px;height:10px;background:#FFCC99">
                
            </div>
            <div style="width:80px;display:inline-block;margin-left:5px;font-size:120%">Reporting for RTK</div></div>
      </div> 
      </div>      
     </div><!-- map -->
     <div class="col-md-8"> <!-- 4 cell -->
      <!--div class="row"><!-- facility infor -->
       <!--div class="col-md-6"style="margin-top: 9.5%;">
       <div class="panel panel-success">
       <div class="panel-heading">
       <h3 class="panel-title" style="display:inline-block;"><div class="county-name" style="display:inline-block"></div>User Overview</h3>
       </div>
        <div class="panel-body">
       
          <div style="display:table-row" >
                     <div style="display:table-cell;">
             <p style="font-size:120%;display: inline-block;"><span class="glyphicon glyphicon-user"></span># of CLCs:  &nbsp;<div style="display: inline-block;" id="clcs"></div></p></div>           
             <div style="display:table-cell;">&nbsp;&nbsp;&nbsp;&nbsp;</div>
            <div style="display:table-cell;">
             <p style="font-size:120%;display: inline-block;"><span class="glyphicon glyphicon-user"></span># of SCMLTs:  &nbsp;<div style="display: inline-block;" id="scmlts"></div></p></div>  
              <div style="display:table-cell;">&nbsp;&nbsp;&nbsp;&nbsp;</div>
            <div style="display:table-cell;">
             <p style="font-size:120%;display: inline-block;"><span class="glyphicon glyphicon-user"></span># of Partners:  &nbsp;<div style="display: inline-block;" id="partners"></div></p></div>   
          </div>
       </div>    
       </div>
       </div>
       <div class="col-md-6" style="margin-top: 9.5%;">
       <div class="panel panel-success" >
       <div class="panel-heading">
       <h3 class="panel-title" style="display:inline-block;"><div class="county-name" style="display:inline-block"></div>Facility Information</h3>
       </div>
        <div class="panel-body">
     <div id="facilities"></div>
          </div>
       </div>    
       </div>      
     </div--><!-- facility infor -->
 <div class="row"> <!-- row 2-->
    <div class="col-md-12" style="margin-left: -10px;margin-top: 9.5%; height: 400px;">
       <div class="panel panel-success">
	       <div class="panel-heading">
	       	<h3 class="panel-title" style="display:inline-block;"><div class="county-name" id="reporting_rates_county_name" style="display:inline-block"></div>Reporting Rates</h3>
	       </div>
	       <!--For the Expiries Tab-->
	       <div class="panel-body" style="height:500px;">
	       	<!--ul class='nav nav-tabs'>
		      <li class="active"><a href="#stracer" data-toggle="tab">Expiries</a></li>
	      	</ul-->
	      	<div id="myTabContent" class="tab-content">
      			<div class="row" style="margin-left: 0px">
            <div class="filter row filter_row">	        	
	        	<form class="form-inline" role="form">
                    
            <?php
              $option = '<option value="NULL">Select All</option>';              
              foreach ($counties as $key => $value) {
                $county_id = $value['id'];
                $county_name = $value['county_name'];
                $option.= '<option value="'.$county_id.'">'.$county_name.'</option>';
              }
              ?>
           <select id="trend_county" class="form-control col-md-2 user_type">
           <?php echo $option;?>
              
          </select>					
        
					<div class="col-md-2">
					<button class="btn btn-sm btn-success ecounty-filter " id="trend_filter"><span class="glyphicon glyphicon-filter"></span>Filter</button> 
					</div>
          </form>
        </div>
          <div id="trend-chart">
    
          </div>          
				
	        	
	
	        </div>
       </div>
       		
	     
	          
       </div> 
       </div>
 </div> <!-- row 2-->
  <div class="row"> <!-- row 2-->
    <div class="col-md-12" style="margin-left:-42%;margin-top:16.5%;height:40%;float:left;width:55%;">
       <div class="panel panel-success">
         <div class="panel-heading">
          <h3 class="panel-title" style="display:inline-block;"><div class="county-name" id="stock_card_county_name" style="display:inline-block"></div>Stock Card</h3>
         </div>
         <!--For the Expiries Tab-->
         <div class="panel-body" style="height:500px;">
          <!--ul class='nav nav-tabs'>
          <li class="active"><a href="#stracer" data-toggle="tab">Expiries</a></li>
          </ul-->
          <div id="myTabContent" class="tab-content">
            <div class="row" style="margin-left: 2px">
            <div class="filter row filter_row">
            <form class="form-inline" role="form">
                    
            <?php
              $option = '<option value="NULL">Select County</option>';              
              foreach ($counties as $key => $value) {
                $county_id = $value['id'];
                $county_name = $value['county_name'];
                $option.= '<option value="'.$county_id.'">'.$county_name.'</option>';
              }
              ?>
           <select id="stock_card_county" class="form-control col-md-2 user_type">
           <?php echo $option;?>
              
          </select>   
        
          <select id="stock_card_month" class="form-control col-md-2 user_type">       
        <?php 

            for ($i=1; $i <=12 ; $i++) { 
            $month = date('m', strtotime("-$i month")); 
            $year = date('Y', strtotime("-$i month")); 
            $month_value = $month.$year;
            $month_text =  date('F', strtotime("-$i month")); 
            $month_text = "-- ".$month_text." ".$year." --";
         ?>
        <option value="<?php echo $month_value ?>"><?php echo $month_text ?></option>;
    <?php } ?></select>
        
          <div class="col-md-2">
          <button class="btn btn-sm btn-success ecounty-filter" id="stock_card_filter"><span class="glyphicon glyphicon-filter"></span>Filter</button> 
          </div><br/>
          </form>
        </div>
          <div id="stock_card">    
         
        </div>
  
        
            
  
          </div>
       </div>          
          
            
       </div> 
       </div>
 </div> <!-- row 2-->
   <div class="row"> <!-- row 2-->
    <div class="col-md-12" style="margin-left:1%;margin-top:16%;height:auto;float:left;width:80%;">
       <div class="panel panel-success">
         <div class="panel-heading">
          <h3 class="panel-title" style="display:inline-block;"><div class="county-name" id="expiries_county_name" style="display:inline-block"></div>Highest Expiries</h3>
         </div>
         <!--For the Expiries Tab-->
         <div class="panel-body" style="height:500px;">
          <!--ul class='nav nav-tabs'>
          <li class="active"><a href="#stracer" data-toggle="tab">Expiries</a></li>
          </ul-->
          <div id="myTabContent" class="tab-content">
            <div class="row" style="margin-left: 2px">
            <div class="filter row filter_row">            
            <form class="form-inline" role="form">
                    
           <?php
              $option = '<option value="NULL">Select County</option>';              
              foreach ($counties as $key => $value) {
                $county_id = $value['id'];
                $county_name = $value['county_name'];
                $option.= '<option value="'.$county_id.'">'.$county_name.'</option>';
              }
              ?>
           <select id="expiries_county" class="form-control col-md-2 user_type">
            <?php echo $option;?>
              
          </select>         
            <select id="expiries_month" class="form-control col-md-2 user_type">         
        <?php 

            for ($i=1; $i <=12 ; $i++) { 
            $month = date('m', strtotime("-$i month")); 
            $year = date('Y', strtotime("-$i month")); 
            $month_value = $month.$year;
            $month_text =  date('F', strtotime("-$i month")); 
            $month_text = "-- ".$month_text." ".$year." --";
         ?>
        <option value="<?php echo $month_value ?>"><?php echo $month_text ?></option>;
    <?php } 

    $comm = "SELECT lab_commodities.id,lab_commodities.commodity_name FROM lab_commodities,lab_commodity_categories WHERE lab_commodities.category = lab_commodity_categories.id AND lab_commodity_categories.active = '1'";
$commodities = $this->db->query($comm);
// s
$option_comm = '';
foreach ($commodities->result_array() as $key => $value) {
    $option_comm .= '<option value = "' . $value['id'] . '">' . $value['commodity_name'] . '</option>';
}


    ?>
    </select> 
    <select id="expiries_commodity" class="form-control col-md-2 user_type">       
        <option value='NULL'> Select Commodity</option>
        <?php echo $option_comm; ?>
    </select>

          <div class="col-md-2">
          <button class="btn btn-sm btn-success ecounty-filter" id="expiries_filter"><span class="glyphicon glyphicon-filter"></span>Filter</button> 
          </div><br/>
           </form>
        </div>
          <div id="expiries">    
          
        </div>
  
       
            
  
          </div>
       </div>          
          
            
       </div> 
       </div>
 </div> <!-- row 2-->
     </div><!-- 4 cell -->
 </div> <!-- row 1-->
  <div class="row"> <!-- row 2-->
    <div class="col-md-12" style="margin-left:-42%;margin-top:0%;height:40%;float:left;width:120%;">
       <div class="panel panel-success">
         <div class="panel-heading">
          <h3 class="panel-title" style="display:inline-block;"><div class="county-name" id="commodity_usage_county_name" style="display:inline-block"></div>Commodity Usage</h3>
         </div>
         <!--For the Expiries Tab-->
         <div class="panel-body" style="height:500px;">
          <!--ul class='nav nav-tabs'>
          <li class="active"><a href="#stracer" data-toggle="tab">Expiries</a></li>
          </ul-->
          <div id="myTabContent" class="tab-content">
            <div class="row" style="margin-left: 2px">
            <div class="filter row filter_row">
            <form class="form-inline" role="form">
                    
            <?php
              $option = '<option value="NULL">Select County</option>';              
              foreach ($counties as $key => $value) {
                $county_id = $value['id'];
                $county_name = $value['county_name'];
                $option.= '<option value="'.$county_id.'">'.$county_name.'</option>';
              }
              ?>
           <select id="commodity_usage_county" class="form-control col-md-2 user_type">
           <?php echo $option;?>
              
          </select>           
          
        
          <div class="col-md-2">
          <button class="btn btn-sm btn-success ecounty-filter" id="commodity_usage_filter"><span class="glyphicon glyphicon-filter"></span>Filter</button> 
          </div><br/>
          </form>
        </div>
          <div id="commodity_usage">    
         
        </div>
  
        
            
  
          </div>
       </div>          
          
            
       </div> 
       </div>
 </div> <!-- row 2-->

</div>
</div>
</div>

<div id="footer">
      <div class="container">
        <p class="text-muted"> Government of Kenya &copy <?php echo date('Y');?>. All Rights Reserved</p>
      </div>
    </div>
 <input type="hidden" name="county_id" id="county_id" />   
</body>
<script>
         //auto run
         var url ='<?php echo base_url()?>';
        // $('#potential_').on('shown.bs.tab', function (e) {
        // $('#potential').html('');
       // });
         $('#actual_').on('shown.bs.tab', function (e) {
         $('#actual').html('');
         });

      $('.county-name').html("National "+" &nbsp;");
      ajax_request_replace_div_content('dashboard/expiry/NULL/NULL/NULL/NULL/NULL',"#actual"); 
      ajax_request_replace_div_content('dashboard/get_national_trend/',"#trend-chart"); 
      ajax_request_replace_div_content('dashboard/get_national_stock_card/',"#stock_card"); 
      ajax_request_replace_div_content('dashboard/get_national_expiries',"#expiries"); 
      ajax_request_replace_div_content('dashboard/get_national_commodity_usage',"#commodity_usage"); 

      //ajax_request_replace_div_content('dashboard/potential/NULL/NULL/NULL/NULL/NULL',"#potential"); 
      //ajax_request_replace_div_content('dashboard/facility_over_view/',"#facilities_rolled_out");
      // ajax_request_replace_div_content('dashboard/get_clc_infor/NULL/NULL/NULL/NULL',"#clcs");
      // ajax_request_replace_div_content('dashboard/get_scmlt_infor/NULL/NULL/NULL/NULL',"#scmlts");      
      // ajax_request_replace_div_content('dashboard/get_partner_infor/NULL/NULL/NULL/NULL',"#partners");      
      //ajax_request_replace_div_content('dashboard/hcw/',"#hcw_trained");
      //ajax_request_replace_div_content('kenya/mos_graph/NULL/NULL/NULL/NULL',"#mos");
      // ajax_request_replace_div_content('dashboard/consumption/NULL/NULL/NULL/NULL',"#consumption");
      // ajax_request_replace_div_content('dashboard/get_facility_infor/NULL/NULL/NULL/NULL',"#facilities");
      // ajax_request_replace_div_content('dashboard/order/NULL/NULL/NULL/NULL/NULL',"#orders");
      // ajax_request_replace_div_content('dashboard/get_lead_infor/NULL/NULL/NULL/NULL/NULL',"#lead_infor");
        $('#trend_filter').click(function(e){
          e.preventDefault();
          var county = $("#trend_county").val();
          if(county=='NULL'){
            ajax_request_replace_div_content('dashboard/get_national_trend/',"#trend-chart"); 
          }else{
            ajax_request_replace_div_content('dashboard/get_national_trend/'+county,"#trend-chart");   
            var county_data= $("#trend_county option:selected").text();          
            $('#reporting_rates_county_name').html(county_data+"&nbsp;County &nbsp;");
          }       

        });

        $('#commodity_usage_filter').click(function(e){
          e.preventDefault();
          var county = $("#commodity_usage_county").val();
          if(county=='NULL'){
            ajax_request_replace_div_content('dashboard/get_national_commodity_usage/',"#commodity_usage"); 
          }else{
            ajax_request_replace_div_content('dashboard/get_national_commodity_usage/'+county,"#commodity_usage");   
            var county_data= $("#commodity_usage_county option:selected").text();          
            $('#commodity_usage_county_name').html(county_data+"&nbsp;County &nbsp;");
          }  

        });


        $('#stock_card_filter').click(function(e){
          e.preventDefault();
          var county = $("#stock_card_county").val();
          var month = $("#stock_card_month").val();
          //alert('Month is '+month+' and COunty is '+county);
          if(county=='NULL'){            
            ajax_request_replace_div_content('dashboard/get_national_stock_card/NULL/'+month,"#stock_card"); 
          }else{
            ajax_request_replace_div_content('dashboard/get_national_stock_card/'+county+'/'+month,"#stock_card");             
            var county_data= $("#stock_card_county option:selected").text();          
            $('#stock_card_county_name').html(county_data+"&nbsp;County &nbsp;");   
          }                     
        });

        $('#expiries_filter').click(function(e){
          e.preventDefault();
          var county = $("#expiries_county").val();
          var month = $("#expiries_month").val();
          var commodity = $("#expiries_commodity").val();
          
          if((county=='NULL')&&(commodity=='NULL')){
            ajax_request_replace_div_content('dashboard/get_national_expiries/NULL/'+month+'/NULL',"#expiries");             
          }else if((county=='NULL')&&(commodity!='NULL')){
            ajax_request_replace_div_content('dashboard/get_national_expiries/NULL/'+month+'/'+commodity,"#expiries");             

          }else if((county!='NULL')&&(commodity=='NULL')){
            ajax_request_replace_div_content('dashboard/get_national_expiries/'+county+'/'+month+'/NULL',"#expiries");                         
            var county_data= $("#expiries_county option:selected").text();          
            $('#expiries_county_name').html(county_data+"&nbsp;County &nbsp;"); 
          }else if((county!='NULL')&&(commodity!='NULL')){
            ajax_request_replace_div_content('dashboard/get_national_expiries/'+county+'/'+month+'/'+commodity,"#expiries");                         
            var county_data= $("#expiries_county option:selected").text();          
            $('#expiries_county_name').html(county_data+"&nbsp;County &nbsp;"); 
          }
                             
                  
        });

        $(".ecounty-filter").button().click(function(e) {
        e.preventDefault(); 
        var year = $("#eyear").val();
        var county = $("#ecounty_filter").val();
       // var district=$(this).closest("tr").find("#ecounty_filter").val();
       // var facility=$(this).closest("tr").find("#ecounty_filter").val();
           ajax_request_replace_div_content('dashboard/expiry/'+year+'/'+county+'/NULL/NULL/NULL',"#actual");
        });
        
        $(".asubcounty-filter").button().click(function(e) {
        e.preventDefault(); 
        var year=$("#asubcountyyear").val();
        var county_id=$('#county_id').val();
        var district=$("#asubcounty_filter").val();
        var facility=$("#asubcounty_facility_filter").val();
        ajax_request_replace_div_content('dashboard/expiry/'+year+'/'+county_id+'/'+district+'/'+facility+'/NULL',"#actual");
        });
        /////potential
        $(".pcounty-filter").button().click(function(e) {
        e.preventDefault(); 
        var county=$("#pcounty_filter").val();
        ajax_request_replace_div_content('dashboard/potential/'+county+'/NULL/NULL/NULL',"#potential");
        });
        
        $(".psubcounty-filter").button().click(function(e) {
        e.preventDefault(); 
        var county_id=$('#county_id').val();
        var district=$("#psubcounty_filter").val();
        var facility=$("#psubcounty_facility_filter").val();
        ajax_request_replace_div_content('dashboard/potential/'+county_id+'/'+district+'/'+facility+'/NULL',"#potential");
        });
     
         $(".subcounty").click(function(){
            /*
             * when clicked, this object should populate facility names to facility dropdown list.
             * Initially it sets a default value to the facility drop down list then ajax is used 
             * is to retrieve the district names using the 'dropdown()' method used above.
             */
            json_obj = {"url":"<?php echo site_url("orders/getFacilities");?>",}
            var baseUrl = json_obj.url;
            var id = $(this).attr("value");
            $('.subcounty').val(id);
            dropdown(baseUrl,"district="+id,".facility");
 
          
        });

      
    function run(data){
        var county_data=data.split('^');
        $('.county-name').html(county_data[1]+"&nbsp;County &nbsp;");        
        $('.county').val(county_data[0]);
        $('#county_id').val(county_data[0]);
        json_obj={"url":"<?php echo site_url("orders/getDistrict");?>",}
        var baseUrl=json_obj.url;
        dropdown(baseUrl,"county="+county_data[0],".subcounty");
        var county = county_data[0];
        ajax_request_replace_div_content('dashboard/get_national_stock_card/'+county+'///',"#stock_card");             
        ajax_request_replace_div_content('dashboard/get_national_expiries/'+county+'///',"#expiries");                         
        ajax_request_replace_div_content('dashboard/get_national_trend/'+county+'///',"#trend-chart");   


        // ajax_request_replace_div_content('dashboard/expiry/NULL/'+county_data[0]+'/NULL/NULL/NULL',"#actual");
        // ajax_request_replace_div_content('dashboard/get_national_trend/NULL/'+county_data[0]+'/NULL/NULL/NULL',"#actual");
        // //ajax_request_replace_div_content('dashboard/potential/'+county_data[0]+'/NULL/NULL/NULL/NULL',"#potential"); 
        // ajax_request_replace_div_content('dashboard/stock_level_mos/'+county_data[0]+'/NULL/NULL/NULL/ALL',"#mos");
        // ajax_request_replace_div_content('dashboard/consumption/'+county_data[0]+'/NULL/NULL/NULL',"#consumption");
        // ajax_request_replace_div_content('dashboard/get_facility_infor/'+county_data[0]+'/NULL/NULL/NULL',"#facilities");
        // ajax_request_replace_div_content('dashboard/order/NULL/'+county_data[0]+'/NULL/NULL/NULL',"#orders");
        // ajax_request_replace_div_content('dashboard/get_lead_infor/NULL/'+county_data[0]+'/NULL/NULL/NULL',"#lead_infor");
    }
            function dropdown(baseUrl,post,identifier){
            /*
             * ajax is used here to retrieve values from the server side and set them in dropdown list.
             * the 'baseUrl' is the target ajax url, 'post' contains the a POST varible with data and
             * 'identifier' is the id of the dropdown list to be populated by values from the server side
             */
            $.ajax({
              type: "POST",
              url: baseUrl,
              data: post,
              success: function(msg){
                    var values=msg.split("_")
                    var dropdown="<option value='NULL'>All</option>";
                    for (var i=0; i < values.length-1; i++) {
                        var id_value=values[i].split("*")
                        dropdown+="<option value="+id_value[0]+">";
                        dropdown+=id_value[1];
                        dropdown+="</option>";
                    };
                    $(identifier).html(dropdown);
              },
              error: function(XMLHttpRequest, textStatus, errorThrown) {
                   if(textStatus == 'timeout') {}
               }
            }).done(function( msg ) {
            });
        }
       function ajax_request_replace_div_content(function_url,div){
        var function_url =url+function_url;
        var loading_icon=url+"assets/img/loader2.gif";
        $.ajax({
        type: "POST",
        url: function_url,
        beforeSend: function() {
        $(div).html("<img style='margin-left:20%;' src="+loading_icon+">");
        },
        success: function(msg) {
        $(div).html(msg);
        }
        });
        }   
</script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.tablesorter.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.metadata.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.tablecloth.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/datatable/jquery.dataTables.js"></script>
<script type="text/javascript">
$(document).ready(function() {
   $('.table_cloth_tables').dataTable({
            "bJQueryUI": false,
            "bPaginate": true
        });
  //$(".table_cloth_tables").datatable()
});
</script>
</html>
