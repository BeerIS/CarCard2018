<?php
session_start();
ini_set('max_execution_time', 500);
include("../function.php");
include("../config29.php");

$type = $_GET['type'];

require_once('../mpdf/mpdf.php'); //ที่อยู่ของไฟล์ mpdf.php ในเครื่องเรานะครับ

switch ($type)
{
    case 3 : $typename="รถคณะกรรมการ กฟผ.";break;
    case 4 : $typename="รถบุคคลภายนอก";break;
    default:$typename="";
}
$pdf = new mPDF('th', 'A4-L', '0', 'THSaraban'); //การตั้งค่ากระดาษถ้าต้องการแนวตั้ง ก็ A4 เฉยๆครับ ถ้าต้องการแนวนอนเท่ากับ A4-L
$pdf->SetAutoFont();
$pdf->SetDisplayMode('fullpage');
$pdf->SetHeader("$typename หน้า {PAGENO} จาก {nb}");
$sqlCarCard = "SELECT c.card_id, "
                        . "CASE "
                            . "WHEN c.card_type_id=3 THEN CONCAT('ก-',LPAD(card_id,5,'0')) "
                            . "WHEN c.card_type_id=4 THEN CONCAT('น-',LPAD(card_id,5,'0')) "
                        . "END AS card_no,"
                        . "e.owen_id, e.owen_prefix, e.owen_name, CONCAT(e.owen_prefix,e.owen_name) AS owen, e.owen_add, e.tel1, e.tel2, "
                        . "c.card_type_id,c.card_start, c.card_end, c.remark "
                        . "FROM nonemp_owen e INNER JOIN car_card c ON e.owen_id = c.emp_id "
                        . "WHERE c.card_type_id=$type";
$qCarCard = mysqli_query($conn, $sqlCarCard);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>ระบบทะเบียนบัตรอนุญาตติดรถยนต์ ฝ่ายรักษาความปลอดภัย</title>
    </head>
    <body>
        <?php
        $cover .= "<div style='text-align:center;font-weight:bold'>"
                . "<h3>ทะเบียนบัตรอนุญาตติดรถยนต์ ประเภทบัตร $typename</h3>"
                . "</div>";

         $cover .= "<table border='1' width='100%'>"
                    . "<tr>"
                        . "<th style='text-align:center;font-weight:bold;width:5%'>ลำดับ</th>"
                        . "<th style='text-align:center;font-weight:bold;width:12%'>บัตรเลขที่</th>"
                        . "<th style='text-align:center;font-weight:bold;width:10%'>เลขประจำตัว</th>"
                        . "<th style='text-align:center;font-weight:bold;'>ชื่อ - นามสกุล</th>"
                        . "<th style='text-align:center;font-weight:bold;width:18%'>ตำแหน่ง/สังกัด</th>"
                        . "<th style='text-align:center;font-weight:bold;width:12%'>โทร.1</th>"
                        . "<th style='text-align:center;font-weight:bold;width:12%'>โทร.2</th>"
                    . "</tr>";
        $i=1;
         while($row = mysqli_fetch_array($qCarCard))
            {
                $cover .= "<tr>"
                            . "<td style='text-align:center'>$i</td>"
                            . "<td style='text-align:center'>$row[card_no]</td>"
                            . "<td style='text-align:center'>$row[owen_id]</td>"
                            . "<td>$row[owen_prefix]$row[owen_name]</td>"
                            . "<td>$row[owen_add]</td>"
                            . "<td>$row[tel1]</td>"
                            . "<td>$row[tel2]</td>"
                        . "</tr>";
                $i++;
            }
            $cover.="</table>";
            $pdf->WriteHTML($cover, 2);
        ?>
    </body>
</html>
<?php
    $pdf->Output();
?>
