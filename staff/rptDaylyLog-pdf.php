<?php
    include("../function.php");
    include("../config29.php");

    require_once('../mpdf/mpdf.php'); //ที่อยู่ของไฟล์ mpdf.php ในเครื่องเรานะครับ
    $pdf = new mPDF('th', 'A4', '0', 'THSaraban'); //การตั้งค่ากระดาษถ้าต้องการแนวตั้ง ก็ A4 เฉยๆครับ ถ้าต้องการแนวนอนเท่ากับ A4-L
    $pdf->SetAutoFont();
    $pdf->SetDisplayMode('fullpage');
    $pdf->SetFooter("หน้า {PAGENO} จาก {nb}");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>ระบบทะเบียนบัตรอนุญาตติดรถยนต์ ฝ่ายรักษาความปลอดภัย</title>
</head>
<body>
    <?php
        $content = "<h2 class='page-header'>ประวัติการพิมพ์บัตร ประจำวันที่ " . DateThai(date("Y-m-d")) ;
        $content .="</h2>"
            ."<table border='1' width='100%'>"
                    ."<thead>"
                        ."<tr>"
                            ."<th class='text-center' style='width:15%'>วันที่</th>"
                            ."<th class='text-center' style='width:12%'>หมายเลขบัตร</th>"
                            ."<th class='text-center' style='width:13%'>เลขประจำตัว</th>"
                            ."<th class='text-center' style='width:20%'>ชื่อ-นามสกุล</th>"
                            ."<th class='text-center' style='width:20%'>ผู้พิมพ์</th>"
                            ."<th class='text-center' style='width:20%'>หมายเหตุ</th>"
                        ."</tr>"
                    ."</thead>"
                ."<tbody id='tblCardLog'>";
                    $today = date("Y-m-d");
                    $sqlLog = "SELECT l.printedDate, l.printedBy, e.name, l.remark, c.card_id, e.empn, e2.name AS printedByName FROM card_log l ";
                    $sqlLog .= "INNER JOIN car_card c ON l.card_id=c.card_id ";
                    $sqlLog .= "INNER JOIN egat1.vw_egat_emp e ON e.empn=c.emp_id ";
                    $sqlLog .= "INNER JOIN egat1.vw_egat_emp e2 ON e2.empn=l.printedBy ";
                    $sqlLog .= "WHERE printedDate BETWEEN '$today 00:00:00' AND '$today 23:59:59'";
                    $qLog = mysqli_query($conn, $sqlLog) or die(mysqli_error($conn));
                    if(mysqli_num_rows($qLog)>0)
                    {
                        while($log = mysqli_fetch_array($qLog))
                        {
                $content .="<tr>"
                            ."<td>" . thai_date3($log['printedDate'])
                            ."</td>"
                            ."<td style='text-align:center;'>" . $log['card_id']
                            ."</td>"
                            ."<td style='text-align:center;'>" . $log['empn']
                            ."</td>"
                            ."<td>" . $log['name']
                            ."</td>"
                            ."<td>" . "$log[printedBy]: $log[printedByName]"
                            ."</td>" 
                            ."<td>" . $log['remark']
                            ."</td>"
                         ."</tr>";   
                        }       
                    }
                $content.="</tbody>"   
            ."</table>";

            $pdf->WriteHTML($content, 2);
    ?>
</body>
</html>
<?php
    $pdf->Output();
?>    