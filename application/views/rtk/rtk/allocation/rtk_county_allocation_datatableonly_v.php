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

input{
    border: 1px solid #C0C0C0 ; 
    border-radius: 15px;
    background: #F0F0F0 ;
    margin: 0 0 10px 0;
    width: auto;
}

</style>


<div class="main-container" style="width: 100%;float: right;">

<div class="span3" style="float:center; font-size:16px; color:green; width:100%"> <b>Available amount of Kits in <?php echo $county_name;?>:</b><br/>
Screening: <?php echo $drawing_rights[0]['screening']?>, Confirmatory: <?php echo $drawing_rights[0]['screening']?>, Tie Breaker: <?php echo $drawing_rights[0]['screening']?>.

</div>
<br/>
<br/>
<br/>
<br/>
<div class="span3" style="float:left">
<!--ul class="nav nav-tabs nav-stacked" style="width:100%;"-->
<ul class="nav nav-tabs nav-stacked " style="width:100%;">
</ul>
</div>
<br/>         
  <table id="allocation_table" class="data-table"> 
    <thead>
    <tr>        
       <tr>        
      <th align="">County</th>
      <th align="">Sub-County</th>
      <th align="">MFL</th>
      <th align="">Facility Name</th>     
      <th align="center" colspan="3">Screening</th>      
      <th align="center" colspan="3">Confirmatory</th>      
      <th align="center" colspan="3">TieBreaker</th> 
      <th align="center" colspan="3">DBS Bundles</th> 
    </tr>    
    <tr>
          
      <th align="center"></th>
      <th align="center"></th>
      <th align="center"></th>
      <th align="center"></th>      
      <th align="center">Ending Balance</th>      
      <th align="center">AMC</th>
      <th align="center">Quantity Requested for Allocation</th>
      <th align="center">Ending Balance</th>      
      <th align="center">AMC</th>
      <th align="center">Quantity Requested for Allocation</th>
      <th align="center">Ending Balance</th>      
      <th align="center">AMC</th>
      <th align="center">Quantity Requested for Allocation</th>  
      <th align="center">Ending Balance</th>      
      <th align="center">AMC</th> 
      <th align="center">Quantity to Allocate (20 pack)</th>               
    </tr>
      
    </thead>

    <tbody>
      <?php
        // echo '<pre>';print_r($allocations);

      if(count($allocations)>0){
        $count = 0;
        foreach ($allocations as $value) {
                
        ?> 
        <tr>         
        
          <td align=""><?php echo $value['county'];?></td>
          <td align=""><?php echo $value['district'];?></td>              
          <td align=""><?php echo $value['facility_code'];?></td>
          <td align=""><?php echo $value['facility_name'];?></td>  

          <td align="center"><?php echo $value['ending_bal_s'];?></td>     
          <td align="center"><?php echo $value['amc_s'];?></td>
          <td align="center"><?php echo $value['allocate_s'];?></td> 

          <td align="center"><?php echo $value['ending_bal_c'];?></td>    
          <td align="center"><?php echo $value['amc_c'];?></td>
          <td align="center"><?php echo $value['allocate_c'];?></td>

          <td align="center"><?php echo $value['ending_bal_t'];?></td>    
          <td align="center"><?php echo $value['amc_t'];?></td>
          <td align="center"><?php echo $value['allocate_t'];?></td>
          
          <td align="center"><?php echo $value['ending_bal_d'];?></td>      
          <td align="center"><?php echo $value['amc_d'];?></td>
          <td align="center"><?php echo $value['allocate_d'];?></td>           
          
        </tr>
        <?php 
        $count++;

      }

      }else{ ?>
      <tr>There are No Facilities that Reported</tr>
      <?php }
      ?>      

    </tbody>
  </table>
  </form>
<?php form_close(); ?>

</div>
<br/>
<br/>
<br/>
    <div id="message" type="text" style="margin-left: 0%; width:200px;color:blue;font-size:120%">lalaaa</div>
        <input class="btn btn-primary" type="submit"   id="confirm"  value="Save" style="margin-left: 0%; width:100px" >
    

    <div class="modal fade" id="next_modal">
  <div class="modal-dialog">
    <div class="modal-content">      
      <div class="modal-body">
        <span id="report_status"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="go_home">
            Back to Home
        </button>
        <button type="button" class="btn btn-default" <a id="next_report_btn">
            Next Report
        </button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
$(document).ready(function() {
 
  $('#allocation_table').dataTable({
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
   
  $("#allocation_table").tablecloth({theme: "paper",         
    bordered: true,
    condensed: true,
    striped: true,
    sortable: true,
    clean: true,
    cleanElements: "th td",
    customClass: "data-table"
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


 