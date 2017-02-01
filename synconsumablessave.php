<?php
error_reporting(0);
$dbh1 = mysql_connect("localhost", "root", ""); 
mysql_select_db('hcmp_rtk', $dbh1);

$TP=$_GET['TP'];
$AP=$_GET['AP'];
$RQ=$_GET['RQ'];
$TD=$_GET['TD'];
$AD=$_GET['AD'];

if ($TP==1 && $AP==0 && $RQ==0 && $AD==0 && $TD==0 )
{
	$testtype= $_GET['testtype'];
	$testsdone= $_GET['testsdone'];
	$endingqualkit= $_GET['endingqualkit'];
	$endingspexagent= $_GET['endingspexagent'];
	$endingampinput=$_GET['endingampinput'];
	$endingampflapless=$_GET['endingampflapless'];
	$endingampktips=$_GET['endingampktips'];
	$endingampwash=$_GET['endingampwash'];
	$endingktubes=$_GET['endingktubes'];
	$endingconsumables=$_GET['endingconsumables'];
	$wastedqualkit=$_GET['wastedqualkit'];
	$wastedspexagent=$_GET['wastedspexagent'];
	$wastedampinput=$_GET['wastedampinput'];
	$wastedampflapless=$_GET['wastedampflapless'];
	$wastedampktips=$_GET['wastedampktips'];
	$wastedampwash=$_GET['wastedampwash'];
	$wastedktubes=$_GET['wastedktubes'];
	$wastedconsumables=$_GET['wastedconsumables'];
	$issuedqualkit=$_GET['issuedqualkit'];
	$issuedspexagent=$_GET['issuedspexagent'];
	$issuedampinput=$_GET['issuedampinput'];
	$issuedampflapless=$_GET['issuedampflapless'];
	$issuedampktips=$_GET['issuedampktips'];
	$issuedampwash=$_GET['issuedampwash'];
	$issuedktubes=$_GET['issuedktubes'];
	$issuedconsumables=$_GET['issuedconsumables'];
	$requestqualkit=$_GET['requestqualkit'];
	$requestspexagent=$_GET['requestspexagent'];
	$requestampinput=$_GET['requestampinput'];
	$requestampflapless=$_GET['requestampflapless'];
	$requestampktips=$_GET['requestampktips'];
	$requestampwash=$_GET['requestampwash'];
	$requestktubes=$_GET['requestktubes'];
	$requestconsumables=$_GET['requestconsumables'];
	$monthofrecordset=$_GET['monthofrecordset'];
	$yearofrecordset=$_GET['yearofrecordset'];
	$datesubmitted=$_GET['datesubmitted'];
	$submittedby=$_GET['submittedby'];
	$lab=$_GET['lab'];
	$comments=$_GET['comments'];
	$issuedcomments=$_GET['issuedcomments'];
	$approve=$_GET['approve'];
	$disapprovereason=	$_GET['disapprovereason'];		
	$posqualkit=$_GET['posqualkit'];		
	$posspexagent=$_GET['posspexagent'];		
	$posampinput=$_GET['posampinput'];		
	$posflapless=$_GET['posflapless'];		
	$posampktips=$_GET['posampktips'];		
	$posampwash=$_GET['posampwash'];		
	$posktubes=$_GET['posktubes'];		
	$posconsumables=$_GET['posconsumables'];		
	
	
	
	
	
	//..positive adjustments
	/*$pqualkit 		= $_POST['pqualkit'];
	$pspexagent 	= $_POST['pspexagent'];
	$pampinput 		= $_POST['pampinput'];
	$pampflapless 	= $_POST['pampflapless'];
	$pampktips 		= $_POST['pampktips'];
	$pampwash		= $_POST['pampwash'];
	$pktubes 		= $_POST['pktubes'];
	$pconsumables	= $_POST['pconsumables'];*/

	
		$insert_tp_items = mysql_query("INSERT INTO 		
eid_taqmanprocurement (testtype,testsdone,endingqualkit,endingspexagent,endingampinput,endingampflapless,endingampktips,endingampwash,endingktubes,endingconsumables,wastedqualkit,wastedspexagent,wastedampinput,wastedampflapless,wastedampktips,wastedampwash,wastedktubes,wastedconsumables, issuedqualkit, issuedspexagent, issuedampinput, issuedampflapless, issuedampktips, issuedampwash, issuedktubes, issuedconsumables,requestqualkit,requestspexagent,requestampinput,requestampflapless,requestampktips,requestampwash,requestktubes,requestconsumables, monthofrecordset, yearofrecordset, datesubmitted, submittedby, lab, comments, issuedcomments, approve, disapprovereason, posqualkit, posspexagent, posampinput, posampflapless, posampktips, posampwash, posktubes, posconsumables)
VALUES
('$testtype','$testsdone','$endingqualkit','$endingspexagent','$endingampinput','$endingampflapless','$endingampktips','$endingampwash','$endingktubes','$endingconsumables','$wastedqualkit','$wastedspexagent','$wastedampinput','$wastedampflapless','$wastedampktips','$wastedampwash','$wastedktubes','$wastedconsumables','$issuedqualkit','$issuedspexagent','$issuedampinput','$issuedampflapless','$issuedampktip','$issuedampwash','$issuedktubes','$issuedconsumables','$requestqualkit','$requestspexagent','$requestampinput','$requestampflapless','$requestampktips','$requestampwash','$requestktubes','$requestconsumables','$monthofrecordset','$yearofrecordset','$datesubmitted','$submittedby','$lab','$comments','$issuedcomments','$approve','$disapprovereason','$posqualkit','$posspexagent','$posampinput','$posflapless', '$posampktips','$posampwash','$posktubes','$posconsumables') ", $dbh1) OR die (mysql_error());
						

		if ($insert_tp_items) //tAQ PROCUREMENT rec succesfully updated
		{
		echo "1";
		} 

}//end if tAQMAN pROCUREMENT  records
elseif 	($TP==0 && $AP==1 && $RQ==0 && $AD==0 && $TD==0 )
{
$testtype =$_GET['testtype']; 
$testsdone =$_GET['testsdone'] ; 
$endingqualkit  =$_GET['endingqualkit'];
$endingcalibration  =$_GET['endingcalibration']; 
$endingcontrol  =$_GET['endingcontrol'] ; 
$endingbuffer  =$_GET['endingbuffer']; 
$endingpreparation  =$_GET['endingpreparation']; 
$endingadhesive =$_GET['endingadhesive'];
$endingdeepplate =$_GET['endingdeepplate']; 
$endingmixtube =$_GET['endingmixtube'];
$endingreactionvessels =$_GET['endingreactionvessels']; 
$endingreagent =$_GET['endingreagent']; 
$endingreactionplate =$_GET['endingreactionplate'];
$ending1000disposable =$_GET['ending1000disposable']; 
$ending200disposable =$_GET['ending200disposable']; 
$wastedqualkit =$_GET['wastedqualkit']; 
$wastedcalibration =$_GET['wastedcalibration']; 
$wastedcontrol =$_GET['wastedcontrol']; 
$wastedbuffer =$_GET['wastedbuffer'];
$wastedpreparation =$_GET['wastedpreparation']; 
$wastedadhesive =$_GET['wastedadhesive']; 
$wasteddeepplate =$_GET['wasteddeepplate'];
$wastedmixtube =$_GET['wastedmixtube']; 
$wastedreactionvessels =$_GET['wastedreactionvessels']; 
$wastedreagent =$_GET['wastedreagent']; 
$wastedreactionplate =$_GET['wastedreactionplate']; 
$wasted1000disposable =$_GET['wasted1000disposable'];
$wasted200disposable =$_GET['wasted200disposable'];
$issuedqualkit =$_GET['issuedqualkit']; 
$issuedcalibration =$_GET['issuedcalibration'];
$issuedcontrol =$_GET['issuedcontrol']; 
$issuedbuffer =$_GET['issuedbuffer'];
$issuedpreparation =$_GET['issuedpreparation'];
$issuedadhesive =$_GET['issuedadhesive']; 
$issueddeepplate =$_GET['issueddeepplate']; 
$issuedmixtube =$_GET['issuedmixtube'];
$issuedreactionvessels =$_GET['issuedreactionvessels']; 
$issuedreagent =$_GET['issuedreagent']; 
$issuedreactionplate =$_GET['issuedreactionplate'];
$issued1000disposable =$_GET['issued1000disposable']; 
$issued200disposable=$_GET['issued200disposable'];
$requestqualkit=$_GET['requestqualkit'];
$requestcalibration=$_GET['requestcalibration'];
$requestcontrol=$_GET['requestcontrol']; 
$requestbuffer=$_GET['requestbuffer'];
$requestpreparation=$_GET['requestpreparation'];
$requestadhesive=$_GET['requestadhesive']; 
$requestdeepplate=$_GET['requestdeepplate'];
$requestmixtube=$_GET['requestmixtube'];
$requestreactionvessels=$_GET['requestreactionvessels'];
$requestreagent=$_GET['requestreagent']; 
$requestreactionplate=$_GET['requestreactionplate']; 
$request1000disposable=$_GET['request1000disposable']; 
$request200disposable=$_GET['request200disposable']; 
$monthofrecordset=$_GET['monthofrecordset']; 
$yearofrecordset=$_GET['yearofrecordset']; 
$datesubmitted=$_GET['datesubmitted'];
$submittedby=$_GET['submittedby'];
$lab=$_GET['lab'];
$comments=$_GET['comments'];
$issuedcomments=$_GET['issuedcomments'];
$approve=$_GET['approve'];
$disapprovereason=	$_GET['disapprovereason'];	
	
$posqualkit=$_GET['posqualkit'];
$poscalibration=$_GET['poscalibration'];
$poscontrol=$_GET['poscontrol'];
$posbuffer=$_GET['posbuffer'];
$pospreparation=$_GET['pospreparation'];
$posadhesive=$_GET['posadhesive'];
$posdeepplate=$_GET['posdeepplate'];
$posmixtube=$_GET['posmixtube'];
$posreactionvessels=$_GET['posreactionvessels'];
$posreagent=$_GET['posreagent'];
$posreactionplate=$_GET['posreactionplate'];
$pos1000disposable=$_GET['pos1000disposable'];
$pos200disposable=$_GET['pos200disposable'];
	

$insert_ap_items = mysql_query("INSERT INTO 		
					eid_abbottprocurement
						(testtype, testsdone, endingqualkit, endingcalibration, endingcontrol, endingbuffer, endingpreparation, endingadhesive, endingdeepplate, endingmixtube, endingreactionvessels, endingreagent, endingreactionplate, ending1000disposable, ending200disposable, wastedqualkit, wastedcalibration, wastedcontrol, wastedbuffer,wastedpreparation,wastedadhesive,wasteddeepplate, wastedmixtube, wastedreactionvessels, wastedreagent, wastedreactionplate, wasted1000disposable, wasted200disposable, issuedqualkit, issuedcalibration, issuedcontrol, issuedbuffer,issuedpreparation,issuedadhesive,issueddeepplate,issuedmixtube,issuedreactionvessels, issuedreagent, issuedreactionplate, issued1000disposable, issued200disposable,requestqualkit, requestcalibration, requestcontrol, requestbuffer,requestpreparation,requestadhesive,requestdeepplate,requestmixtube,requestreactionvessels,requestreagent,requestreactionplate, request1000disposable, request200disposable, monthofrecordset, yearofrecordset, datesubmitted, submittedby, lab, comments, issuedcomments, approve, disapprovereason, posqualkit, poscalibration, poscontrol,posbuffer,pospreparation,posadhesive,posdeepplate, posmixtube, posreactionvessels, posreagent, posreactionplate, pos1000disposable, pos200disposable)
					VALUES
('$testtype','$testsdone','$endingqualkit','$endingcalibration','$endingcontrol','$endingbuffer','$endingpreparation','$endingadhesive', '$endingdeepplate', '$endingmixtube', '$endingreactionvessels','$endingreagent','$endingreactionplate','$ending1000disposable', '$ending200disposable','$wastedqualkit','$wastedcalibration','$wastedcontrol','$wastedbuffer','$wastedpreparation','$wastedadhesive', '$wasteddeepplate', '$wastedmixtube', '$wastedreactionvessels', '$wastedreagent', '$wastedreactionplate', '$wasted1000disposable', '$wasted200disposable','$issuedqualkit','$issuedcalibration','$issuedcontrol','$issuedbuffer','$issuedpreparation','$issuedadhesive', '$issueddeepplate', '$issuedmixtube', '$issuedreactionvessels', '$issuedreagent', '$issuedreactionplate', '$issued1000disposable', '$issued200disposable','$requestqualkit','$requestcalibration','$requestcontrol','$requestbuffer','$requestpreparation','$requestadhesive','$requestdeepplate','$requestmixtube','$requestreactionvessels','$requestreagent','$requestreactionplate','$request1000disposable','$request200disposable','$monthofrecordset','$yearofrecordset','$datesubmitted','$submittedby','$lab','$comments','$issuedcomments','$approve', '$disapprovereason' , '$posqualkit','$poscalibration','$poscontrol','$posbuffer','$pospreparation','$posadhesive', '$posdeepplate', '$posmixtube', '$posreactionvessels', '$posreagent','$posreactionplate','$pos1000disposable','$pos200disposable')", $dbh1) OR die (mysql_error());

		if ($insert_ap_items) //abbott PROCUREMENT rec succesfully updated
		{
		echo "1";
		} 

}//end if aBBOTT PROCUREMENT records
elseif 	($TP==0 && $AP==0 && $RQ==1 && $AD==0 && $TD==0)
{
$facility=$_GET['facility'];
$lab=$_GET['lab'];
$comments=$_GET['comments'];
$datecreated=$_GET['datecreated'];
$flag=$_GET['flag'];
$parentid=$_GET['parentid'];
$requisitiondate=$_GET['requisitiondate'];
$datemodified=$_GET['datemodified'];
$request=$_GET['request'];
$supply=$_GET['supply'];
$createdby=$_GET['createdby'];
$dateapproved=$_GET['dateapproved'];
$approvedby=$_GET['approvedby'];
$approvecomments=$_GET['approvecomments'];
$disapprovecomments=$_GET['disapprovecomments'];
		
					$insert_rq_items = mysql_query("
INSERT INTO 		
	requisitions(facility,lab,comments,datecreated,flag,parentid,requisitiondate,datemodified,request,supply,createdby,dateapproved,approvedby)
VALUES
				('$facility','$lab','$comments','$datecreated','$flag','$parentid','$requisitiondate','$datemodified','$request','$supply','$createdby','$dateapproved','$approvedby')", $dbh1);
				if ($insert_rq_items) //abbott PROCUREMENT rec succesfully updated
				{
					echo "1";
				} 

}//end if REQUISITION records
elseif 	($TP==0 && $AP==0 && $RQ==0 && $AD==0 && $TD==1) // INSERT TAQMAND ELVIERIES
{
$testtype=$_GET['testtype'];
$lab=$_GET['lab'];
$quarter=$_GET['quarter'];
$source=$_GET['source'];
$kitlotno=$_GET['kitlotno'];
$expirydate=$_GET['expirydate'];
$qualkitreceived=$_GET['qualkitreceived'];
$qualkitdamaged=$_GET['qualkitdamaged'];
$spexagentdamaged=$_GET['spexagentdamaged'];
$ampinputdamaged=$_GET['ampinputdamaged'];
$ampflaplessdamaged=$_GET['ampflaplessdamaged'];
$ampktipsdamaged=$_GET['ampktipsdamaged'];
$ampwashdamaged=$_GET['ampwashdamaged'];
$ktubesdamaged=$_GET['ktubesdamaged'];
$consumablesdamaged=$_GET['consumablesdamaged'];
$receivedby=$_GET['receivedby'];
$datereceived=$_GET['datereceived'];
$status=$_GET['status'];
$dateentered=$_GET['dateentered'];
$enteredby=$_GET['enteredby'];
//..TAQMAN INSERT INTO DELIVERIES
$insert_au_taqman = mysql_query("INSERT INTO         
                    eid_taqmandeliveries
                        (testtype,lab,quarter,source,kitlotno,expirydate,qualkitreceived,qualkitdamaged,spexagentdamaged,ampinputdamaged,ampflaplessdamaged,ampktipsdamaged,ampwashdamaged,ktubesdamaged,consumablesdamaged,receivedby,datereceived,status,dateentered,enteredby)
                    VALUES
                        ('$testtype','$lab','$quarter','$source','$kitlotno','$expirydate','$qualkitreceived','$qualkitdamaged','$spexagentdamaged','$ampinputdamaged','$ampflaplessdamaged','$ampktipsdamaged','$ampwashdamaged','$ktubesdamaged','$consumablesdamaged','$receivedby','$datereceived','$status','$dateentered','$enteredby')", $dbh1) or die(mysql_error());
if ($insert_au_taqman) //TAQMAN DELVIERY  rec succesfully updated
				{
					echo "1";
				} 
}
elseif 	($TP==0 && $AP==0 && $RQ==0 && $AD ==1 && $TD ==0) // INSERT ABBOTT ELVIERIES
{
$testtype=$_GET['testtype'];
$lab=$_GET['lab'];
$quarter=$_GET['quarter'];
$source=$_GET['source'];
$qualkitlotno=$_GET['qualkitlotno'];
$calibrationlotno=$_GET['calibrationlotno'];
$controllotno=$_GET['controllotno'];
$bufferlotno=$_GET['bufferlotno'];
$preparationlotno=$_GET['preparationlotno'];
$qualkitexpiry=$_GET['qualkitexpiry'];
$calibrationexpiry=$_GET['calibrationexpiry'];
$controlexpiry=$_GET['controlexpiry'];
$bufferexpiry=$_GET['bufferexpiry'];
$preparationexpiry=$_GET['preparationexpiry'];
$qualkitreceived=$_GET['qualkitreceived'];
$qualkitdamaged=$_GET['qualkitdamaged'];
$calibrationdamaged=$_GET['calibrationdamaged'];
$controldamaged=$_GET['controldamaged'];
$bufferdamaged=$_GET['bufferdamaged'];
$preparationdamaged=$_GET['preparationdamaged'];
$adhesivedamaged=$_GET['adhesivedamaged'];
$deepplatedamaged=$_GET['deepplatedamaged'];
$mixtubedamaged=$_GET['mixtubedamaged'];
$reactionvesselsdamaged=$_GET['reactionvesselsdamaged'];
$reagentdamaged=$_GET['reagentdamaged'];
$reactionplatedamaged=$_GET['reactionplatedamaged'];
$disposable1000damaged=$_GET['disposable1000damaged'];
$disposable200damaged=$_GET['disposable200damaged'];
$receivedby=$_GET['receivedby'];
$datereceived=$_GET['datereceived'];
$status=$_GET['status'];
$dateentered=$_GET['dateentered'];
$enteredby=$_GET['enteredby'];

//..ABBOTT INSERT INTO DELIVERIES
$insert_au_abbott = mysql_query("INSERT INTO         
                    eid_abbottdeliveries                        (testtype,lab,quarter,source,qualkitlotno,calibrationlotno,controllotno,bufferlotno,preparationlotno,qualkitexpiry,calibrationexpiry,controlexpiry,bufferexpiry,preparationexpiry,qualkitreceived,qualkitdamaged,calibrationdamaged,controldamaged,bufferdamaged,preparationdamaged,adhesivedamaged,deepplatedamaged,mixtubedamaged,reactionvesselsdamaged,reagentdamaged,reactionplatedamaged,disposable1000damaged,disposable200damaged,receivedby,datereceived,status,dateentered,enteredby)
                    VALUES
                        ('$testtype','$lab','$quarter','$source','$qualkitlotno','$calibrationlotno','$controllotno','$bufferlotno','$preparationlotno','$qualkitexpiry','$calibrationexpiry','$controlexpiry','$bufferexpiry','$preparationexpiry','$qualkitreceived','$qualkitdamaged','$calibrationdamaged','$controldamaged','$bufferdamaged','$preparationdamaged','$adhesivedamaged','$deepplatedamaged','$mixtubedamaged','$reactionvesselsdamaged','$reagentdamaged','$reactionplatedamaged','$disposable1000damaged','$disposable200damaged','$receivedby','$datereceived','$status','$dateentered','$enteredby')", $dbh1) or die(mysql_error());
if ($insert_au_abbott) //ABBOTT DELVIERY  rec succesfully updated
				{
					echo "1";
				} 
}
		
	
	
	
	
            

				
					
?>

