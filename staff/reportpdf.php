<?php
include("../function.php");
$objConnect = mysqli_connect("localhost", "root", "12345678");
if (!$objConnect) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_select_db($objConnect, "car_card_regis") or die("ติดต่อฐานข้อมูลไม่ได้");

mysqli_set_charset($con, "utf8");
require_once('../mpdf/mpdf.php'); //ที่อยู่ของไฟล์ mpdf.php ในเครื่องเรานะครับ
$pdf = new mPDF('th', 'A4', '0', 'THSaraban'); //การตั้งค่ากระดาษถ้าต้องการแนวตั้ง ก็ A4 เฉยๆครับ ถ้าต้องการแนวนอนเท่ากับ A4-L
$pdf->SetAutoFont();
$pdf->SetDisplayMode('fullpage');
?>
<body>
    <?
    $year = $_GET['year'] + 543;
    $monthno = $_GET['lmName'];
    $html = "<div style='text-align:center'><h3>รายการคำขอรับบัตรอนุญาตติดรถยนต์ประจำเดือน $thai_month_arr[$monthno] $year</h3></div>";
    $html .= "<label><h5><b><i class='fa fa-file fa-fw'></i> คำขอใหม่</b></h5></label>"
            . "<table width='100%' border='1'>"
            . "<tr>"
            . "<td style='text-align: center;width: 7%'>ลำดับ</td>"
            . "<td style='text-align: center;width: 10%'>เลขที่คำขอ</td>"
            . "<td style='text-align: center;width: 13%'>วันที่ / เวลา</td>"
            . "<td style='text-align: center;width: 10%'>เลขประจำตัว</td>"
            . "<td style='text-align: center;'>ชื่อ - สกุล</td>"
            . "<td style='text-align: center;width: 7%'>ฝ่าย</td>"
            . "<td style='text-align: center;'>สถานะคำขอ</td>"
            . "</tr>";
    $sql = "SELECT * FROM requests WHERE MONTH( request_date ) =  '" . $_GET["lmName"] . "' AND YEAR (request_date) = '$_GET[year]' ORDER BY request_date";
    
    $objQuery = mysqli_query($objConnect, $sql);
    $i = 0;
    while ($row = mysqli_fetch_array($objQuery)) {
        $sqli = "SELECT * FROM view_emp WHERE empn = $row[emp_id]";
        $obj = mysqli_query($objConnect, $sqli);
        while ($col = mysqli_fetch_array($obj)) {
            $sqlreq = "SELECT * FROM status_log WHERE request_id = $row[request_id]";
            $objreq = mysqli_query($objConnect, $sqlreq);
            while ($reqq = mysqli_fetch_array($objreq)) {
                $i++;
                $html .= "<tr>";
                $html .= "<td style='text-align:center;'>$i</td>";
                $html .= "<td style='text-align:center;'>" . $row["request_id"] . "</td>";
                $html .= "<td style='text-align:center;'>" . $row["request_date"] . "</td>";
                $html .= "<td style='text-align:center;'>" . $row["emp_id"] . "</td>";
                $html .= "<td>" . $col["name"] . "</td>";
                $html .= "<td style='text-align:center;'>" . $col["fay"] . "</td>";
                $html .= "<td style='text-align:center;'>" . $reqq["comment"] . "</td>";
                $html .= "</tr>";
            }
        }
    }

                $html .= "</table>";
                
        $html   .="<table style='width:40%;margin-top:px;margin-top:20px' border='0'>"
                . "<tr>"
                . "<td style='font-weight:bold'>จำนวนคำขอในเดือนนี้</td>"
                . "<td style='width:5%;text-align:center;'>" . $i . "</td>"
                . "<td style='font-weight:bold;text-align:center;'>คำขอ</td>"
                . "</tr>"
                . "</table>";
   
    $today = time();
    $html .="<div style='margin-top:40px;text-align:right;'>"
            . "วันที่พิมพ์ : "
            . thai_date($today)
            . "</div>";
    $pdf->SetHeader('ระบบลงทะเบียนเพื่อขอรับบัตรอนุญาตติดรถยนต์ออนไลน์');
    $pdf->setFooter('หน้า {PAGENO} จาก {nbpg}');

    $pdf->WriteHTML($html, 2);

    $pdf->Output();
    ?> 

</body>
    <?

   function GetUserName($id) {
    //set for thai language
    mysqli_set_charset($objConnect, "utf8");
    //echo "Connection";
    $sql = "select name from view_emp where empn = '" . $id . "' ";
    $objQuery = mysqli_query($objConnect, $sql);
    $i = 0;
    $res = "";
    while ($row = mysqli_fetch_array($objQuery)) {
        $res = $row["name"];
        }
    mysqli_close($objConnect);
    return $res;
    }
    ?>