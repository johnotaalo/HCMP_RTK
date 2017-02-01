<?php
	

	ini_set('max_execution_time', -1);
$link = mysql_connect('localhost', 'root', '');
if (!$link) {
    die('Not connected : ' . mysql_error());
}

// make foo the current db
$db_selected = mysql_select_db('hcmp_rtk', $link);
if (!$db_selected) {
    die ('Can\'t use foo : ' . mysql_error());
}


$rec=0;
$handle = fopen ('counties.csv', 'r'); //this is the csv file wth the mfl codes and partner ids ( ensure this csv is in same folder as the upload script )
$count=0;
		while (($data = fgetcsv($handle, 1000, ',', '"')) !== FALSE)
		{
			$rec++;
			if($rec==1)
			{
			continue;
			}
			else
			{
				//echo $data[0] .'<br/>' ; 
			
$import = mysql_query("update counties set zone='$data[1]'where id='$data[0]'") or die(mysql_error());
						   //rename facility, mfl code to actual attribute names on the hcmp database a
					if ($import)
					{
						$count=$count+1;
					}	   
					else
					{

					}				
			
			} //end else rec
		}// end while
		
		if ($import)
		{
		echo $count . " Facility Records updated";
		}
		else
		{
		echo "Failed Updating, Try again ";
		}
		

?>