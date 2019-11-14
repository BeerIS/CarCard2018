<?php

require 'function.php';
require 'PHPMailer_v5.0.2/class.phpmailer.php';
session_start();
$host = "localhost";
$username = "root";
$password = "12345678";
$objConnect = mysqli_connect($host, $username, $password) or die("ติดต่อ Host ไม่ได้");
$db_name = "car_card_regis";
mysqli_select_db($objConnect, $db_name) or die("ติดต่อฐานข้อมูลไม่ได้");

if ($_REQUEST) {
    $Year = date('Y') + 543;        //AD is converted to BE
    $Year = substr($Year, 2, 4);       //59
    $area = '01';       //01
    $reqPrefix = $Year . $area;       //5901
    $sqlReqId = "SELECT request_id FROM requests WHERE request_id LIKE '$reqPrefix%' ORDER BY request_id DESC LIMIT 0,1";   //5901(%=max)
    $objQuery = mysqli_query($objConnect, $sqlReqId);     //get Table
    $row = mysqli_fetch_array($objQuery);        //get one row
    $rid = substr($row['request_id'], 4, 9);        //get one column and substr
    (int) $rid;
    if ($i = (int) $rid) {
        $i++;
    }
    $int_as_string = (string) $i;
    $ReqId = $reqPrefix . str_pad($int_as_string, 5, "0", STR_PAD_LEFT);
    $curr_timestamp = date('Y-m-d H:i:s');      //date('Y-m-d H:i:s') is func of PHP and (now) is func of SQL
    $email = $_REQUEST['email'];
    $tel = $_REQUEST['tel'];
    $address = $_REQUEST['address'];
    $moo = $_REQUEST['moo'];
    $soi = $_REQUEST['soi'];
    $road = $_REQUEST['road'];
    $subdistrict = $_REQUEST['subdistrict'];
    $district = $_REQUEST['district'];
    $province_id = $_REQUEST['province_id0'];
    $postcode = $_REQUEST['postcode'];
    $empn = $_SESSION['username'];

    $strSQL = "INSERT INTO requests ";
    $strSQL .="(request_id,request_date,email,tel,address,moo,soi,road,subdistrict,district,province_id,postcode,emp_id) VALUES ('$ReqId','$curr_timestamp',"
            . "'$email','$tel','$address','$moo','$soi','$road','$subdistrict','$district','$province_id','$postcode','$empn')";
    //    echo $strSQL;
    $objQuery = mysqli_query($objConnect, $strSQL) or die(mysqli_error($objConnect));

    $usernameadmin = $_SESSION['username'];
    $sqlLog = "INSERT INTO status_log (status_id,request_id,status_date,staff_id,comment) VALUES (0,'$ReqId',now(),'$usernameadmin','คำขอใหม่')";
    $objQuery = mysqli_query($objConnect, $sqlLog) or die(mysqli_error($objConnect));



    $car_regis_number1 = $_REQUEST['car_regis_number'][0];
    $province_id1 = $_REQUEST['province_id'][0];
    $brand_id1 = $_REQUEST['brand_id'][0];
    $color_id1 = $_REQUEST['color_id'][0];
    $ctype_id1 = $_REQUEST['ctype_id'][0];
    $area_id1 = $_REQUEST['area_id'][0];
    $ownertype1 = $_POST['ownertype'][0];

    $fCarName1 = $_FILES['car_license']['name'][0];
    $fCarType1 = $_FILES["car_license"]["type"][0];
    $fpCar1 = fopen($_FILES["car_license"]["tmp_name"][0], "r");
    $ReadBiCar1 = fread($fpCar1, filesize($_FILES["car_license"]["tmp_name"][0]));
    fclose($fpCar1);
    $fCarContent1 = addslashes($ReadBiCar1);
    if ($_FILES["marriage_license"]["name"][0] != "") {
        $fMarriageName1 = $_FILES['marriage_license']['name'][0];
        $fMarriageType1 = $_FILES["marriage_license"]["type"][0];
        $fpMarriage1 = fopen($_FILES["marriage_license"]["tmp_name"][0], "r");
        $ReadBiMarriage1 = fread($fpMarriage1, filesize($_FILES["marriage_license"]["tmp_name"][0]));
        fclose($fpMarriage1);
        $fMarriageContent1 = addslashes($ReadBiMarriage1);
    }
    if ($_FILES["house_registration"]["name"][0] != "") {
        $fHouseName1 = $_FILES['house_registration']['name'][0];
        $fHouseType1 = $_FILES["house_registration"]["type"][0];
        $fpHouse1 = fopen($_FILES["house_registration"]["tmp_name"][0], "r");
        $ReadBiHouse1 = fread($fpHouse1, filesize($_FILES["house_registration"]["tmp_name"][0]));
        fclose($fpHouse1);
        $fHouseContent1 = addslashes($ReadBiHouse1);
    }

    if ($ownertype1 == "") {
        $ownertype1 = 0;
    }
    $strSQL = "INSERT INTO request_car ";
    $strSQL .="(request_id,car_regis_number,province_id,brand,color,ctype,area,car_license_filename,car_license_filetype,car_license,"
            . "marriage_license_filename,marriage_license_filetype,marriage_license,house_registration_filename,house_registration_filetype,"
            . "house_registration, owner_type) VALUES ('$ReqId','$car_regis_number1','$province_id1',$brand_id1,$color_id1,$ctype_id1,1,'$fCarName1',"
            . "'$fCarType1','$fCarContent1','$fMarriageName1','$fMarriageType1','$fMarriageContent1','$fHouseName1','$fHouseType1','$fHouseContent1','$ownertype1')";

    $objQuery = mysqli_query($objConnect, $strSQL) or die(mysqli_error($objConnect));

    if (isset($_POST['car2'])) {
        $car_regis_number2 = $_REQUEST['car_regis_number'][1];
        $province_id2 = $_REQUEST['province_id'][1];
        $brand_id2 = $_REQUEST['brand_id'][1];
        $color_id2 = $_REQUEST['color_id'][1];
        $ctype_id2 = $_REQUEST['ctype_id'][1];
        $area_id2 = $_REQUEST['area_id'][1];
        $ownertype2 = $_POST['ownertype'][1];
        $fCarName2 = $_FILES['car_license']['name'][1];
        $fCarType2 = $_FILES["car_license"]["type"][1];
        $fpCar2 = fopen($_FILES["car_license"]["tmp_name"][1], "r");
        $ReadBiCar2 = fread($fpCar2, filesize($_FILES["car_license"]["tmp_name"][1]));
        fclose($fpCar2);
        $fCarContent2 = addslashes($ReadBiCar2);
        if ($_FILES["marriage_license"]["name"][1] != "") {
            $fMarriageName2 = $_FILES['marriage_license']['name'][1];
            $fMarriageType2 = $_FILES["marriage_license"]["type"][1];
            $fpMarriage2 = fopen($_FILES["marriage_license"]["tmp_name"][1], "r");
            $ReadBiMarriage2 = fread($fpMarriage2, filesize($_FILES["marriage_license"]["tmp_name"][1]));
            fclose($fpMarriage2);
            $fMarriageContent2 = addslashes($ReadBiMarriage);
        }
        if ($_FILES["house_registration"]["name"][1] != "") {
            $fHouseName2 = $_FILES['house_registration']['name'][1];
            $fHouseType2 = $_FILES["house_registration"]["type"][1];
            $fpHouse2 = fopen($_FILES["house_registration"]["tmp_name"][1], "r");
            $ReadBiHouse2 = fread($fpHouse2, filesize($_FILES["house_registration"]["tmp_name"][1]));
            fclose($fpHouse2);
            $fHouseContent2 = addslashes($ReadBiHouse2);
        }

        if ($ownertype2 == "") {
            $ownertype2 = 0;
        }
        $strSQL = "INSERT INTO request_car ";
        $strSQL .="(request_id,car_regis_number,province_id,brand,color,ctype,area,car_license_filename,car_license_filetype,car_license,"
                . "marriage_license_filename,marriage_license_filetype,marriage_license,house_registration_filename,house_registration_filetype,"
                . "house_registration, owner_type) VALUES ('$ReqId','$car_regis_number2','$province_id2',$brand_id2,$color_id2,$ctype_id2,1,'$fCarName2',"
                . "'$fCarType2','$fCarContent2','$fMarriageName2','$fMarriageType2','$fMarriageContent2','$fHouseName2','$fHouseType2','$fHouseContent2','$ownertype2')";
//        echo $strSQL;
        $objQuery = mysqli_query($objConnect, $strSQL) or die(mysqli_error($objConnect));
    }

    echo "บันทึกข้อมูล && ";
}

//SENT E-MAIL
require 'config29.php';
require 'connectSQL.php';

$sql = "SELECT emp_id FROM requests WHERE request_id=$ReqId";
$obj = mysqli_query($objConnect, $sql);
$req = mysqli_fetch_array($obj);


$sqli = "SELECT * FROM vw_egat_emp WHERE empn=$req[emp_id]";
$obj1 = mysqli_query($conn, $sqli);
$empn = mysqli_fetch_array($obj1);

$mail = new PHPMailer();

$mail->CharSet = "utf-8";
$mail->isHTML(true);
$mail->Mailer = "smtp";

$mailto = $mail->AddAddress("594623@egat.co.th", "STAFF"); //อีเมลผู้รับคำขอ
$mail->SMTPAuth = true;
$mail->Host = "mail.egat.co.th";
$mail->Port = 25;
$mail->Username = "security";
$mail->Password = "sec1059****";
$mail->From = "security@egat.co.th";
$mail->FromName = "แผนกบัตรรักษาความปลอดภัย";
//$mail->AddAddress($mailto);
//var_dump($mailto);
//$mail->AddCC("$empn@egat.co.th", $name);
$mail->Subject = "คำขอใหม่:ระบบลงทะเบียนเพื่อขอรับบัตรอนุญาตติดรถยนต์ออนไลน์";
$str = "<h4>มีคำขอทำบัตรอนุญาตติดรถยนต์ใหม่ เลขที่ $ReqId</h4><br>"
        . "ของ <br>";
$str .= "<table width'100%' border='0'>"
        . "<tr>"
        . "<td style='width:50%;'>$empn[title] $empn[name]</td>"
        . "<td style='width:50%;'>เลขประจำตัว $empn[empn]</td>"
        . "</tr>"
        . "<tr>"
        . "<td style='width:50%;'>สังกัดแผนก $empn[section1]</td>"
        . "<td style='width:50%;'>กอง $empn[section2]</td>"
        . "</tr>"
        . "<tr>"
        . "<td style='width:50%;'>ฝ่าย $empn[fay]</td>"
        . "<td style='width:50%;'>สาย $empn[long]</td>"
        . "</tr>"
        . "<tr>"
        . "<td style='width:50%;'>โทร $tel</td>"
        . "</tr>"
        . "</table><br><br>";
$str .= "<a href='http://localhost/CarCard2/staff/index.php?menu=detail&req_id=$ReqId'>คลิกเพื่อดูรายละเอียด</a><br><br>";
$str .= "ส่งโดย : ระบบลงทะเบียนเพื่อขอรับบัตรอนุญาตติดรถยนต์ออนไลน์<br><br>";
$today = time();
$str .= "" . thai_date($today) . "<br><br>";
$mail->Body = $str;
$mail->set("X-Priority", "1");
if (!$mail->Send()) {
    echo "Sending Error: " . $mail->ErrorInfo;
} else {
    echo "ส่งสำเร็จแล้ว";
}


mysqli_close($objConnect);
?>