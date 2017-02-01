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

  <table id="pending_facilities"  class="data-table1" style="width:1100px;"> 
    <thead>
    <tr>        
      <th align="">County</th>
      <th align="">Sub-County</th>
      <th align="">MFL</th>
      <th align="">Facility Name</th>     
      <th align="">Commodity Name</th>           
      <th align="">Quantity Expiring</th>           
    </tr>       
      
    </thead>

    <tbody>
      <?php
      if(count($facilities)>0){
       foreach ($facilities as $key =>$value) {
          $count = 0;        
          $facility_code = $value['facility_code'];
          $facility_name = $value['facility_name'];
          $district = $value['district'];
          $county = $value['county'];

          $count = count($commodities[$facility_code]);                                     
          $new_rowspan = count($commodities[$facility_code])+1;
        ?> 
        <tr>   
          <td rowspan="<?php echo $new_rowspan;?>"><?php echo $county; ?></td>        
          <td rowspan="<?php echo $new_rowspan;?>"><?php echo $district; ?></td>        
          <td rowspan="<?php echo $new_rowspan;?>"><?php echo $facility_code; ?></td>        
          <td rowspan="<?php echo $new_rowspan;?>"><?php echo $facility_name; ?></td>                             
        </tr>
        <?php 
          for ($i=0; $i < $count ; $i++) { ?>            
          <tr>
            <td><?php echo $commodities[$facility_code][$i]['commodity_name'];?>
            <td><?php echo $commodities[$facility_code][$i]['q_expiring'];?>          
          </tr>
        <?php }

      }
      }else{ ?>
      <tr>There are No Facilities which did not Report</tr>
      <?php }
      ?>      

    </tbody>
  </table>
</div>
<script>
$(document).ready(function() {
 
  // $('#pending_facilities').dataTable({
  //    "sDom": "T lfrtip",
  //    "aaSorting": [],
  //    "bJQueryUI": false,
  //     "bPaginate": false,
  //     "oLanguage": {
  //       "sLengthMenu": "_MENU_ Records per page",
  //       "sInfo": "Showing _START_ to _END_ of _TOTAL_ records",
  //     },
  //     "oTableTools": {
  //     "aButtons": [      
  //     "copy",
  //     "print",
  //     {
  //       "sExtends": "collection",
  //       "sButtonText": 'Save',
  //       "aButtons": ["csv", "xls", "pdf"]
  //     }
  //     ],  
  //     "sSwfPath": "<?php echo base_url();?>assets/datatable/media/swf/copy_csv_xls_pdf.swf"
  //   }
  // });
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