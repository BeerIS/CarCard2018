<?php
/*
function ckPID($pid){
	$sum=null;
	if(strlen($pid)<13 || strlen($pid)>13){return false; exit;}
$ck_digi=array(13,12,11,10,9,8,7,6,5,4,3,2);
	for($i=0;$i<12;$i++){
		$sum+=$pid[$i]*$ck_digi[$i];
	}
	$digit=($sum%11);
//echo $digit.'<br>';
	switch($digit){
		case 0:	$digit=1;
		break;
		case 1: $digit=0;
		break;	
		default : $digit=11-$digit;
	}
//echo $digit;
	if($digit==$pid[12]){
		return true;
	}else{
		return false;
	}
}

if(ckPID('3101500347161')){
	echo "รหัสถูกต้อง";
}else{
	echo "รหัสไม่ถูกต้อง";
}*/
include_once("../nusoap/nusoap.php");
$client=new soap_client('http://localhost/dwphp/phpWebService/phpwservice/testws/service/server_test3.php?wsdl','wsdl');
//echo $client->getError();
$res=$client->call('ckPID',array('3101500347161'));
echo $res;
if($res){
	echo $client->call('ckEmail',array('webmaster@dwthai.com'));
}
?>