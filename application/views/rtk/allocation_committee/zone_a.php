<style>

.dataTables_filter{
  float: right;
}
#pending_facilities_length{
  float: left;  
}
table{
  font-size: 13px;
}


#pending_facilities_paginate{
  font-size: 13px;
  float: right;
  padding:4px;
}
#pending_facilities_info{
  font-size: 15px; 
  float: left;
}

#pending_facilities_filter{
  float: right;
}
.nav li{
  float: left;
  margin-left: 20px;
}
 .DTTT_container{margin-top: 1em;}
    #banner_text{width: auto;}
    .divide{height: 2em;}



</style>


<div class="main-container" style="width: 100%;float: right;">

<div class="span3" style="float:left">
<!--ul class="nav nav-tabs nav-stacked" style="width:100%;"-->
<ul class="nav nav-tabs nav-stacked " style="width:100%;">
  <div class="links" id="zonea"><a href="a" >Zone A</a></div>
  <div class="links" id="zoneb"><a href="b" >Zone B</a></div>
  <div class="links" id="zonec"><a href="c" >Zone C</a></div>
  <div class="links" id="zoned"><a href="d" >Zone D</a></div>
</ul>
</div>
<br/>

  <table id="pending_facilities" class="data-table"> 
    <thead>
    <tr>        
       <tr>        
      <th align="">County</th>
      <th align="">Sub-County</th>
      <th align="">MFL</th>
      <th align="">Facility Name</th>     
      <th align="center" colspan="5">Screening KHB</th>      
      <th align="center" colspan="5">Confirmatory First Response</th>      
      <th align="center" colspan="5">TieBreaker - Unigold</th> 
    </tr>    
    <tr>
          
      <th align="center"></th>
      <th align="center"></th>
      <th align="center"></th>
      <th align="center"></th>      
      <th align="center">Ending Balance</th>      
      <th align="center">AMC</th>
      <th align="center">Days out of Stock</th>
      <th align="center">Quantity Requested</th>
      <th align="center">Quantity to Allocate</th>
      <th align="center">Ending Balance</th>      
      <th align="center">AMC</th>
      <th align="center">Days out of Stock</th>
      <th align="center">Quantity Requested</th>
      <th align="center">Quantity to Allocate</th>
      <th align="center">Ending Balance</th>      
      <th align="center">AMC</th> 
      <th align="center">Days out of Stock</th>
      <th align="center">Quantity Requested</th>
      <th align="center">Quantity to Allocate</th>               
    </tr>
      
    </thead>

    <tbody>
      <?php
      if(count($final_dets)>0){
        $count = 0;
       foreach ($final_dets as $value) {
        //$zone = str_replace(' ', '-',$value['zone']);
        $facil = $value['code'];

        $ending_bal_s =ceil($value['end_bal'][0]['closing_stock']); 
        $ending_bal_c =ceil($value['end_bal'][1]['closing_stock']); 
        $ending_bal_t =ceil($value['end_bal'][2]['closing_stock']);

        $days_out_of_stock_s =ceil($value['end_bal'][0]['days_out_of_stock']); 
        $days_out_of_stock_c =ceil($value['end_bal'][1]['days_out_of_stock']); 
        $days_out_of_stock_t =ceil($value['end_bal'][2]['days_out_of_stock']);

        $q_requested_s =ceil($value['end_bal'][0]['q_requested']); 
        $q_requested_c =ceil($value['end_bal'][1]['q_requested']); 
        $q_requested_t =ceil($value['end_bal'][2]['q_requested']);

        $amc_s = str_replace(',', '',$my_amcs[$count][0]);
        $amc_c = str_replace(',', '',$my_amcs[$count][1]);
        $amc_t = str_replace(',', '',$my_amcs[$count][2]);


        $amc_s = str_replace(',', '',$value['amcs'][0]['amc']);
        $amc_c = str_replace(',', '',$value['amcs'][1]['amc']);
        $amc_t = str_replace(',', '',$value['amcs'][2]['amc']);        

        if($amc_s==''){
          $amc_s = 0;
        }

        if($amc_c==''){
          $amc_c = 0;
        }

        if($amc_t==''){
          $amc_t = 0;
        }

        // $mmos_s = ceil(($amc_s * 4)/50);
        // $mmos_c = ceil(($amc_c * 4)/30);
        // $mmos_t = ceil(($amc_t * 4)/20);

        // if($mmos_s < $ending_bal_s){
        //   $qty_to_alloc_s = 0;
        // }else{
        //   $qty_to_alloc_s = $mmos_s - $ending_bal_s;
        // }

        // if($mmos_c < $ending_bal_c){
        //   $qty_to_alloc_c = 0;
        // }else{
        //   $qty_to_alloc_c = $mmos_c - $ending_bal_c;
        // }

        // if($mmos_t < $ending_bal_t){
        //   $qty_to_alloc_t = 0;
        // }else{
        //   $qty_to_alloc_t = $mmos_t - $ending_bal_t;
        // }
        $count++;
        
        ?> 
        <tr>   
          <td align=""><?php echo $value['county'];?></td>
          <td align=""><?php echo $value['district'];?></td>              
          <td align=""><?php echo $value['code'];?></td>
          <td align=""><?php echo $value['name'];?></td>

          <td align="center"><?php echo $ending_bal_s;?></td>     
          <td align="center"><?php echo $amc_s;?></td> 
          <td align="center"><?php echo $days_out_of_stock_s;?></td> 
          <td align="center"><?php echo $q_requested_s;?></td> 
          <td align="center"><?php echo 0;?></td> 

          <td align="center"><?php echo $ending_bal_c;?></td>     
          <td align="center"><?php echo $amc_c;?></td> 
          <td align="center"><?php echo $days_out_of_stock_c;?></td> 
          <td align="center"><?php echo $q_requested_c;?></td> 
          <td align="center"><?php echo 0;?></td> 

          <td align="center"><?php echo $ending_bal_t;?></td>     
          <td align="center"><?php echo $amc_t;?></td> 
          <td align="center"><?php echo $days_out_of_stock_t;?></td> 
          <td align="center"><?php echo $q_requested_t;?></td> 
          <td align="center"><?php echo 0;?></td> 
          
         
          
        </tr>
        <?php }
      }else{ ?>
      <tr>There are No Facilities which did not Report</tr>
      <?php }
      ?>      

    </tbody>
  </table>
</div>
<script>
$(document).ready(function() {
 
  $('#pending_facilities').dataTable({
     "sDom": "T lfrtip",
     "aaSorting": [],
     "bJQueryUI": false,
      "bPaginate": false,
      "oLanguage": {
        "sLengthMenu": "_MENU_ Records per page",
        "sInfo": "Showing _START_ to _END_ of _TOTAL_ records",
      },
      "oTableTools": {
      "aButtons": [      
      "copy",
      "print",
      {
        "sExtends": "collection",
        "sButtonText": 'Save',
        "aButtons": ["csv", "xls", "pdf"]
      }
      ],  
      "sSwfPath": "<?php echo base_url();?>assets/datatable/media/swf/copy_csv_xls_pdf.swf"
    }
  });
  $("#pending_facilities").tablecloth({theme: "paper",         
    bordered: true,
    condensed: true,
    striped: true,
    sortable: true,
    clean: true,
    cleanElements: "th td",
    customClass: "data-table"
  });

  $("#pending_facilities tfoot th").each(function(i) {
    var select = $('<select><option value=""></option></select>')
    .appendTo($(this).empty())
    .on('change', function() {
      table.column(i)
      .search('^' + $(this).val() + '$', true, false)
      .draw();
    });

    table.column(i).data().unique().sort().each(function(d, j) {
      select.append('<option value="' + d + '">' + d + '</option>')
    });
  });
  

});
</script>

<!--Datatables==========================  --> 
<script src="http://cdn.datatables.net/1.10.0/js/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/datatable/jquery.dataTables.min.js" type="text/javascript"></script>  
<script src="<?php echo base_url(); ?>assets/datatable/dataTables.bootstrap.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/datatable/TableTools.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/datatable/ZeroClipboard.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/datatable/dataTables.bootstrapPagination.js" type="text/javascript"></script>
<!-- validation ===================== -->
<script src="<?php echo base_url(); ?>assets/scripts/jquery.validate.min.js" type="text/javascript"></script>



<link href="<?php echo base_url(); ?>assets/boot-strap3/css/bootstrap-responsive.css" type="text/css" rel="stylesheet"/>
<link href="<?php echo base_url(); ?>assets/datatable/TableTools.css" type="text/css" rel="stylesheet"/>
<link href="<?php echo base_url(); ?>assets/datatable/dataTables.bootstrap.css" type="text/css" rel="stylesheet"/>

<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.tablesorter.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.metadata.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.tablecloth.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/tablecloth/assets/css/tablecloth.css">
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/datatable/jquery.dataTables.js"></script>