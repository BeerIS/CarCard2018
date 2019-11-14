<?php
session_start();
ini_set('max_execution_time', 500);
include("../function.php");
include("../config29.php");

$division = $_GET['division'];
$type = $_GET['type'];

require_once('../mpdf/mpdf.php'); //ที่อยู่ของไฟล์ mpdf.php ในเครื่องเรานะครับ
$pdf = new mPDF('th', 'A4-L', '0', 'THSaraban'); //การตั้งค่ากระดาษถ้าต้องการแนวตั้ง ก็ A4 เฉยๆครับ ถ้าต้องการแนวนอนเท่ากับ A4-L
$pdf->SetAutoFont();
$pdf->SetDisplayMode('fullpage');
$pdf->SetHeader("สังกัด $division หน้า {PAGENO} จาก {nb}");
$sqlCarCard = "SELECT c.card_id,e.empn, e.title,e.name, e.job_nm2, e.section1, e.section2,e.fay, e.long, t.tel_1, t.tel_2, c.card_start, c.card_end, c.remark "
        . "FROM car_card c "
        . "LEFT JOIN egat1.vw_egat_emp e ON  c.emp_id=e.empn "
        . "LEFt JOIN owen_tel t ON e.empn = t.emp_id "
        . "WHERE c.card_type_id=$type AND e.fay='$division' ORDER BY c.card_id";
$qCarCard = mysqli_query($conn, $sqlCarCard);

switch ($type)
{
    case 1 : $typename="รถผู้ปฏิบัติงาน";break;
    case 2 : $typename="รถประจำตำแหน่ง";break; 
    default:$typename="";
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>ระบบทะเบียนบัตรอนุญาตติดรถยนต์ ฝ่ายรักษาความปลอดภัย</title>
    </head>
    <body>
        <?php
        $cover .= "<div style='text-align:center;font-weight:bold'>"
                . "<h3>ทะเบียนบัตรอนุญาตติดรถยนต์ สังกัด $division</h3>"
                . "<h3>ประเภทบัตร $typename</h3>"
                . "</div>";

         $cover .= "<table border='1' width='100%'>"
                    . "<tr>"
                        . "<th style='text-align:center;font-weight:bold;width:5%'>ลำดับ</th>"
                        . "<th style='text-align:center;font-weight:bold;width:8%'>บัตรเลขที่</th>"
                        . "<th style='text-align:center;font-weight:bold;width:10%'>เลขประจำตัว</th>"
                        . "<th style='text-align:center;font-weight:bold;'>ชื่อ - นามสกุล</th>"
                        . "<th style='text-align:center;font-weight:bold;width:10%'>แผนก</th>"
                        . "<th style='text-align:center;font-weight:bold;width:10%'>กอง</th>"
                        . "<th style='text-align:center;font-weight:bold;width:10%'>โทร.1</th>"
                        . "<th style='text-align:center;font-weight:bold;width:10%'>โทร.2</th>"
                    . "</tr>";
        $i=1;
         while($row = mysqli_fetch_array($qCarCard))
            {
                $cover .= "<tr>"
                            . "<td style='text-align:center'>$i</td>"
                            . "<td style='text-align:center'>$row[card_id]</td>"
                            . "<td style='text-align:center'>$row[empn]</td>"
                            . "<td>$row[title]$row[name]</td>"
                            . "<td>$row[section1]</td>"
                            . "<td>$row[section2]</td>"
                            . "<td>$row[tel_1]</td>"
                            . "<td>$row[tel_2]</td>"
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