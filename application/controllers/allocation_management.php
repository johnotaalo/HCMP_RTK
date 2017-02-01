 <?php
/*

*/
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include_once ('home_controller.php');

class Allocation_Management extends CI_controller {
	function __construct() {
        parent::__construct();
        $this->load->library('Excel');
        //$this->load->database();
       // ini_set('memory_limit', '-1');
       // ini_set('max_input_vars', 3000);
    }

    public function index() {
        echo "It works";
    }
    public function allocation_reports(){
 
        $data['banner_text'] = 'Allocation Reports';
        $data['active_zone'] = "$zone";
        $data['content_view'] = 'rtk/rtk/allocation/allocation_reports';
        $data['title'] = 'Download Allocation Reports ';       
        $this->load->view("rtk/template", $data);
    }
    public function county_allocation_reports(){
 
        $data['banner_text'] = 'Allocation Reports';
        $data['active_zone'] = "$zone";
        $data['content_view'] = 'rtk/rtk/clc/county_allocation_report';
        $data['title'] = 'Download Allocation Reports ';       
        $this->load->view("rtk/template", $data);
    }
    //get amcs from facility_amc table and facility details then insert into allocation table
    function get_amcs(){
        //get facility's details
        $sql = "SELECT 
                    counties.county,
                    counties.id as county_id,
                    districts.district,
                    districts.id as district_id,
                    facilities.facility_code,
                    facilities.facility_name,
                    facilities.zone                   
                FROM
                    facilities,
                    counties,
                    districts
                WHERE
                    counties.id = districts.county
                        AND districts.id = facilities.district limit 0,100";
       $result = $this->db->query($sql)->result_array();

       //get the amcs of all four commodities for each facility
       foreach ($result as $key => $value) {
           $facility_code = $value['facility_code'];

           $sql2 = "Select amc, commodity_id, latest from facility_amc where facility_code = '$facility_code'";
           $result2 = $this->db->query($sql2)->result_array();
       
            $county_id = $value['county_id'];
            $county = $value['county'];
            $district_id = $value['district_id'];
            $district = $value['district'];
            $zone = $value['zone'];
            $oldfacility_name = $value['facility_name'];
            $facility_name = str_replace("'", "", $oldfacility_name);
            $amc_s3 = $result2[0]['amc'];
            $amc_c3 = $result2[1]['amc'];
            $amc_t3 = $result2[2]['amc'];
            $amc_d3 = 0; 

            $month = $result2[0]['latest'];
            if (empty($month)) {
                $newmonth = '';

            }else{
                $monthnumber = date("m", strtotime($month));
                $newyear = date("Y", strtotime($month));
                $newmonth = $monthnumber.$newyear;
            }
            //insert the details into allocation details          
            $sql3 = "INSERT INTO `allocation_details`
                    (`county_id`, `county`, `district_id`, `district`, `mfl`, `facility_name`, `zone`, `amc_s`, `amc_t`, `amc_c`, `amc_d`,`month`) 
                    VALUES ('$county_id','$county','district_id','$district','$facility_code','$facility_name','$zone',
                    '$amc_s3','$amc_t3','$amc_c3','$amc_d3','$month')";
        
            $this->db->query($sql3);
       }
                   
    }
    
    function get_counties_districts(){
        $sql = 'select counties.id as county_id, counties.county from counties';
        $sql2 = 'select districts.id as district_id, districts.district from districts';
        $counties = $this->db->query($sql)->result_array();
        $districts = $this->db->query($sql2)->result_array();
       
        // echo('<pre>'); print_r($districts);die;
       $option_district .= '<option value = "">--Select Sub-County</option>';
       foreach ($districts as $key => $value) {
            $option_district .= '<option value = "' . $value['district_id'] . '">' . $value['district'] . '</option>';
        } 

        $option_county .= '<option value = "">--Select County</option>';
        foreach ($counties as $key => $value) {
            $option_county .= '<option value = "' . $value['county_id'] . '">' . $value['county'] . '</option>';
        } 
        
        $output = array('counties_list'=>$option_county,'districts_list'=>$option_district,'month_list'=>$option_month);  
        echo json_encode($output);
        
    }

    //get allocation details from all facilities in the country
    function get_all_facilities_amcs(){
        //get all the details from allocation_details table in db
    $sql = "SELECT 
                counties.county  as county_name, districts.district as district_name, allocation_details.*
            FROM
                allocation_details,
                facilities,
                counties,
                districts
            WHERE
                district_id = '$district'
                    AND districts.county = counties.id
                    AND facilities.district = districts.id
                    AND facilities.facility_code = allocation_details.facility_code_name limit 0,100";
    $result = $this->db->query($sql)->result_array();
    
    foreach ($result as $key => $id_details) {
        
        $facility_code = $id_details['mfl'];
        // for each selected facility, get the last reported lab details fro all four commodities
        $sql2 = "SELECT 
				    closing_stock, days_out_of_stock, q_requested
				FROM
				    lab_commodity_details AS a
				WHERE
				    facility_code = '$facility_code'
				        AND commodity_id between 4 and 7
				        AND created_at IN (SELECT 
				            MAX(created_at)
				        FROM
				            lab_commodity_details AS b
				        WHERE
				            a.facility_code = b.facility_code)";
        $result2 = $this->db->query($sql2)->result_array();

        $county = $id_details['county_name'];
        $district = $id_details['district_name'];
        $facility_name = $id_details['facility_name'];
        $amc_s3 = $id_details['amc_s3'];
        $amc_c3 = $id_details['amc_c3'];
        $amc_t3 = $id_details['amc_t3'];
        $amc_d3 = 0;

        $ending_bal_s3 = $result2[0]['closing_stock'];
        $q_requested_s3 = $result2[0]['q_requested'];
        $days_out_of_stock_s3 = $result2[0]['days_out_of_stock'];

        $ending_bal_c3 = $result2[1]['closing_stock'];
        $q_requested_c3 = $result2[1]['q_requested'];
        $days_out_of_stock_c3 = $result2[1]['days_out_of_stock'];

        $ending_bal_t3 = $result2[2]['closing_stock'];
        $q_requested_t3 = $result2[2]['q_requested'];
        $days_out_of_stock_t3 = $result2[2]['days_out_of_stock'];

        $ending_bal_d3 = $result2[3]['closing_stock'];
        $q_requested_d3 = $result2[3]['q_requested'];
        $days_out_of_stock_d3 = $result2[3]['days_out_of_stock'];

        //based on the results, put them in an array to beused in the excell file.

        $alocation_details[] = array($county,$district,$facility_code,$facility_name,
                                     $ending_bal_s3,$amc_s3,$days_out_of_stock_s3,$q_requested_s3,
                                     $ending_bal_c3,$amc_c3,$days_out_of_stock_c3,$q_requested_c3,
                                     $ending_bal_t3,$amc_t3,$days_out_of_stock_t3,$q_requested_t3,
                                     $ending_bal_d3,$amc_d3,$days_out_of_stock_d3,$q_requested_d3);
}
        // echo"<pre>";print_r($alocation_details);
    
         $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Counties');
        //set cell A1 content with some text
        $this->excel->getActiveSheet()->setCellValue('A1', 'Commodity Consumption Data (in Tests)');
        $this->excel->getActiveSheet()->setCellValue('A4', 'County');
        $this->excel->getActiveSheet()->setCellValue('B4', 'Sub-County');
        $this->excel->getActiveSheet()->setCellValue('C4', 'MFL Code');
        $this->excel->getActiveSheet()->setCellValue('D4', 'Facility Name');
        $this->excel->getActiveSheet()->setCellValue('E4', 'Screening KHB');
        $this->excel->getActiveSheet()->setCellValue('I4', 'Confirmatory - First Response');
        $this->excel->getActiveSheet()->setCellValue('M4', 'Tie Breaker');
        $this->excel->getActiveSheet()->setCellValue('Q4', 'DBS Bundles');

        $this->excel->getActiveSheet()->setCellValue('A5', '');
        $this->excel->getActiveSheet()->setCellValue('B5', '');
        $this->excel->getActiveSheet()->setCellValue('C5', '');
        $this->excel->getActiveSheet()->setCellValue('D5', '');

        $this->excel->getActiveSheet()->setCellValue('E5', 'Ending Balance');
        $this->excel->getActiveSheet()->setCellValue('F5', 'AMC');
        $this->excel->getActiveSheet()->setCellValue('G5', 'Days Out of Stock');
        $this->excel->getActiveSheet()->setCellValue('H5', 'Quantity Requested');

        $this->excel->getActiveSheet()->setCellValue('I5', 'Ending Balance');
        $this->excel->getActiveSheet()->setCellValue('J5', 'AMC');
        $this->excel->getActiveSheet()->setCellValue('K5', 'Days Out of Stock');
        $this->excel->getActiveSheet()->setCellValue('L5', 'Quantity Requested');

        $this->excel->getActiveSheet()->setCellValue('M5', 'Ending Balance');
        $this->excel->getActiveSheet()->setCellValue('N5', 'AMC');
        $this->excel->getActiveSheet()->setCellValue('O5', 'Days Out of Stock');
        $this->excel->getActiveSheet()->setCellValue('P5', 'Quantity Requested');
        
        $this->excel->getActiveSheet()->setCellValue('Q5', 'Ending Balance');
        $this->excel->getActiveSheet()->setCellValue('R5', 'AMC');
        $this->excel->getActiveSheet()->setCellValue('S5', 'Days Out of Stock');
        $this->excel->getActiveSheet()->setCellValue('T5', 'Quantity Requested');
        //merge cell A1 until C1
        $this->excel->getActiveSheet()->mergeCells('A1:K1');
        $this->excel->getActiveSheet()->mergeCells('E4:H4');
        $this->excel->getActiveSheet()->mergeCells('I4:L4');
        $this->excel->getActiveSheet()->mergeCells('M4:P4');
        $this->excel->getActiveSheet()->mergeCells('Q4:T4');
        //set aligment to center for that merged cell (A1 to C1)
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('E4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('I4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('M4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('Q4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //make the font become bold
        $this->excel->getActiveSheet()->getStyle('A4:T4')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A5:T5')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
        $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');

       for($col = ord('A'); $col <= ord('Q'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(false);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
        }
                            
        foreach ($alocation_details as $row){
                $exceldata[] = $row;
        }
             //Fill data 
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A6');
                $this->excel->getActiveSheet()->getStyle('C6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                 
                $filename='National Allocation (all facilities).xls'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
 
                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                //force user to download the Excel file without writing it to server's HD
                $objWriter->save('php://output');
    
    }
    function get_zonal_facilities_amcs($zone){
            //get all the details from allocation_details for a particular zone in db
        $sql = "SELECT 
                counties.county  as county_name, districts.district as district_name, allocation_details.*
            FROM
                allocation_details,
                facilities,
                counties,
                districts
            WHERE
                district_id = '$district'
                    AND districts.county = counties.id
                    AND facilities.district = districts.id
                    AND facilities.facility_code = allocation_details.facility_code and counties.zone = '$zone'";
        $result = $this->db->query($sql)->result_array();
    
    
    foreach ($result as $key => $id_details) {
        
        $facility_code = $id_details['mfl'];
        // for each selected facility, get the last reported lab details fro all four commodities
        $sql2 = "SELECT 
                    closing_stock, days_out_of_stock, q_requested
                FROM
                    lab_commodity_details AS a
                WHERE
                    facility_code = '$facility_code'
                        AND commodity_id between 4 and 7
                        AND created_at IN (SELECT 
                            MAX(created_at)
                        FROM
                            lab_commodity_details AS b
                        WHERE
                            a.facility_code = b.facility_code)";
        $result2 = $this->db->query($sql2)->result_array();

        $county = $id_details['county'];
        $district = $id_details['district'];
        $facility_name = $id_details['facility_name'];
        $amc_s3 = $id_details['amc_s3'];
        $amc_c3 = $id_details['amc_c3'];
        $amc_t3 = $id_details['amc_t3'];
        $amc_d3 = 0;

        $ending_bal_s3 = $result2[0]['closing_stock'];
        $q_requested_s3 = $result2[0]['q_requested'];
        $days_out_of_stock_s3 = $result2[0]['days_out_of_stock'];

        $ending_bal_c3 = $result2[1]['closing_stock'];
        $q_requested_c3 = $result2[1]['q_requested'];
        $days_out_of_stock_c3 = $result2[1]['days_out_of_stock'];

        $ending_bal_t3 = $result2[2]['closing_stock'];
        $q_requested_t3 = $result2[2]['q_requested'];
        $days_out_of_stock_t3 = $result2[2]['days_out_of_stock'];

        $ending_bal_d3 = $result2[3]['closing_stock'];
        $q_requested_d3 = $result2[3]['q_requested'];
        $days_out_of_stock_d3 = $result2[3]['days_out_of_stock'];

        //based on the results, put them in an array to beused in the excell file.

        $alocation_details[] = array($county,$district,$facility_code,$facility_name,
                                     $ending_bal_s3,$amc_s3,$days_out_of_stock_s3,$q_requested_s3,
                                     $ending_bal_c3,$amc_c3,$days_out_of_stock_c3,$q_requested_c3,
                                     $ending_bal_t3,$amc_t3,$days_out_of_stock_t3,$q_requested_t3,
                                     $ending_bal_d3,$amc_d3,$days_out_of_stock_d3,$q_requested_d3);
}
        // echo"<pre>";print_r($alocation_details);
    
         $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Counties');
        //set cell A1 content with some text
        $this->excel->getActiveSheet()->setCellValue('A1', 'Commodity Consumption Data (in Tests)');
        $this->excel->getActiveSheet()->setCellValue('A4', 'County');
        $this->excel->getActiveSheet()->setCellValue('B4', 'Sub-County');
        $this->excel->getActiveSheet()->setCellValue('C4', 'MFL Code');
        $this->excel->getActiveSheet()->setCellValue('D4', 'Facility Name');
        $this->excel->getActiveSheet()->setCellValue('E4', 'Screening KHB');
        $this->excel->getActiveSheet()->setCellValue('I4', 'Confirmatory - First Response');
        $this->excel->getActiveSheet()->setCellValue('M4', 'Tie Breaker');
        $this->excel->getActiveSheet()->setCellValue('Q4', 'DBS Bundles');

        $this->excel->getActiveSheet()->setCellValue('A5', '');
        $this->excel->getActiveSheet()->setCellValue('B5', '');
        $this->excel->getActiveSheet()->setCellValue('C5', '');
        $this->excel->getActiveSheet()->setCellValue('D5', '');

        $this->excel->getActiveSheet()->setCellValue('E5', 'Ending Balance');
        $this->excel->getActiveSheet()->setCellValue('F5', 'AMC');
        $this->excel->getActiveSheet()->setCellValue('G5', 'Days Out of Stock');
        $this->excel->getActiveSheet()->setCellValue('H5', 'Quantity Requested');

        $this->excel->getActiveSheet()->setCellValue('I5', 'Ending Balance');
        $this->excel->getActiveSheet()->setCellValue('J5', 'AMC');
        $this->excel->getActiveSheet()->setCellValue('K5', 'Days Out of Stock');
        $this->excel->getActiveSheet()->setCellValue('L5', 'Quantity Requested');

        $this->excel->getActiveSheet()->setCellValue('M5', 'Ending Balance');
        $this->excel->getActiveSheet()->setCellValue('N5', 'AMC');
        $this->excel->getActiveSheet()->setCellValue('O5', 'Days Out of Stock');
        $this->excel->getActiveSheet()->setCellValue('P5', 'Quantity Requested');
        
        $this->excel->getActiveSheet()->setCellValue('Q5', 'Ending Balance');
        $this->excel->getActiveSheet()->setCellValue('R5', 'AMC');
        $this->excel->getActiveSheet()->setCellValue('S5', 'Days Out of Stock');
        $this->excel->getActiveSheet()->setCellValue('T5', 'Quantity Requested');
        //merge cell A1 until C1
        $this->excel->getActiveSheet()->mergeCells('A1:K1');
        $this->excel->getActiveSheet()->mergeCells('E4:H4');
        $this->excel->getActiveSheet()->mergeCells('I4:L4');
        $this->excel->getActiveSheet()->mergeCells('M4:P4');
        $this->excel->getActiveSheet()->mergeCells('Q4:T4');
        //set aligment to center for that merged cell (A1 to C1)
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('E4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('I4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('M4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('Q4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //make the font become bold
        $this->excel->getActiveSheet()->getStyle('A4:T4')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A5:T5')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
        $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');

       for($col = ord('A'); $col <= ord('Q'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(false);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
        }
                            
        foreach ($alocation_details as $row){
                $exceldata[] = $row;
        }
              //Fill data 
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A6');
                $this->excel->getActiveSheet()->getStyle('C6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                 
                $filename='Zonal Allocation (Zone '.$zone.').xls'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
 
                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                //force user to download the Excel file without writing it to server's HD
                $objWriter->save('php://output');        

    }
    function get_county_facilities_amcs($county){
        //get all the details from allocation_details for a particular county in db
    $sql = "SELECT * FROM allocation_details where county_id = '$county'";
    $result = $this->db->query($sql)->result_array();
        
    foreach ($result as $key => $id_details) {
        
        $facility_code = $id_details['mfl'];
        // for each selected facility, get the last reported lab details fro all four commodities
        $sql2 = "SELECT 
                    closing_stock, days_out_of_stock, q_requested
                FROM
                    lab_commodity_details AS a
                WHERE
                    facility_code = '$facility_code'
                        AND commodity_id between 4 and 7
                        AND created_at IN (SELECT 
                            MAX(created_at)
                        FROM
                            lab_commodity_details AS b
                        WHERE
                            a.facility_code = b.facility_code)";
        $result2 = $this->db->query($sql2)->result_array();

        $county = $id_details['county'];
        $district = $id_details['district'];
        $facility_name = $id_details['facility_name'];
        $amc_s3 = $id_details['amc_s3'];
        $amc_c3 = $id_details['amc_c3'];
        $amc_t3 = $id_details['amc_t3'];
        $amc_d3 = 0;

        $ending_bal_s3 = $result2[0]['closing_stock'];
        $q_requested_s3 = $result2[0]['q_requested'];
        $days_out_of_stock_s3 = $result2[0]['days_out_of_stock'];

        $ending_bal_c3 = $result2[1]['closing_stock'];
        $q_requested_c3 = $result2[1]['q_requested'];
        $days_out_of_stock_c3 = $result2[1]['days_out_of_stock'];

        $ending_bal_t3 = $result2[2]['closing_stock'];
        $q_requested_t3 = $result2[2]['q_requested'];
        $days_out_of_stock_t3 = $result2[2]['days_out_of_stock'];

        $ending_bal_d3 = $result2[3]['closing_stock'];
        $q_requested_d3 = $result2[3]['q_requested'];
        $days_out_of_stock_d3 = $result2[3]['days_out_of_stock'];

        //based on the results, put them in an array to beused in the excell file.

        $alocation_details[] = array($county,$district,$facility_code,$facility_name,
                                     $ending_bal_s3,$amc_s3,$days_out_of_stock_s3,$q_requested_s3,
                                     $ending_bal_c3,$amc_c3,$days_out_of_stock_c3,$q_requested_c3,
                                     $ending_bal_t3,$amc_t3,$days_out_of_stock_t3,$q_requested_t3,
                                     $ending_bal_d3,$amc_d3,$days_out_of_stock_d3,$q_requested_d3);
}
        // echo"<pre>";print_r($alocation_details);
    
         $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Counties');
        //set cell A1 content with some text
        $this->excel->getActiveSheet()->setCellValue('A1', 'Commodity Consumption Data (in Tests)');
        $this->excel->getActiveSheet()->setCellValue('A4', 'County');
        $this->excel->getActiveSheet()->setCellValue('B4', 'Sub-County');
        $this->excel->getActiveSheet()->setCellValue('C4', 'MFL Code');
        $this->excel->getActiveSheet()->setCellValue('D4', 'Facility Name');
        $this->excel->getActiveSheet()->setCellValue('E4', 'Screening KHB');
        $this->excel->getActiveSheet()->setCellValue('I4', 'Confirmatory - First Response');
        $this->excel->getActiveSheet()->setCellValue('M4', 'Tie Breaker');
        $this->excel->getActiveSheet()->setCellValue('Q4', 'DBS Bundles');

        $this->excel->getActiveSheet()->setCellValue('A5', '');
        $this->excel->getActiveSheet()->setCellValue('B5', '');
        $this->excel->getActiveSheet()->setCellValue('C5', '');
        $this->excel->getActiveSheet()->setCellValue('D5', '');

        $this->excel->getActiveSheet()->setCellValue('E5', 'Ending Balance');
        $this->excel->getActiveSheet()->setCellValue('F5', 'AMC');
        $this->excel->getActiveSheet()->setCellValue('G5', 'Days Out of Stock');
        $this->excel->getActiveSheet()->setCellValue('H5', 'Quantity Requested');

        $this->excel->getActiveSheet()->setCellValue('I5', 'Ending Balance');
        $this->excel->getActiveSheet()->setCellValue('J5', 'AMC');
        $this->excel->getActiveSheet()->setCellValue('K5', 'Days Out of Stock');
        $this->excel->getActiveSheet()->setCellValue('L5', 'Quantity Requested');

        $this->excel->getActiveSheet()->setCellValue('M5', 'Ending Balance');
        $this->excel->getActiveSheet()->setCellValue('N5', 'AMC');
        $this->excel->getActiveSheet()->setCellValue('O5', 'Days Out of Stock');
        $this->excel->getActiveSheet()->setCellValue('P5', 'Quantity Requested');
        
        $this->excel->getActiveSheet()->setCellValue('Q5', 'Ending Balance');
        $this->excel->getActiveSheet()->setCellValue('R5', 'AMC');
        $this->excel->getActiveSheet()->setCellValue('S5', 'Days Out of Stock');
        $this->excel->getActiveSheet()->setCellValue('T5', 'Quantity Requested');
        //merge cell A1 until C1
        $this->excel->getActiveSheet()->mergeCells('A1:K1');
        $this->excel->getActiveSheet()->mergeCells('E4:H4');
        $this->excel->getActiveSheet()->mergeCells('I4:L4');
        $this->excel->getActiveSheet()->mergeCells('M4:P4');
        $this->excel->getActiveSheet()->mergeCells('Q4:T4');
        //set aligment to center for that merged cell (A1 to C1)
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('E4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('I4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('M4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('Q4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //make the font become bold
        $this->excel->getActiveSheet()->getStyle('A4:T4')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A5:T5')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
        $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');

       for($col = ord('A'); $col <= ord('Q'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(false);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                 
                //$this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        }
                            
        foreach ($alocation_details as $row){
                $exceldata[] = $row;
        }
        

                //Fill data 
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A6');
                 
                // $this->excel->getActiveSheet()->getStyle('A6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                // $this->excel->getActiveSheet()->getStyle('B6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('C6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                 
                $filename='County Allocation('.$alocation_details[0][0].' County).xls'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
 
                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                //force user to download the Excel file without writing it to server's HD
                $objWriter->save('php://output');        

    }
    function get_subcounty_facilities_amcs($district){
            //get all the details from allocation_details for a particular sub-county in db
    $sql = "SELECT 
                counties.county  as county_name, districts.district as district_name, allocation_details.*
            FROM
                allocation_details,
                facilities,
                counties,
                districts
            WHERE
                district_id = '83'
                    AND districts.county = counties.id
                    AND facilities.district = districts.id
                    AND facilities.facility_code = allocation_details.facility_code";
    $result = $this->db->query($sql)->result_array();
        // echo $sql;
        // echo"<pre>";print_r($result);die;

        
    foreach ($result as $key => $id_details) {
        
        $facility_code = $id_details['facility_code'];
        // for each selected facility, get the last reported lab details for all four commodities
        $sql2 = "SELECT 
                    closing_stock, days_out_of_stock, q_requested
                FROM
                    lab_commodity_details AS a
                WHERE
                    facility_code = '$facility_code'
                        AND commodity_id between 4 and 7
                        AND created_at IN (SELECT 
                            MAX(created_at)
                        FROM
                            lab_commodity_details AS b
                        WHERE
                            a.facility_code = b.facility_code)";
        $result2 = $this->db->query($sql2)->result_array();

        $county = $id_details['county_name'];
        $district = $id_details['district_name'];
        $facility_name = $id_details['facility_name'];
        $amc_s3 = $id_details['allocate_s'];
        $amc_c3 = $id_details['allocate_c'];
        $amc_t3 = $id_details['allocate_t'];
        $amc_d3 = 0;

        $ending_bal_s3 = $result2[0]['closing_stock'];
        $q_requested_s3 = $result2[0]['q_requested'];
        $days_out_of_stock_s3 = $result2[0]['days_out_of_stock'];

        $ending_bal_c3 = $result2[1]['closing_stock'];
        $q_requested_c3 = $result2[1]['q_requested'];
        $days_out_of_stock_c3 = $result2[1]['days_out_of_stock'];

        $ending_bal_t3 = $result2[2]['closing_stock'];
        $q_requested_t3 = $result2[2]['q_requested'];
        $days_out_of_stock_t3 = $result2[2]['days_out_of_stock'];

        $ending_bal_d3 = $result2[3]['closing_stock'];
        $q_requested_d3 = $result2[3]['q_requested'];
        $days_out_of_stock_d3 = $result2[3]['days_out_of_stock'];

        //based on the results, put them in an array to beused in the excell file.

        $alocation_details[] = array($county,$district,$facility_code,$facility_name,
                                     $ending_bal_s3,$amc_s3,$days_out_of_stock_s3,$q_requested_s3,
                                     $ending_bal_c3,$amc_c3,$days_out_of_stock_c3,$q_requested_c3,
                                     $ending_bal_t3,$amc_t3,$days_out_of_stock_t3,$q_requested_t3,
                                     $ending_bal_d3,$amc_d3,$days_out_of_stock_d3,$q_requested_d3);
}
        // echo"<pre>";print_r($alocation_details);die;
    
         $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Counties');
        //set cell A1 content with some text
        $this->excel->getActiveSheet()->setCellValue('A1', 'Commodity Consumption Data (in Tests)');
        $this->excel->getActiveSheet()->setCellValue('A4', 'County');
        $this->excel->getActiveSheet()->setCellValue('B4', 'Sub-County');
        $this->excel->getActiveSheet()->setCellValue('C4', 'MFL Code');
        $this->excel->getActiveSheet()->setCellValue('D4', 'Facility Name');
        $this->excel->getActiveSheet()->setCellValue('E4', 'Screening KHB');
        $this->excel->getActiveSheet()->setCellValue('I4', 'Confirmatory - First Response');
        $this->excel->getActiveSheet()->setCellValue('M4', 'Tie Breaker');
        $this->excel->getActiveSheet()->setCellValue('Q4', 'DBS Bundles');

        $this->excel->getActiveSheet()->setCellValue('A5', '');
        $this->excel->getActiveSheet()->setCellValue('B5', '');
        $this->excel->getActiveSheet()->setCellValue('C5', '');
        $this->excel->getActiveSheet()->setCellValue('D5', '');

        $this->excel->getActiveSheet()->setCellValue('E5', 'Ending Balance');
        $this->excel->getActiveSheet()->setCellValue('F5', 'AMC');
        $this->excel->getActiveSheet()->setCellValue('G5', 'Days Out of Stock');
        $this->excel->getActiveSheet()->setCellValue('H5', 'Quantity Requested');

        $this->excel->getActiveSheet()->setCellValue('I5', 'Ending Balance');
        $this->excel->getActiveSheet()->setCellValue('J5', 'AMC');
        $this->excel->getActiveSheet()->setCellValue('K5', 'Days Out of Stock');
        $this->excel->getActiveSheet()->setCellValue('L5', 'Quantity Requested');

        $this->excel->getActiveSheet()->setCellValue('M5', 'Ending Balance');
        $this->excel->getActiveSheet()->setCellValue('N5', 'AMC');
        $this->excel->getActiveSheet()->setCellValue('O5', 'Days Out of Stock');
        $this->excel->getActiveSheet()->setCellValue('P5', 'Quantity Requested');
        
        $this->excel->getActiveSheet()->setCellValue('Q5', 'Ending Balance');
        $this->excel->getActiveSheet()->setCellValue('R5', 'AMC');
        $this->excel->getActiveSheet()->setCellValue('S5', 'Days Out of Stock');
        $this->excel->getActiveSheet()->setCellValue('T5', 'Quantity Requested');
        //merge cell A1 until C1
        $this->excel->getActiveSheet()->mergeCells('A1:K1');
        $this->excel->getActiveSheet()->mergeCells('E4:H4');
        $this->excel->getActiveSheet()->mergeCells('I4:L4');
        $this->excel->getActiveSheet()->mergeCells('M4:P4');
        $this->excel->getActiveSheet()->mergeCells('Q4:T4');
        //set aligment to center for that merged cell (A1 to C1)
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('E4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('I4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('M4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('Q4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //make the font become bold
        $this->excel->getActiveSheet()->getStyle('A4:T4')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A5:T5')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
        $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');

       for($col = ord('A'); $col <= ord('Q'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(false);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                 
                //$this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        }
                            
        foreach ($alocation_details as $row){
                $exceldata[] = $row;
        }
        

                //Fill data 
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A6');
                 
                // $this->excel->getActiveSheet()->getStyle('A6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                // $this->excel->getActiveSheet()->getStyle('B6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('C6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                 
                $filename='County Allocation('.$alocation_details[0][1].' Sub-County)'; //save our workbook as this file name

                ob_end_clean(); //cleans output 

                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache

 
                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                //force user to download the Excel file without writing it to server's HD
                $objWriter->save('php://output');          

    }
    function get_commodity_facilities_amcs($commodity){
        //get the amc for the selected commodity
    	if ($commodity == 4){
    		 $sql = "SELECT county, district, mfl, facility_name, amc_s3 as amc FROM allocation_details limit 0,100";
             $commodity_name = 'Screening-KHB';

    	}else if($commodity == 5){
    		 $sql = "SELECT county, district, mfl, facility_name, amc_c3 as amc FROM allocation_details";
             $commodity_name = 'Confirmatory-First Response';

    	}else if($commodity==6){
    		 $sql = "SELECT county, district, mfl, facility_name, amc_t3 as amc FROM allocation_details";
             $commodity_name = 'Tie Breaker';

    	}else if($commodity==7){
    		 $sql = "SELECT county, district, mfl, facility_name, amc_d3 as amc FROM allocation_details";
             $commodity_name = 'DBS Bundles';

    	}       
        $result = $this->db->query($sql)->result_array();
        
        foreach ($result as $key => $id_details) {
        
        $facility_code = $id_details['mfl'];
        // for each selected facility, get the last reported lab details for selected commodity
        $sql2 = "SELECT 
                    closing_stock, days_out_of_stock, q_requested
                FROM
                    lab_commodity_details AS a
                WHERE
                    facility_code = '$facility_code'
                        AND commodity_id = '$commodity'
                        AND created_at IN (SELECT 
                            MAX(created_at)
                        FROM
                            lab_commodity_details AS b
                        WHERE
                            a.facility_code = b.facility_code)";
        $result2 = $this->db->query($sql2)->result_array();

        $county = $id_details['county'];
        $district = $id_details['district'];
        $facility_name = $id_details['facility_name'];
        $amc = $id_details['amc'];       

        $ending_bal = $result2[0]['closing_stock'];
        $q_requested = $result2[0]['q_requested'];
        $days_out_of_stock= $result2[0]['days_out_of_stock'];

     //based on the results, put them in an array to be used in the excel file.

        $alocation_details[] = array($county,$district,$facility_code,$facility_name,
                                     $ending_bal,$amc,$days_out_of_stock,$q_requested);
        }
        // echo"<pre>";print_r($alocation_details);die;
         $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Counties');
        //set cell A1 content with some text
        $this->excel->getActiveSheet()->setCellValue('A1', 'Commodity Consumption Data (in Tests)');
        $this->excel->getActiveSheet()->setCellValue('A4', 'County');
        $this->excel->getActiveSheet()->setCellValue('B4', 'Sub-County');
        $this->excel->getActiveSheet()->setCellValue('C4', 'MFL Code');
        $this->excel->getActiveSheet()->setCellValue('D4', 'Facility Name');
        $this->excel->getActiveSheet()->setCellValue('E4', ' '.$commodity_name.'');
        
        $this->excel->getActiveSheet()->setCellValue('A5', '');
        $this->excel->getActiveSheet()->setCellValue('B5', '');
        $this->excel->getActiveSheet()->setCellValue('C5', '');
        $this->excel->getActiveSheet()->setCellValue('D5', '');

        $this->excel->getActiveSheet()->setCellValue('E5', 'Ending Balance');
        $this->excel->getActiveSheet()->setCellValue('F5', 'AMC');
        $this->excel->getActiveSheet()->setCellValue('G5', 'Days Out of Stock');
        $this->excel->getActiveSheet()->setCellValue('H5', 'Quantity Requested');

        //merge cell A1 until C1
        $this->excel->getActiveSheet()->mergeCells('A1:K1');
        $this->excel->getActiveSheet()->mergeCells('E4:H4');
       
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('E4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //make the font become bold
        $this->excel->getActiveSheet()->getStyle('A4:H4')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A5:H5')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
        $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');

       for($col = ord('A'); $col <= ord('H'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(false);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
        }
                            
        foreach ($alocation_details as $row){
                $exceldata[] = $row;
        }      
                //Fill data 
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A6');
                 
                $this->excel->getActiveSheet()->getStyle('C6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                 
                $filename='Commodity Allocation('.$commodity_name .').xls'; //save our workbook as this file name

                ob_end_clean(); //cleans output 

                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
 
                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                //force user to download the Excel file without writing it to server's HD
                $objWriter->save('php://output');  
    }

     function get_months_facilities_amcs($month){
        $sql = "SELECT * FROM allocation_details where month = '$month'";
        $result = $this->db->query($sql)->result_array();
       
        //convert the date into text
        $year = substr($month, -4);
        $month = substr_replace($month, "", -4);              
        $firstdate = $year . '-' . $month . '-01';     
        $month_text =  date("F Y", strtotime($firstdate)); 

        foreach ($result as $key => $id_details) {
        
        $facility_code = $id_details['mfl'];
        $county = $id_details['county'];
        $district = $id_details['district'];
        $facility_name = $id_details['facility_name'];
        $amc_s3 = $id_details['amc_s3'];
        $amc_c3 = $id_details['amc_c3'];
        $amc_t3 = $id_details['amc_t3'];
        $amc_d3 = 0;        
        
        //based on the results, put them in an array to be used in the excel file.

        $alocation_details[] = array($county,$district,$facility_code,$facility_name,$amc_s3,$amc_c3,$amc_t3,$amc_d3);
}
        // echo"<pre>";print_r($alocation_details);
    
         $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Counties');
        //set cell A1 content with some text
        $this->excel->getActiveSheet()->setCellValue('A1', 'Commodity Consumption Data (in Tests)');
        $this->excel->getActiveSheet()->setCellValue('A4', 'County');
        $this->excel->getActiveSheet()->setCellValue('B4', 'Sub-County');
        $this->excel->getActiveSheet()->setCellValue('C4', 'MFL Code');
        $this->excel->getActiveSheet()->setCellValue('D4', 'Facility Name');
        $this->excel->getActiveSheet()->setCellValue('E4', 'Screening KHB');
        $this->excel->getActiveSheet()->setCellValue('F4', 'Confirmatory - First Response');
        $this->excel->getActiveSheet()->setCellValue('G4', 'Tie Breaker');
        $this->excel->getActiveSheet()->setCellValue('H4', 'DBS Bundles');

        $this->excel->getActiveSheet()->setCellValue('A5', '');
        $this->excel->getActiveSheet()->setCellValue('B5', '');
        $this->excel->getActiveSheet()->setCellValue('C5', '');
        $this->excel->getActiveSheet()->setCellValue('D5', '');
        $this->excel->getActiveSheet()->setCellValue('E5', 'AMC');
        $this->excel->getActiveSheet()->setCellValue('F5', 'AMC');
        $this->excel->getActiveSheet()->setCellValue('G5', 'AMC');
        $this->excel->getActiveSheet()->setCellValue('H5', 'AMC');

        //merge cell A1 until C1
        $this->excel->getActiveSheet()->mergeCells('A1:K1');
        //set aligment to center for that merged cell (A1 to C1)
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('E4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('F4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('G4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('H4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //make the font become bold
        $this->excel->getActiveSheet()->getStyle('A4:H4')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A5:H5')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
        $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');

       for($col = ord('A'); $col <= ord('H'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(false);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                 
        }
                            
        foreach ($alocation_details as $row){
                $exceldata[] = $row;
        }        

                //Fill data 
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A6');
                $this->excel->getActiveSheet()->getStyle('C6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                 
                $filename='Monthly Allocation ('.$month_text.').xls'; //save our workbook as this file name

                ob_end_clean(); //cleans output 
                
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
 
                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                //force user to download the Excel file without writing it to server's HD
                $objWriter->save('php://output');

    }
    function get_combination_facilities_amcs(){
        $sql = "SELECT * FROM allocation_details where district_id = '$district'";
        $result = $this->db->query($sql)->result_array();
        // print_r($result);
        echo json_encode($result);        

    }

}
