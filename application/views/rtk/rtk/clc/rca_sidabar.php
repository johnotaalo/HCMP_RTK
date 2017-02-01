<div class="col-md-2" style="border-right: solid 1px #ccc;padding-right: 20px;margin-left:-5px">
   
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

    <select id="switch_county" class="form-control" style="max-width: 220px;background-color: #ffffff;border: 1px solid #cccccc;">
        <option>-- Select County --</option>
        <?php echo $option; ?>
    </select>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <select id="switch_month" class="form-control" style="max-width: 220px;background-color: #ffffff;border: 1px solid #cccccc;">       
        <?php 

            for ($i=1; $i <=21 ; $i++) { 
            $month = date('m', strtotime("-$i month")); 
            $year = date('Y', strtotime("-$i month")); 
            $month_value = $month.$year;
            $month_text =  date('F', strtotime("-$i month")); 
            $month_text = "-- ".$month_text." ".$year." --";
         ?>
        <option value="<?php echo $month_value ?>"><?php echo $month_text ?></option>;
        <?php } ?>
    </select>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

 <div id="switch"><button id="switch_back" class="btn btn-primary">Switch to Current Month</button></div>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

    <ul class="nav nav-pills nav-stacked" style="font-size:100%;border:ridge 1px #ccc">
        <li class = "side_links active"><a href="<?php echo base_url().'rtk_management/county_home'?>">Summary</a></li>        
        <li class = "side_links"><a href="<?php echo base_url().'rtk_management/rca_districts'?>">Sub-Counties</a></li>
        <li class = "side_links"><a href="<?php echo base_url().'rtk_management/county_stock'?>">Stock Card</a></li>
        <li class = "side_links"><a href="<?php echo base_url().'rtk_management/rca_pending_facilities'?>">Non-Reported Facilities</a></li>
        <li class = "side_links"><a href="<?php echo base_url().'allocation_management/county_allocation_reports' ?>">Reports</a></li>
        <li class = "side_links"><a href="<?php echo base_url().'rtk_management/county_admin/users' ?>">Users</a></li>
        <li class = "side_links"><a href="<?php echo base_url().'rtk_management/county_admin/facilities' ?>">Facilities</a></li>
        
        <?php
        $county_id = $this->session->userdata('county_id');

        $sql ="select * from counties where id = '$county_id'";
        $result = $this->db->query($sql)->result_array();
        $zone = $result[0]['zone'];
        
        $month = date('m');
        $day =date('d');
        
        $zone_a_months = array(01,04,07,10);
        $zone_b_months = array(02,05,08,11);
        $zone_c_months = array(03,06,09,12);
        // $zone_d_months = array(01,04,07,10);

            if ($day>=12 && $day <=23) { 
            
                if (in_array($month, $zone_a_months) && $zone == 'A'){
                // else {
                    echo '<li class = "side_links"><a href="'.base_url().'rtk_management/cmlt_allocation_dashboard">RTK Allocation ongoing</a></li>';
               } else if (in_array($month, $zone_b_months) && $zone == 'B'){

                    echo '<li class = "side_links"><a href="'.base_url().'rtk_management/cmlt_allocation_dashboard">RTK Allocation ongoing</a></li>';
               } else if (in_array($month, $zone_c_months) && $zone == 'C'){

                    echo '<li class = "side_links"><a href="'.base_url().'rtk_management/cmlt_allocation_dashboard">RTK Allocation ongoing</a></li>';
               } else{

                    echo  '<li class = "side_links">RTK Allocation ongoing   </a></li>';
               }

            }else{
                    
              echo  '<li class = "side_links">RTK Allocation </a></li>';

            }

        ?>
        
        <li class = "side_links"><a href="<?php echo base_url().'rtk_management/county_trend' ?>">Trends</a></li>
    </ul>
</div>

<style type="text/css">
    

    .main_list {
        list-style-type: none;
        margin: 0;
        padding: 0;
        border: 1px ridge #000;
        width: 100%;
        background-color: #f1f1f1;
    }
    .side_links{
        display: block;
        color: #000;
        padding: 8px 0 8px 16px;
        text-decoration: none;
        font-size: 16px
    }
    .side_links:hover {
    background-color: #66CC99  ;
    color: green;
}

</style>