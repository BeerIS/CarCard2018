<?php
session_start();
ini_set('max_execution_time', 300);
include("../config29.php");
include("../mCrypt.class.inc.php");
$numEmpCar = 0;
$numExecutiveCar = 0;
?>
<div class="row">
    <div class="col-lg-12 col-lg-offset-0">
        <h2 class="page-header">พิมพ์บัตรอนุญาตติดรถยนต์ทั้งฝ่าย</h2>
        <div class="row">
            <h3>เลือกฝ่ายที่ต้องการพิมพ์</h3>
            <div class="col-xs-12">
                <?php
                $sqlDivision = "SELECT e.fay, COUNT(card_id) AS NoOfSurvey FROM car_card c "
                            . "     INNER JOIN egat1.vw_egat_emp e ON  c.emp_id=e.empn	"
                            . " WHERE c.card_type_id=1 GROUP BY e.fay";
                
                $divisions = mysqli_query($conn, $sqlDivision);
                ?>
                <table class='table table-bordered table-striped table-hover table-responsive' style='width:100%' id="tbldivision">
                    <thead>
                        <tr>
                            <th rowspan="2" style='width:40%;text-align:center;vertical-align: middle'>สังกัด</th>
                            <th colspan="2" style='width:30%;text-align:center'>บัตรผู้ปฏิบัติงาน</th>
                            
                            <th colspan="2" style='width:30%;text-align:center'>บัตรรถประจำตำแหน่ง</th>
                            
                            
                        </tr>
                        <tr>
                            <th style='width:10%;text-align:center'> จำนวน (ใบ)</th>
                            <th style='width:20%;text-align:center'><i class="glyphicon glyphicon-print"></i> พิมพ์</th>
                            <th style='width:10%;text-align:center'> จำนวน (ใบ)</th>
                            <th style='width:20%;text-align:center'><i class="glyphicon glyphicon-print"></i> พิมพ์</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                        while ($div = mysqli_fetch_array($divisions)) {
                            $numEmpCar+=$div['NoOfSurvey'];
                            ?>
                            <tr>
                                <td>
                                    <a href="index.php?menu=divisiondetail&division=<?php echo $div['fay']?>" target="_blank">
                                        <?php echo  $div['fay'] ?>
                                    </a>
                                </td>
                                <td style="text-align: center"><?php echo  $div['NoOfSurvey'] ?></td>
                                <td style="text-align: center">
                                    <?php
                                     //1__ = Print the whole division: Beer
                                    $fay = "1__".$div['fay']."__";
                                    $mCrypt = new MCrypt();
                                    $encrypt=$mCrypt->encrypt($fay);
                                    ?>
                                    <a href="namelist.php?division=<?php echo $div['fay']?>&type=1" target="_blank"><i class='glyphicon glyphicon-file'></i> ใบรายชื่อ</a>&nbsp;&nbsp;&nbsp;
                                    <a href="http://10.20.192.19/servletCarcard2/rptService?param1=<?php echo $encrypt?>" target="_blank"><i class='glyphicon glyphicon-print'></i> บัตรอนุญาตฯ</a>
                                </td>
                                <?php
                                    $sqlExecutiveCar = "SELECT COUNT(card_id) FROM vw_car_card_executive WHERE fay='$div[fay]'";
                                    $qExecutiveCar = mysqli_query($conn, $sqlExecutiveCar);
                                    $car = mysqli_fetch_array($qExecutiveCar);
                                    $numExecutiveCar += $car[0];
                                ?>
                                <td style="text-align: center"><?php echo $car[0]?></td>
                                <td style="text-align: center">
                                    <?php
                                     //3__ = Print By job name: Beer
                                    $fay = "3__".$div['fay']."__";
                                    $mCrypt = new MCrypt();
                                    $encrypt=$mCrypt->encrypt($fay);
                                    ?>
                                    <a href="namelist.php?division=<?php echo $div['fay']?>&type=2" target="_blank"><i class='glyphicon glyphicon-file'></i> ใบรายชื่อ</a>&nbsp;&nbsp;&nbsp;
                                    <a href="http://10.20.192.19/servletCarcard2/rptService?param1=<?php echo $encrypt?>" target="_blank"><i class='glyphicon glyphicon-print'></i> พิมพ์บัตรอนุญาตฯ</a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="alert alert-success">
                    <div>
                        <strong>สรุปจำนวนบัตรอนุญาตติดรถยนต์</strong>
                    </div>
                    <div>
                        <ul>
                            <li>บัตรผู้ปฏิบัติงาน <?php echo $numEmpCar?> ใบ</li>
                            <li>บัตรรถยนต์ประจำตำแหน่ง <?php echo $numExecutiveCar?> ใบ</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#tbldivision').DataTable({
            "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ]
        });
        $('.dataTables_filter input[type="search"]').css(
         {'width':'350px','display':'inline-block'}
        );
    } );
</script>