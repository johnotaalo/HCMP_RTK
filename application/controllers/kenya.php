<?php
/*
 * @author Kariuki & Mureithi
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Kenya extends MY_Controller 
{
    function __construct() 
    {
        parent::__construct();
        $this -> load -> helper(array('form', 'url','file'));
       // $this -> load -> library(array('form_validation','PHPExcel/PHPExcel'));
		$this -> load -> library(array('hcmp_functions', 'form_validation'));
    }
    public function index() {
        $counties = $q = Doctrine_Manager::getInstance()
	        ->getCurrentConnection()
	        ->fetchAll("SELECT c.kenya_map_id as county_fusion_map_id,c.county,count(c.county) as facility_no FROM facilities f 
						INNER JOIN districts d ON f.district=d.id
						INNER JOIN counties c ON d.county=c.id
						where using_hcmp =1 group by c.county");// change  !!!!!!!!!!!!!
	        
	        //get facilities rolled out per county in Nos
	        
        $county_name = array();
        $map = array();
        $datas = array();
        $status = '';
        foreach ($counties as $county) {
            $countyMap = (int)$county['county_fusion_map_id'];
            $countyName = $county['county_name'];
			$facility_No = $county['facility_no'];
            array_push($county_name,array($county['id']=>$countyName));
            $datas[] = array('id' => $countyMap, 
            'value' => $countyName, 
            'value' => $facility_No,
            'color' => '528f42', 
            'tooltext' => $countyName,
            "baseFontColor" => "000000", 
            "link" => "Javascript:run('" .$county['id']. "^" .$countyName. "')");
        }
       
        $map = array( "showlabels"=>'0' , "baseFontColor" => "000000", "canvasBorderColor" => "ffffff", 
        "hoverColor" => "feab3a", "fillcolor" => "F8F8FF", "numbersuffix" => " Facilities", 
        "includevalueinlabels" => "1", "labelsepchar" => ":", "baseFontSize" => "9",
        "borderColor" => "333333 ","showBevel" => "0", 'showShadow' => "0",'showTooltip'=>"1");
        $styles = array("showBorder" => 0 , 'animation'=>"_xScale");
        $finalMap = array('map' => $map, 'data' => $datas, 'styles' => $styles);
		//echo json_encode($finalMap);
		 //var_dump($map);
		 
		$data['county'] = Counties::getAll();
		$data['title'] = "National Dashboard";
		$data['commodities'] = Commodities::get_all();
        $data['maps'] = json_encode($finalMap);
        $data['counties']=$county_name;
		
        $this -> load -> view("national/national_home_v",$data);
    } 

		public function statistics_table($county_id=null, $district_id=null){
			
			$district_id=($district_id=="NULL") ? null :$district_id;
			$county_id=($county_id=="NULL") ? null :$county_id;
			
			$and_data =($district_id>0) ?" AND d.id = '$district_id'" : null;
	    	$and_data .=($county_id>0) ?" AND c.id='$county_id'" : null;
	    	
	    	$group_by =($district_id>0 && isset($county_id) && !isset($facility_code)) ?" ,d.id" : null;
		    $group_by .=($county_id>0 && !isset($district_id)) ?" ,c_.id" : null;
					
			$facilities = $q = Doctrine_Manager::getInstance() ->getCurrentConnection()->fetchAll(
			"SELECT * FROM hcmp_rtk.facilities  f 
				INNER JOIN districts d ON f.district=d.id
				INNER JOIN counties c ON d.county=c.id
				 where using_hcmp =1 $and_data");
				 
			$data['facilities'] = $facilities;
			$this -> load -> view('national/ajax/ajax_table', $data);
			
	
	
}

		public function statistics_pie($county_id=null, $district_id=null,$filtertype=null)
	{
		
		$district_id=($district_id=="NULL") ? null :$district_id;
    $graph_type=($graph_type=="NULL") ? null :$graph_type;
    $county_id=($county_id=="NULL") ? null :$county_id;
    $and =($district_id>0) ?" AND d.id = '$district_id'" : null;
    $and.=($county_id>0) ?" AND c.id='$county_id'" : null;
    $and =isset( $and) ?  $and:null;
    
   if ($filtertype=='activation'||$filtertype=='NULL') {
   	
	$active_inactive= Doctrine_Manager::getInstance()
        ->getCurrentConnection()
        ->fetchAll(" SELECT count(f.using_hcmp) as total FROM facilities  f 
					INNER JOIN districts d ON f.district=d.id INNER JOIN counties c ON d.county=c.id $and  group by f.using_hcmp");
					
					$temp[]=array('Active',(int)$active_inactive[1]['total']);
					$temp[]=array('Inactive',(int)$active_inactive[0]['total']);
					$data['temp'] = json_encode($temp);
       
   }elseif ($filtertype=='owner') {
   	
	$fbo= Doctrine_Manager::getInstance()
        ->getCurrentConnection()
        ->fetchAll(" SELECT count(*) as total
FROM  `facilities` f, districts d, counties c  
WHERE  f.district=d.id and d.county=c.id   $and  and (f.`owner` LIKE  '%fbo%' or f.`owner` LIKE  '%faith%' 
or f.`owner` LIKE  '%christian%' or f.`owner` LIKE  '%catholic%' or f.`owner` LIKE  '%muslim%' 
or f.`owner` LIKE  '%episcopal%' or f.`owner` LIKE  '%cbo%') ");

   $private= Doctrine_Manager::getInstance()
        ->getCurrentConnection()
        ->fetchAll(" SELECT count(*) as total 
FROM  `facilities` f, districts d, counties c  
WHERE  f.district=d.id and d.county=c.id   $and  and (f.`owner` LIKE  '%private%' or f.`owner` LIKE  '%non%' or  f.`owner` LIKE  '%ngo%'
or  f.`owner` LIKE  '%company%' or f.`owner` LIKE  '%armed%') ");

   $public= Doctrine_Manager::getInstance()
        ->getCurrentConnection()
        ->fetchAll("SELECT count(*) as total
FROM  `facilities` f, districts d, counties c
WHERE  f.district=d.id and d.county=c.id   $and  and (f.`owner` LIKE  '%gok%' or f.`owner` LIKE  '%moh%' or f.`owner` LIKE  '%ministry%'
or f.`owner` LIKE  '%community%' or f.`owner` LIKE  '%public%' or f.`owner` LIKE  '%local%' or f.`owner` LIKE  '%g.o.k%' ) ");

$using_hcmp = Doctrine_Manager::getInstance() -> getCurrentConnection() -> fetchAll(" SELECT count(f.id) as total, sum(f.`using_hcmp`) as using_hcmp
      from facilities f, districts d, 
      counties c where f.district=d.id 
      and d.county=c.id 
      $and
      ");

     $other=$using_hcmp[0]['total']-$public[0]['total']-$private[0]['total']-$fbo[0]['total'];
      
     // $pie_data = array('Private' => $private[0]['total'],'Public' =>$public[0]['total'],'Faith-Based' =>$fbo[0]['total'],'Others' =>$other);
		
		$data['private'] = json_encode((int)$private[0]['total']);
		$data['public'] = json_encode((int)$public[0]['total']);
		$data['fbo'] = json_encode((int)$fbo[0]['total']);
		$data['other'] = json_encode((int)$other);
		
		$temp[]=array('public',(int)$public[0]['total']);
		$temp[]=array('private',(int)$private[0]['total']);
		$temp[]=array('fbo',(int)$fbo[0]['total']);
		$temp[]=array('Others',(int)$other);
		
						 	
		$data['temp'] = json_encode($temp);
       
   }elseif ($filtertype=='level') {
   	
	$level= Doctrine_Manager::getInstance()
        ->getCurrentConnection()
        ->fetchAll(" SELECT f.level,count(f.level) as total  FROM hcmp_rtk.facilities  f 
					INNER JOIN districts d ON f.district=d.id INNER JOIN counties c ON d.county=c.id WHERE `level` LIKE '%level%' $and group by f.level");
					//var_dump($level);exit;
					$temp[]=array('Level 2',(int)$level[0]['total']);
					$temp[]=array('Level 3',(int)$level[1]['total']);
					$temp[]=array('Level 4',(int)$level[2]['total']);
					$temp[]=array('Level 5',(int)$level[3]['total']);
					$temp[]=array('Level 6',(int)$level[4]['total']);
					$data['temp'] = json_encode($temp);
       
   }
    $data['colors'] = "['#feab3a', '#4b0082', '#008b8b', '#a52a2a', '#6AF9C4']";
	$this -> load -> view("national/ajax/pie_template",$data);	
	}


public function mos_graph($county_id=null, $district_id=null,$commodity_id=null,$graph_type=null,$div=null)
			{
				
				$district_id=($district_id=="NULL") ? null :$district_id;
	    $graph_type=($graph_type=="NULL") ? null :$graph_type;
	    $facility_code=($facility_code=="NULL") ? null :$facility_code;
	    $county_id=($county_id=="NULL") ? null :$county_id;
		$commodity_id=($commodity_id=="ALL" || $commodity_id=="NULL") ? null :$commodity_id;
	
	    $and_data =($district_id>0) ?" AND sc.id = '$district_id'" : null;
	    $and_data .=($facility_code>0) ?" AND f.facility_code = '$facility_code'" : null;
	    $and_data .=($county_id>0) ?" AND c.id='$county_id'" : null;
	    $and_data =isset( $and_data) ?  $and_data:null;
	    $and_data .=isset($commodity_id) ? "AND d.id =$commodity_id" : "AND d.tracer_item =1";
	    
	    $group_by =($district_id>0 && isset($county_id) && !isset($facility_code)) ?" ,c.id" : null;
	    $group_by .=($facility_code>0 && isset($district_id)) ?"  ,f.facility_code" : null;
	    $group_by .=($county_id>0 && !isset($district_id)) ?" ,c_.id" : null;
	    $group_by =isset( $group_by) ?  $group_by: " ,c_.id";
    
    	$title='';
		
		if(isset($county_id)):
		    $county_name = counties::get_county_name($county_id);   
		    $name=$county_name[0]['county'] ;
		    $title="$name County" ;
	    elseif(isset($district_id)):
		    $district_data = (isset($district_id) && ($district_id > 0)) ? districts::get_district_name($district_id) -> toArray() : null;
		    $district_name_ = (isset($district_data)) ? " :" . $district_data[0]['district'] . " Subcounty" : null;
		    $title = isset($facility_code) && isset($district_id)? "$district_name_ : $facility_name" :
		    		(isset($district_id) && !isset($facility_code) ?  "$district_name_": "$name County") ;
	    elseif(isset($facility_code)):
		    $facility_code_ = isset($facility_code) ? facilities::get_facility_name_($facility_code): null;
		    $title=$facility_code_['facility_name'];
	    else:
	    	$title="National";
	    endif;
		
		
    $facility_issues_array = Doctrine_Manager::getInstance()
        ->getCurrentConnection()
        ->fetchAll("SELECT c.county,c.id,sc.district,sc.id as sc_id,temp.facility_name,temp.facility_code,
d.commodity_name,d.total_commodity_units,d.id as c_id,sum(fi.qty_issued) as total,
sum(fi.qty_issued)/3 as qty_monthly,avg(fi.qty_issued)/(3*d.total_commodity_units) as amc_packs
FROM hcmp_rtk.facility_issues fi 
LEFT JOIN commodities d ON fi.commodity_id=d.id
INNER JOIN( SELECT f.facility_code,f.facility_name,f.district FROM facilities f ) as temp
ON fi.facility_code=temp.facility_code
INNER JOIN districts sc ON temp.district=sc.id
INNER JOIN counties c ON sc.county=c.id
AND fi.date_issued >= DATE_ADD(now(),INTERVAL -3 MONTH)
 $and_data group by d.id
		
		"); 
		
		$facility_stocks_array = Doctrine_Manager::getInstance()
        ->getCurrentConnection()
        ->fetchAll("SELECT c.county,c.id,sc.district,sc.id as sc_id,temp.facility_name,temp.facility_code,
d.commodity_name,d.total_commodity_units,d.id as c_id,avg(fs.current_balance) as total_bal_units,
avg(fs.current_balance)/d.total_commodity_units as total_bal_packs
FROM hcmp_rtk.facility_stocks fs 
LEFT JOIN commodities d ON fs.commodity_id=d.id
INNER JOIN( SELECT f.facility_code,f.facility_name,f.district FROM facilities f ) as temp
ON fs.facility_code=temp.facility_code
INNER JOIN districts sc ON temp.district=sc.id
INNER JOIN counties c ON sc.county=c.id
$and_data and fs.status=1 group by d.id  
		
		"); 
		
		 //var_dump($facility_issues_array)	;exit;
		$category_data = array();
		$qty_issued_units = array();
		$qty_issued_monthly = array();
		$qty_issued_packs = array();
		
		foreach ($facility_issues_array as $value) {
			$category_data[] = $value['commodity_name'];
			$qty_issued_units[] = $value['total'];
			$qty_issued_monthly[] = $value['qty_monthly'];
			$amc_packs[] = $value['amc_packs'];
		}
		
		$total_stock_units = array();
		$total_stock_packs = array();
		
		foreach ($facility_stocks_array as $value) {
			$total_stock_units[] = $value['total_bal_units'];
			$total_stock_packs[] = $value['total_bal_packs'];
		}
		$new=array();
		foreach ($category_data as $row) {
			for ($i=0; $i <count($category_data) ; $i++) { 
			$new[$i]=$merge_array=array( 'commodity_name'=>$category_data[$i],'qty_issued_monthly'=>$qty_issued_monthly[$i],
				'amc_packs'=>$amc_packs[$i],'total_stock_packs'=>$total_stock_packs[$i],'mos'=>$total_stock_packs[$i]/$amc_packs[$i]
				);
			}	
			
		}
		//echo "<pre>"; print_r($new);echo "</pre>"; exit;
		
		$commodities = array();
		$amc = array();
		$mos = array();
		foreach ($new as $value) {
			$commodities[] = $value['commodity_name'];
			$amc[] = (int)$value['amc_packs'];
			$mos[] = (int)$value['mos'];
		}
        
 		
        $data['graph_type'] = 'column';
        $data['graph_title'] = "$title Stock Level in Months of Stock (MOS)";
        $data['graph_yaxis_title'] = "MOS";
        $data['graph_id'] = $div;
        $data['legend'] = "M.O.S";
        $data['colors'] = "['#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4']";
        $data['category_data'] = json_encode($commodities);
        $data['series_data'] =  json_encode($mos);
		$data['series_data2'] =  json_encode($amc);
				
		$this -> load -> view("national/ajax/threashhold_v",$data);
				
			}
public function consumption($county_id=null, $district_id=null,$facility_code=null,$commodity_id=null,$graph_type=null,$from=null,$to=null)
		{
			
			$title='';	
    $district_id=($district_id=="NULL") ? null :$district_id;
    $graph_type=($graph_type=="NULL") ? null :$graph_type;
    $facility_code=($facility_code=="NULL") ? null :$facility_code;
    $county_id=($county_id=="NULL") ? null :$county_id;
    $commodity_id=($commodity_id=="NULL") ? null :$commodity_id;
    
    $from=($from=="NULL" || !isset($from)) ? date('Y-m-01') : date('Y-m-d',strtotime(urldecode($from)));  
    $to=($to=="NULL"  || !isset($to)) ? date('Y-m-d') : date('Y-m-d',strtotime(urldecode($to)));
   
    $and_data =($district_id>0) ?" AND d1.id = '$district_id'" : null;
    $and_data .=($facility_code>0) ?" AND f.facility_code = '$facility_code'" : null;
    $and_data .=($county_id>0) ?" AND c.id='$county_id'" : null;
    $and_data =isset( $and_data) ?  $and_data:null;
    $and_data .=isset($commodity_id) ? "AND d.id =$commodity_id" : "AND d.tracer_item =1";
			
			 $time= "Between ".date('j M y', strtotime($from))." and ".date('j M y',strtotime( $to));
    
    if(isset($county_id)):
	    $county_name = counties::get_county_name($county_id);   
	    $name=$county_name[0]['county'] ;
	    $title="$name County" ;
    elseif(isset($district_id)):
	    $district_data = (isset($district_id) && ($district_id > 0)) ? districts::get_district_name($district_id) -> toArray() : null;
	    $district_name_ = (isset($district_data)) ? " :" . $district_data[0]['district'] . " Subcounty" : null;
	    $title=isset($facility_code) && isset($district_id)? "$district_name_ : $facility_name" :
	    			(isset($district_id) && !isset($facility_code) ?  "$district_name_": "$name County") ;
    elseif(isset($facility_code)):
	    $facility_code_ = isset($facility_code) ? facilities::get_facility_name_($facility_code) : null;
	    $title=$facility_code_['facility_name'];
    else:
    	$title="National";
    endif;
    if($graph_type!="excel"):
    // echo    .$to; exit;
      $commodity_array = Doctrine_Manager::getInstance()
        ->getCurrentConnection()
        ->fetchAll("select d.commodity_name as drug_name,  
		 round(avg(IFNULL(ABS(f_i.`qty_issued`),0) / IFNULL(d.total_commodity_units,0)),1) as total
		 from facilities f,  districts d1, counties c, commodities d left join facility_issues f_i on f_i.`commodity_id`=d.id 
		where f_i.facility_code = f.facility_code 
		and f.district=d1.id 
		and d1.county=c.id 
		and f_i.`qty_issued`>0
		and f_i.created_at between '$from' and '$to'
		$and_data
		group by d.id
        "); 
		
        $category_data = array();
        $series_data =$series_data_ = array();      
        $temp_array =$temp_array_ = array();
        $graph_data=array();
        $graph_type='';
       
        $arrayseries = array();
        foreach ($commodity_array as $data) :
			$arrayseries[] = (int)$data['total'];
        //$series_data = array_merge($series_data, array($data["drug_name"] => (int)$data['total']));
        $category_data = array_merge($category_data, array($data["drug_name"]));
 			endforeach;
  
		$data['graph_type'] = 'bar';
        $data['graph_title'] = "$title Consumption (Packs) $time";
        $data['graph_yaxis_title'] = "Packs";
        $data['graph_id'] = "consumption";
        $data['legend'] = "Packs";
        $data['colors'] = "['#008080','#6AF9C4']";
        $data['category_data'] = json_encode($category_data);
        $data['series_data'] =  json_encode($arrayseries);
				
		$this -> load -> view("national/ajax/bar_template",$data);
				
		
       else:
        $excel_data = array('doc_creator' => "HCMP", 'doc_title' => "$title Consumption (Packs) $time",
         'file_name' => 'Consumption');
        $row_data = array(); 
        $column_data = array("County", "Sub-County", "Facility Name","Facility Code","Item Name","Consumption (Packs)");
        $excel_data['column_data'] = $column_data;
      // echo ; exit;
        $facility_stock_data = Doctrine_Manager::getInstance()
        ->getCurrentConnection()
        ->fetchAll("select 
    c.county,d1.district as subcounty, f.facility_name,f.facility_code, d.commodity_name as drug_name,
    round(avg(IFNULL(ABS(f_i.`qty_issued`), 0) / IFNULL(d.total_commodity_units, 0)),
            1) as total
from
    facilities f,
    districts d1,
    counties c,
    commodities d
left join facility_issues f_i on f_i.`commodity_id`=d.id 
        where f_i.facility_code = f.facility_code 
        and f.district=d1.id 
        and d1.county=c.id 
        and f_i.`qty_issued`>0
        and f_i.created_at between '$from' and '$to'
        $and_data
        group by d.id , f.facility_code
order by c.county asc , d1.district asc
        ");
        
        foreach ($facility_stock_data as $facility_stock_data_item) :
        array_push($row_data, array($facility_stock_data_item["county"],
        $facility_stock_data_item["subcounty"],
        $facility_stock_data_item["facility_name"],
        $facility_stock_data_item["facility_code"],
        $facility_stock_data_item["drug_name"],
        $facility_stock_data_item["total"]
        ));
        endforeach;
        $excel_data['row_data'] = $row_data;
        $this->hcmp_functions->create_excel($excel_data);
endif;
			
			
		}
		
public function orders($year=null,$county_id=null, $district_id=null,$facility_code=null,$graph_type=null){
			
			
		$district_id=($district_id=="NULL") ? null :$district_id;
	    $graph_type=($graph_type=="NULL") ? null :$graph_type;
	    $facility_code=($facility_code=="NULL") ? null :$facility_code;
	    $county_id=($county_id=="NULL") ? null :$county_id;
	    $year=($year=="NULL") ? date('Y') :$year;
	    
	    $and_data =($district_id>0) ?" AND d.id = '$district_id'" : null;
	    $and_data .=($facility_code>0) ?" AND f.facility_code = '$facility_code'" : null;
	    $and_data .=($county_id>0) ?" AND c.id='$county_id'" : null;
	    $and_data .=($year>0) ?" and year(o.`order_date`) =$year" : null;
	    $and_data =isset($year) ?  $and_data:null;
    //echo  ; exit;
            $commodity_array = Doctrine_Manager::getInstance()
        ->getCurrentConnection()
        ->fetchAll("SELECT 
    sum(o.`order_total`) as total,DATE_FORMAT( o.`order_date`,  '%b' ) AS cal_month
FROM
    facilities f, districts d, counties c,`facility_orders` o
WHERE
    o.facility_code=f.facility_code
    and f.district=d.id and d.county=c.id
    $and_data
group by month(o.`order_date`)
        "); 
		$commodity_array_2 = Doctrine_Manager::getInstance() -> getCurrentConnection() -> fetchAll("SELECT 
            sum(o.`order_total`) as total,DATE_FORMAT( o.`order_date`,  '%b' ) AS cal_month
            FROM
                facilities f, districts d, counties c,`facility_orders` o
            WHERE
                o.facility_code=f.facility_code
                and f.district=d.id and d.county=c.id and o.status = 4
                $and_data
            group by month(o.`order_date`)
        ");
	//var_dump($commodity_array);
	//exit;
        $category_data = array();
        $series_data =$series_data_ = array();      
        $temp_array =$temp_array_ = array();
        $graph_data=array();
        
        $title='';
    if($graph_type!="excel"):
    if(isset($county_id)):
    $county_name = counties::get_county_name($county_id);   
    $name=$county_name[0]['county'] ;
    $title="$name county" ;
    elseif(isset($district_id)):
    $district_data = (isset($district_id) && ($district_id > 0)) ? districts::get_district_name($district_id) -> toArray() : null;
    $district_name_ = (isset($district_data)) ? " :" . $district_data[0]['district'] . " Subcounty" : null;
    $title=isset($facility_code) && isset($district_id)? "$district_name_ : $facility_name" :( 
    isset($district_id) && !isset($facility_code) ?  "$district_name_": "$name County") ;
    elseif(isset($facility_code)):
    $facility_code_ = isset($facility_code) ? facilities::get_facility_name_($facility_code) : null;
    $title=$facility_code_['facility_name'];
    else:
    $title="National";
    endif;
        
       
		foreach ($commodity_array as $data) :
				$series_data = array_merge($series_data, array($data["cal_month"] => (int)$data['total']));
				$category_data = array_merge($category_data, array($data["cal_month"]));
			endforeach;

			$series_data2 = $series_data_2 = $category_data_2 = array();
			foreach ($commodity_array_2 as $data_2) :
				$series_data_2 = array_merge($series_data_2, array($data_2["cal_month"] => (int)$data_2['total']));
				$category_data_2 = array_merge($category_data_2, array($data_2["cal_month"]));
			endforeach;
			
			$graph_type = 'spline';

			$graph_data = array_merge($graph_data, array("graph_id" => 'dem_graph_order'));
			$graph_data = array_merge($graph_data, array("graph_title" => "$year $title Order Cost"));
			$graph_data = array_merge($graph_data, array("color" => "['#4b0082','#FFF263', '#6AF9C4']"));
			$graph_data = array_merge($graph_data, array("graph_type" => $graph_type));
			$graph_data = array_merge($graph_data, array("graph_yaxis_title" => "Cost in KSH"));
			$graph_data = array_merge($graph_data, array("graph_categories" => $category_data));
			$graph_data = array_merge($graph_data, array("series_data" => array('Cost of Orders Made' => $series_data, 'Cost of Orders delivered' => $series_data_2)));
			$data = array();
			//var_dump($graph_data);exit;
			//seth
			$data['high_graph'] = $this -> hcmp_functions -> create_high_chart_graph($graph_data);
			// echo $data['high_graph'];exit;

			$data['graph_id'] = 'dem_graph_order';
			return $this -> load -> view("shared_files/report_templates/high_charts_template_v_national", $data);exit;
        
 			
			$series[]=array('data:',$arrayseries);
			$series[]=array('data:',$arrayseries2);
			$name[]=array('name:','cost of order made');
			$name[]=array('name:','cost of order delivered');
 			
		$data['graph_type'] = 'spline';
        $data['graph_title'] = "$year $title Order Cost";
        $data['graph_yaxis_title'] = "Cost in Ksh";
        $data['graph_id'] = "orders";
        $data['legend'] = "Ksh";
		$data['colors'] = "['#4b0082', '#DDDF00', '#FFF263', '#6AF9C4']";
        $data['category_data'] = json_encode($category_data);
        $data['series_data'] =  json_encode($series);
		$data['series_data2'] =  json_encode($name);
				
		return $this -> load -> view("national/ajax/bar_template",$data);			
				
       else:
        $excel_data = array('doc_creator' => "HCMP", 'doc_title' => "$year $title Order Cost",
         'file_name' => "$year $title Order Cost (KSH)");
        $row_data = array(); 
        $column_data = array("Date of Order Placement","Date of Order Approval","Total Order Cost (Ksh)",
        "Date of Delivery","Lead Time (Order Placement to Delivery)",
        "Supplier","Facility Name","Facility Code","Sub-County","County");
        $excel_data['column_data'] = $column_data;
       //echo  ; exit;
        $facility_stock_data = Doctrine_Manager::getInstance()
        ->getCurrentConnection()
        ->fetchAll("SELECT c.county,d.district as sub_county, f.facility_name, f.facility_code, 
        DATE_FORMAT(`order_date`,'%d %b %y') as order_date, 
        DATE_FORMAT(`approval_date`,'%d %b %y')  as approval_date,
        DATE_FORMAT(`deliver_date`,'%d %b %y')  as delivery_date, 
        DATEDIFF(`approval_date`,`order_date`) as tat_order_approval,
        DATEDIFF(`deliver_date`,`approval_date`) as tat_approval_deliver,
        DATEDIFF(`deliver_date`,`order_date`) as tat_order_delivery
        , sum(o.`order_total`) as total 
        from facility_orders o, facilities f, districts d, counties c 
        where f.facility_code=o.facility_code and f.district=d.id 
        and c.id=d.county $and_data
        group by o.id order by c.county asc ,d.district asc , 
         f.facility_name asc 
        ");
        array_push($row_data, array("The orders below were placed $year $title"));
        foreach ($facility_stock_data as $facility_stock_data_item) :
        array_push($row_data, array(
        $facility_stock_data_item["order_date"],
        $facility_stock_data_item["approval_date"],
        $facility_stock_data_item["total"],
        $facility_stock_data_item["delivery_date"],
        $facility_stock_data_item["tat_order_delivery"],
        "KEMSA",
        $facility_stock_data_item["facility_name"],
        $facility_stock_data_item["facility_code"],
        $facility_stock_data_item["sub_county"],
        $facility_stock_data_item["county"]
        ));
        endforeach;
        $excel_data['row_data'] = $row_data;
        $this->hcmp_functions->create_excel($excel_data);
endif;
		}
		
		public function expiry($year = null, $county_id = null, $district_id = null, $facility_code = null, $graph_type = null) {
		$year = ($year == "NULL") ? date('Y') : $year;
		/*//Get the current month

		 $datetime1 = new DateTime('Y-10');
		 $datetime2 = new DateTime('Y-12');
		 $interval = $datetime2->diff($datetime1);
		 echo $interval->format('%R%a days');exit;
		 $current_month = date("Y-m");
		 $end = date('Y-12');

		 $interval = $current_month->diff($end);
		 echo $interval;exit;*/
		//check if the district is set
		$district_id = ($district_id == "NULL") ? null : $district_id;
		// $option=($optionr=="NULL") ? null :$option;
		$facility_code = ($facility_code == "NULL") ? null : $facility_code;
		$county_id = ($county_id == "NULL") ? null : $county_id;
		// $months = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
		$month_ = isset($month) ? $months[(int)$month - 1] : null;

		$category_data = array();
		$series_data = $series_data2 = $series_data_ = $series_data_2 = array();
		$temp_array = $temp_array2 = $temp_array_ = array();
		$graph_data = array();
		$title = '';

		if (isset($county_id)) :
			$county_name = counties::get_county_name($county_id);
			$name = $county_name['county'];
			$title = "$name County";
		elseif (isset($district_id)) :
			$district_data = (isset($district_id) && ($district_id > 0)) ? districts::get_district_name($district_id) -> toArray() : null;
			$district_name_ = (isset($district_data)) ? " :" . $district_data[0]['district'] . " Subcounty" : null;
			$title = isset($facility_code) && isset($district_id) ? "$district_name_ : $facility_name" : (isset($district_id) && !isset($facility_code) ? "$district_name_" : "$name County");
		elseif (isset($facility_code)) :
			$facility_code_ = isset($facility_code) ? facilities::get_facility_name_($facility_code) : null;
			$title = $facility_code_['facility_name'];
		else :
			$title = "";
		endif;

		$months = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
		$category_data = array_merge($category_data, $months);
		$and_data = ($district_id > 0) ? " AND d1.id = '$district_id'" : null;
		$and_data .= ($facility_code > 0) ? " AND f.facility_code = '$facility_code'" : null;
		$and_data .= ($county_id > 0) ? " AND d1.county='$county_id'" : null;
		$and_data = isset($and_data) ? $and_data : null;

		$group_by = ($district_id > 0 && isset($county_id) && !isset($facility_code)) ? " ,d1.id" : null;
		$group_by .= ($facility_code > 0 && isset($district_id)) ? "  ,f.facility_code" : null;
		$group_by .= ($county_id > 0 && !isset($district_id)) ? " ,c.id" : null;
		$group_by = isset($group_by) ? $group_by : " ,c.id";
		if ($graph_type != "excel") :
			$commodity_array = Doctrine_Manager::getInstance() -> getCurrentConnection() -> fetchAll("select DATE_FORMAT( temp.expiry_date,  '%b' ) AS cal_month,
	    			sum(temp.total) as total
				from
				    districts d1,
				    facilities f
				        left join
				    (select ROUND(SUM(f_s.current_balance / d.total_commodity_units) * d.unit_cost, 1) AS total,
				            f_s.facility_code,f_s.expiry_date
				    from
				        facility_stocks f_s, commodities d
				    where
				        f_s.expiry_date < NOW()
				            and d.id = f_s.commodity_id
				            and year(f_s.expiry_date) = $year
				            AND  (f_s.status =1 or f_s.status =2 )
				    GROUP BY d.id , f_s.facility_code having total > 1) 
			    temp ON temp.facility_code = f.facility_code
					where
					    f.district = d1.id
					       $and_data
					        and temp.total > 0
					group by month(temp.expiry_date)");
			$commodity_array2 = Doctrine_Manager::getInstance() -> getCurrentConnection() -> fetchAll("
			select 
			    DATE_FORMAT( temp.expiry_date,  '%b' ) AS cal_month,
			    sum(temp.total) as total
			from
			    districts d1,
			    facilities f
			        left join
			    (select 
			        ROUND(SUM(f_s.current_balance / d.total_commodity_units) * d.unit_cost, 1) AS total,
			            f_s.facility_code,f_s.expiry_date
			    from
			        facility_stocks f_s, commodities d
			    where
			        f_s.expiry_date >= NOW()
			            and d.id = f_s.commodity_id
			            AND f_s.status = (1 or 2)
						AND year(f_s.expiry_date) = $year
			    GROUP BY d.id , f_s.facility_code
			    having total > 1) temp ON temp.facility_code = f.facility_code
			where
			    f.district = d1.id
			       $and_data
			        and temp.total > 0
			group by month(temp.expiry_date)
		        ");

			foreach ($commodity_array as $data) :
				$temp_array = array_merge($temp_array, array($data["cal_month"] => $data['total']));
			endforeach;
			foreach ($commodity_array2 as $data2) :
				$temp_array2 = array_merge($temp_array2, array($data2["cal_month"] => $data2['total']));
				//$series_data2 = array_merge($series_data2, array($data2["cal_month"] => (int)$data2['total']));
				//$category_data = array_merge($category_data, array($data2["cal_month"]));
			endforeach;
			//  echo "<pre>";print_r($temp_array2);echo "</pre>";exit;

			foreach ($months as $key => $data) :
				//for expiries
				$val = (array_key_exists($data, $temp_array)) ? (int)$temp_array[$data] : (int)0;
				$series_data = array_merge($series_data, array($val));
				array_push($series_data_, array($data, $val));

				//for potential expiries
				$val2 = (array_key_exists($data, $temp_array2)) ? (int)$temp_array2[$data] : (int)0;
				$series_data2 = array_merge($series_data2, array($val2));
				array_push($series_data_2, array($data, $val2));
			endforeach;
			$graph_type = 'column';

			$graph_data = array_merge($graph_data, array("graph_id" => 'dem_graph_'));
			$graph_data = array_merge($graph_data, array("color" => "['#6AF9C4','#4b0082', '#6AF9C4']"));
			$graph_data = array_merge($graph_data, array("graph_title" => "Expiries in $title $year"));
			$graph_data = array_merge($graph_data, array("graph_type" => $graph_type));
			$graph_data = array_merge($graph_data, array("graph_yaxis_title" => "KSH"));
			$graph_data = array_merge($graph_data, array("graph_categories" => $category_data));
			$graph_data = array_merge($graph_data, array("series_data" => array()));

			//$default_expiries=array_merge($default_expiries,array("series_data"=>array()));
			$graph_data['series_data'] = array_merge($graph_data['series_data'], array("Potential Expiries" => $series_data2, "Actual Expiries" => $series_data));
			//echo "<pre>";print_r($graph_data);echo "</pre>";exit;
			$data = array();
			$data['graph_id'] = 'dem_graph_';
			$data['high_graph'] = $this -> hcmp_functions -> create_high_chart_graph($graph_data);

			// print_r($data['high_graph']);
			//exit;
			return $this -> load -> view("shared_files/report_templates/high_charts_template_v_national", $data);
		else :
			$excel_data = array('doc_creator' => "HCMP", 'doc_title' => "Expiry  $title", 'file_name' => "Stock Expired in $title  $year");
			$row_data = array();
			$column_data = array("Commodity", "Unit Size", "Quantity (Packs)", "Quantity (Units)", "Unit Cost (Ksh)", "Total Cost Expired (Ksh)", "Date of Expiry", "Supplier", "Manufacturer", "Facility Name", "Facility Code", "Sub-County", "County");
			$excel_data['column_data'] = $column_data;
			//echo  ; exit;
			$facility_stock_data = Doctrine_Manager::getInstance() -> getCurrentConnection() -> fetchAll("select  c.county, d1.district as subcounty ,temp.drug_name,
 f.facility_code, f.facility_name,temp.manufacture, sum(temp.total) as total_ksh,temp.units,
temp.unit_cost,temp.expiry_date,temp.unit_size,
temp.packs
from districts d1, counties c, facilities f left join
     (
select  ROUND( SUM(
f_s.current_balance  / d.total_commodity_units ) * d.unit_cost, 1) AS total,
 ROUND( SUM( f_s.current_balance  / d.total_commodity_units  ), 1) as packs,
SUM( f_s.current_balance) as units,
f_s.facility_code,d.id,d.commodity_name as drug_name, f_s.manufacture,
f_s.expiry_date,d.unit_size,d.unit_cost

 from facility_stocks f_s, commodities d
where f_s.expiry_date < NOW( ) 
and d.id=f_s.commodity_id
and year(f_s.expiry_date) !=1970
AND (f_s.status =1 or f_s.status =2)
GROUP BY d.id,f_s.facility_code having total >1

     ) temp
     on temp.facility_code = f.facility_code
where  f.district = d1.id
and c.id=d1.county
and temp.total>0
$and_data
group by temp.id,f.facility_code
order by temp.drug_name asc,temp.total asc, temp.expiry_date desc
        ");
			array_push($row_data, array("The below commodities have expired $title  $year"));
			foreach ($facility_stock_data as $facility_stock_data_item) :
				array_push($row_data, array($facility_stock_data_item["drug_name"], $facility_stock_data_item["unit_size"], $facility_stock_data_item["packs"], $facility_stock_data_item["units"], $facility_stock_data_item["unit_cost"], $facility_stock_data_item["total_ksh"], $facility_stock_data_item["expiry_date"], "KEMSA", $facility_stock_data_item["manufacture"], $facility_stock_data_item["facility_name"], $facility_stock_data_item["facility_code"], $facility_stock_data_item["subcounty"], $facility_stock_data_item["county"]));
			endforeach;
			$excel_data['row_data'] = $row_data;

			$this -> hcmp_functions -> create_excel($excel_data);
		endif;

	}
	
}   
    

?>