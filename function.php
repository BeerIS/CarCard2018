<?php

$thai_day_arr = array("อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัสบดี", "ศุกร์", "เสาร์");
$thai_month_arr = array(
    "0" => "",
    "1" => "มกราคม",
    "2" => "กุมภาพันธ์",
    "3" => "มีนาคม",
    "4" => "เมษายน",
    "5" => "พฤษภาคม",
    "6" => "มิถุนายน",
    "7" => "กรกฎาคม",
    "8" => "สิงหาคม",
    "9" => "กันยายน",
    "10" => "ตุลาคม",
    "11" => "พฤศจิกายน",
    "12" => "ธันวาคม"
);

//print_r($thai_month_arr);
function thai_date($time) {
    global $thai_day_arr, $thai_month_arr;
    $thai_date_return = " " . $thai_day_arr[date("w", $time)];
    $thai_date_return.= "&nbsp;" . date("j", $time);
    $thai_date_return.="&nbsp;&nbsp;&nbsp;" . $thai_month_arr[date("n", $time)];
    $thai_date_return.= "&nbsp;" . (date("Y", $time) + 543);
    $thai_date_return.= " , " . date("H:i", $time) . " น.";
    return $thai_date_return;
}

function thai_date2($date){
    global $thai_month_arr;
    $dt=  explode("-",$date);    
    $thmonth = $thai_month_arr[intval($dt[1])];
    $thyear=$dt[0]+543;
    //$thai_date = "$dt[0] $dt[1] $dt[2]";
    $thai_date="$dt[2] $thmonth $thyear";
    $thai_date = $thmonth;
    return $thai_date;
}

function thai_date3($datetime){
    //for date with time
    global $thai_month_arr;

    $dt=  explode(" ",$datetime);   //[0]:date [1]:time
    
    $strDate = explode("-",$dt[0]);

    $thDay = $strDate[2];
    $thmonth = $thai_month_arr[intval($strDate[1])];
    $thyear=$strDate[0]+543;

    $strTime = explode(":",$dt[1]);  //[0]:HH [1]:MM [2]:SS

    $thai_date = "$thDay $thmonth $thyear $strTime[0]:$strTime[1]";
    
    return $thai_date;
}

function DateThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear";
	}
?>