<?php
session_start();
if (!isset($_GET['division'])) {
    header("Location: ../index.php");
} else {
    $fay = $_GET['division'];
}
ini_set('max_execution_time', 300);
include("../config29.php");
include("../mCrypt.class.inc.php");
?>
<!-- Add fancyBox main JS and CSS files -->
<script src="../js/jquery.fancybox.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="../source/jquery.fancybox.css?v=2.1.5" media="screen" />
<script type="text/javascript">
    $(document).ready(function () {
        $('a[class="detail"]').fancybox({
            'width': '80%',
            'height': '80%',
            'autoScale': false,
            'transitionIn': 'none',
            'transitionOut': 'none',
            'type': 'iframe',
            onClosed: function () {
                parent.location.reload(true);
            }
        });
    });
</script>
<div class="row">
    <div class="col-lg-12 col-lg-offset-0" style="border:0px solid #08C;">
        <h2 class="page-header">รายละเอียดบัตรอนุญาตติดรถยนต์ สังกัด <?php echo $_GET['division'] ?></h2>
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#employee">บัตรผู้ปฏิบัติงาน</a></li>
            <li><a data-toggle="tab" href="#executive">บัตรรถประจำตำแหน่ง</a></li>
        </ul>
        <div class="tab-content">
            <div id="employee" class="tab-pane fade in active">
                <?php
                $sqlCarCard = "SELECT c.card_id,e.empn, e.title,e.name, e.job_nm2, e.section1, e.section2,e.fay, e.long, t.tel_1, t.tel_2, c.card_start, c.card_end, c.remark "
                        . "FROM car_card c "
                        . "INNER JOIN egat1.vw_egat_emp e ON  c.emp_id=e.empn "
                        . "INNER JOIN owen_tel t ON e.empn = t.emp_id "
                        . "WHERE c.card_type_id=1 AND e.fay='$fay'";
                $qCarCard = mysqli_query($conn, $sqlCarCard);
                ?>
                <div style="margin-top:20px;">
                    <div class="row">
                       <?php
                            //1__ = Print the whole division: Beer
                            $mfay = "1__".$fay."__";
                            $mCrypt = new MCrypt();
                            $encrypt=$mCrypt->encrypt($mfay);
                        ?>
                        <div class="col-xs-12" style="margin-bottom: 20px;">
                            <a class="btn btn-success" href="http://10.20.192.19/servletCarcard2/rptService?param1=<?php echo $encrypt?>" target="_blank">
                                <span class="fa fa-print"></span> พิมพ์ทั้งฝ่าย
                            </a>
                        </div>
                    </div>
                    <table class='table table-bordered table-striped table-hover table-responsive' style='width:100%' id="tbldivision">
                        <thead>
                            <tr>
                                <th style="width: 10%;text-align: center">หมายเลขบัตร</th>
                                <th style="width: 12%;text-align: center">เลขประจำตัว</th>
                                <th style="width: 20%;text-align: center">ชื่อ-นามสกุล</th>
                                <th style="width: 15%;text-align: center">ตำแหน่ง</th>
                                <th style="width: 5%;text-align: center">แผนก</th>
                                <th style="width: 5%;text-align: center">กอง</th>
                                <th style="width: 5%;text-align: center">โทรศัพท์</th>
                                <th style="width: 8%;text-align: center">มือถือ</th>
                                <th style="width: 10%;text-align: center">หมายเหตุ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($carcard = mysqli_fetch_array($qCarCard)) {
                                ?>
                                <tr>
                                    <td style="text-align: center">
                                        <a href="carddetail.php?card_id=<?php echo $carcard['card_id'] ?>" class="detail">
                                            <?php echo $carcard['card_id'] ?>
                                        </a>
                                    </td>
                                    <td style="text-align: center"><?php echo $carcard['empn'] ?></td>
                                    <td><?php echo $carcard['title'] ?> <?php echo $carcard['name'] ?></td>
                                    <td><?php echo $carcard['job_nm2'] ?></td>
                                    <td><?php echo $carcard['section1'] ?></td>
                                    <td><?php echo $carcard['section2'] ?></td>
                                    <td><?php echo $carcard['tel_1'] ?></td>
                                    <td><?php echo $carcard['tel_2'] ?></td>
                                    <td><?php echo $carcard['remark'] ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="executive" class="tab-pane fade">
                <?php
                $sqlCarCard = "SELECT c.card_id,e.empn, e.title,e.name, e.job_nm2, e.section1, e.section2,e.fay, e.long, t.tel_1, t.tel_2, c.card_start, c.card_end, c.remark "
                        . "FROM car_card c "
                        . "LEFT JOIN egat1.vw_egat_emp e ON  c.emp_id=e.empn "
                        . "LEFT JOIN owen_tel t ON e.empn = t.emp_id "
                        . "WHERE c.card_type_id=2 AND e.fay='$fay'";
                $qCarCard = mysqli_query($conn, $sqlCarCard);
                ?>
                <div style="margin-top:20px;">
                    <div class="row">
                       <?php
                            //3__ = Print the whole division: Beer
                            $mfay = "3__".$fay."__";
                            $mCrypt = new MCrypt();
                            $encrypt=$mCrypt->encrypt($mfay);
                        ?>
                        <div class="col-xs-12" style="margin-bottom: 20px;">
                            <a class="btn btn-success" href="http://10.20.192.19/servletCarcard2/rptService?param1=<?php echo $encrypt?>" target="_blank">
                                <span class="fa fa-print"></span> พิมพ์ทั้งฝ่าย
                            </a>
                        </div>
                    </div>
                    <table class='table table-bordered table-striped table-hover table-responsive' style='width:100%' id="tblexecutive">
                        <thead>
                            <tr>
                                <th style="width: 10%;text-align: center">หมายเลขบัตร</th>
                                <th style="width: 12%;text-align: center">เลขประจำตัว</th>
                                <th style="width: 20%;text-align: center">ชื่อ-นามสกุล</th>
                                <th style="width: 15%;text-align: center">ตำแหน่ง</th>
                                <th style="width: 5%;text-align: center">โทรศัพท์</th>
                                <th style="width: 8%;text-align: center">มือถือ</th>
                                <th style="width: 10%;text-align: center">หมายเหตุ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($carcard = mysqli_fetch_array($qCarCard)) {
                                ?>
                                <tr>
                                    <td style="text-align: center">
                                        <a href="carddetail.php?card_id=<?php echo $carcard['card_id'] ?>" class="detail">
                                            <?php echo $carcard['card_id'] ?>
                                        </a>
                                    </td>
                                    <td style="text-align: center"><?php echo $carcard['empn'] ?></td>
                                    <td><?php echo $carcard['title'] ?> <?php echo $carcard['name'] ?></td>
                                    <td><?php echo $carcard['job_nm2'] ?></td>
                                    <td><?php echo $carcard['tel_1'] ?></td>
                                    <td><?php echo $carcard['tel_2'] ?></td>
                                    <td><?php echo $carcard['remark'] ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#tbldivision').DataTable({
            "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ]
        });
        $('#tblexecutive').DataTable({
            "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ]
        });
        $('.dataTables_filter input[type="search"]').css(
                {'width': '350px', 'display': 'inline-block'}
        );
    });
</script>