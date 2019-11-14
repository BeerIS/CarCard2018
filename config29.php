<?php
	$host="10.20.192.29";
	$uname="devadmin";
	$pass="devadmin";
	$db_name="car_card_regis_2018";
	
	$conn = mysqli_connect($host,$uname,$pass);
	
	if (!$conn) {
    	die("Connection failed: " . mysqli_connect_error());
	}
	mysqli_select_db($conn,$db_name) or die("ติดต่อฐานข้อมูลไม่ได้");
	
	//set for thai language
	mysqli_set_charset($conn,"utf8");
	//echo "Connection";
	    
?>