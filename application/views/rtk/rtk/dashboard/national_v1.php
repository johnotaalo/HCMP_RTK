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
        <a href="<?php echo base_url().'national';?>"></a>
        <center>
          <img style="display:inline-block;"  src="<?php echo base_url();?>assets/img/coat_of_arms_dash.png" class="img-responsive " alt="Responsive image" id="logo" >
          <div id="logo_text" >
              <span style="display: block; font-weight: bold; font-size: 14px; margin:2px;">Ministry of Health</span>
              <span style="display: block; font-size: 12px;font-weight: bold;">Rapid Test Kits System(RTKs)</span>  
          </div>
        </center>           
      </div>
      
      <div class="collapse navbar-collapse navbar-right">
        <ul class="nav navbar-nav navbar-right">
          <li class="active"><a href="<?php echo base_url().'national';?>">Home</a></li>
          <li class=""><a href="<?php echo base_url().'national/reports';?>">EID/VL</a></li>
          <li class=""><a href="<?php echo base_url().'national/reports';?>">RTKs</a></li>
          <li class=""><a href="<?php echo base_url().'national/search';?>">CD4</a></li>
          <li class="" style="background: #144d6e; color: white;"><a style="background: #144d6e; color: white;" href="<?php echo base_url().'home';?>"><span class="glyphicon glyphicon-user"></span>Log in</a></li>
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
            <div style="width:80px;display:inline-block;margin-left:5px;font-size:120%">Reporting for RTK</div></div>
      </div> 
      </div>      
     </div><!-- map -->
     <div class="col-md-8">
     <div class="row"> <!-- row 2-->

    <div class="col-md-12" style="margin-left: -10px;margin-top: 9.5%; height: 400px;">
       <div class="panel panel-success">
         <div class="panel-heading">
          <h3 class="panel-title" style="display:inline-block;"><div class="county-name" style="display:inline-block"></div>Reporting Rates</h3>
         </div>
         <!--For the Expiries Tab-->
         <div class="panel-body" style="height:500px;">
          <!--ul class='nav nav-tabs'>
          <li class="active"><a href="#stracer" data-toggle="tab">Expiries</a></li>
          </ul-->
          <div id="myTabContent" class="tab-content">
            <div class="row" style="margin-left: 2px">
            <div class="filter row" style="margin-left: 2px;">
            <form class="form-inline" role="form">
                    
            <?php
              $option = '<option value="NULL">Select County</option>';              
              foreach ($counties as $key => $value) {
                $county_id = $value['id'];
                $county_name = $value['county_name'];
                $option.= '<option value="'.$county_id.'">'.$county_name.'</option>';
              }
              ?>
           <select id="user_type" class="form-control col-md-2 user_type">
           <?php echo $option;?>
              
          </select>         
        
          <div class="col-md-2">
          <button class="btn btn-sm btn-success ecounty-filter"><span class="glyphicon glyphicon-filter"></span>Filter</button> 
          </div>
          <div id="trend-chart">
    
          </div>          
        </form>
        </div>
            
  
          </div>
       </div>
          
       
            
       </div> 
       </div>
 </div> <!-- row 2-->
  <div class="row" style="margin-top:1%;margin-left:1px;margin-right:1px;height:500px;width:99%;border:1px solid #ccc;"> <!-- row 2-->
    <!--div class="col-md-12" style="margin-left:1%;margin-top:16%;height:auto;float:left;width:80%;">
       <div class="panel panel-success">
       </div>
    </div-->
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

</html>
