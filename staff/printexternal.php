<?php
session_start();

ini_set('max_execution_time', 300);
include("../config29.php");
include("../mCrypt.class.inc.php");
$numCommitteeCar = 0;
$numExternalCar=0;
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
        <h2 class="page-header">บัตรอนุญาตติดรถยนต์คณะกรรมการ กฟผ./บุคคลภายนอก</h2>
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#committee">คณะกรรมการ กฟผ.</a></li>
            <li><a data-toggle="tab" href="#external">บุคคลภายนอก</a></li>
        </ul>
        <div class="tab-content">
            <div id="committee" class="tab-pane fade in active">
                <?php
                $sqlCarCard = "SELECT c.card_id, "
                        . "CASE "
                            . "WHEN c.card_type_id=3 THEN CONCAT('ก-',LPAD(card_id,5,'0')) "
                            . "WHEN c.card_type_id=4 THEN CONCAT('น-',LPAD(card_id,5,'0')) "
                        . "END AS card_no,"
                        . "e.owen_id, e.owen_prefix, e.owen_name, CONCAT(e.owen_prefix,e.owen_name) AS owen, e.owen_add, e.tel1, e.tel2, "
                        . "c.card_type_id,c.card_start, c.card_end, c.remark "
                        . "FROM nonemp_owen e INNER JOIN car_card c ON e.owen_id = c.emp_id "
                        . "WHERE c.card_type_id=3";
                $qCarCard = mysqli_query($conn, $sqlCarCard);
                $numCommitteeCar = mysqli_num_rows($qCarCard);
                ?>
                <div style="margin-top:20px;">
                    <div class="row">
                       <?php
                            //6__ = Print the whole committee: Beer
                            $mfay = "6__";
                            $mCrypt = new MCrypt();
                            $encrypt=$mCrypt->encrypt($mfay);
                        ?>
                        <div class="col-xs-12" style="margin-bottom: 20px;">
                            <a class="btn btn-info" href="namelist_external.php?type=3" target="_blank">
                                <span class="fa fa-file"></span> พิมพ์รายชื่อ
                            </a>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <a class="btn btn-success" href="http://10.20.192.19/servletCarcard2/rptService?param1=<?php echo$encrypt?>" target="_blank">
                                <span class="fa fa-print"></span> พิมพ์บัตรทั้งหมด
                            </a>

                        </div>
                    </div>
                    <table class='table table-bordered table-striped table-hover table-responsive' style='width:100%' id="tblCommittee">
                        <thead>
                            <tr>
                                <th style="width: 14%;text-align: center">หมายเลขบัตร</th>
                                <th style="width: 15%;text-align: center">เลขประจำตัว</th>
                                <th style="width: 20%;text-align: center">ชื่อ-นามสกุล</th>
                                <th style="width: 15%;text-align: center">ตำแหน่ง/สังกัด</th>
                                <th style="width: 8%;text-align: center">โทรศัพท์</th>
                                <th style="width: 8%;text-align: center">มือถือ</th>
                                <th style="width: 20%;text-align: center">หมายเหตุ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($carcard = mysqli_fetch_array($qCarCard)) {
                                ?>
                                <tr>
                                    <td style="text-align: center">
                                        <a href="carddetail_external.php?card_id=<?php echo $carcard['card_id'] ?>" class="detail">
                                            <?php echo $carcard['card_no'] ?>
                                        </a>
                                    </td>
                                    <td style="text-align: center"><?php echo $carcard['owen_id'] ?></td>
                                    <td><?php echo $carcard['owen'] ?></td>
                                    <td><?php echo $carcard['owen_add'] ?></td>
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
            <div id="external" class="tab-pane fade">
                 <?php
                $sqlCarCard = "SELECT c.card_id, "
                        . "CASE "
                            . "WHEN c.card_type_id=3 THEN CONCAT('ก-',LPAD(card_id,5,'0')) "
                            . "WHEN c.card_type_id=4 THEN CONCAT('น-',LPAD(card_id,5,'0')) "
                        . "END AS card_no,"
                        . "e.owen_id, e.owen_prefix, e.owen_name, CONCAT(e.owen_prefix,e.owen_name) AS owen, e.owen_add, e.tel1, e.tel2, "
                        . "c.card_type_id,c.card_start, c.card_end, c.remark "
                        . "FROM nonemp_owen e INNER JOIN car_card c ON e.owen_id = c.emp_id "
                        . "WHERE c.card_type_id=4";
                $qCarCard = mysqli_query($conn, $sqlCarCard);
                $numExternalCar = mysqli_num_rows($qCarCard);
                ?>
                <div style="margin-top:20px;">
                    <div class="row">
                       <?php
                            //7__ = Print the whole external: Beer
                            $mfay = "7__";
                            $mCrypt = new MCrypt();
                            $encrypt=$mCrypt->encrypt($mfay);
                        ?>
                        <div class="col-xs-12" style="margin-bottom: 20px;">
                            <a class="btn btn-info" href="namelist_external.php?type=4" target="_blank">
                                <span class="fa fa-file"></span> พิมพ์รายชื่อ
                            </a>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <a class="btn btn-success" href="http://10.20.192.19/servletCarcard2/rptService?param1=<?php echo $encrypt?>" target="_blank">
                                <span class="fa fa-print"></span> พิมพ์บัตรทั้งหมด
                            </a>
                        </div>
                    </div>
                    <table class='table table-bordered table-striped table-hover table-responsive' style='width:100%' id="tblExternal">
                        <thead>
                            <tr>
                                <th style="width: 14%;text-align: center">หมายเลขบัตร</th>
                                <th style="width: 15%;text-align: center">เลขประจำตัว</th>
                                <th style="width: 20%;text-align: center">ชื่อ-นามสกุล</th>
                                <th style="width: 15%;text-align: center">ตำแหน่ง/สังกัด</th>
                                <th style="width: 8%;text-align: center">โทรศัพท์</th>
                                <th style="width: 8%;text-align: center">มือถือ</th>
                                <th style="width: 20%;text-align: center">หมายเหตุ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($carcard = mysqli_fetch_array($qCarCard)) {
                                ?>
                                <tr>
                                    <td style="text-align: center">
                                        <a href="carddetail_external.php?card_id=<?php echo $carcard['card_id'] ?>" class="detail">
                                            <?php echo $carcard['card_no'] ?>
                                        </a>
                                    </td>
                                    <td style="text-align: center"><?php echo $carcard['owen_id'] ?></td>
                                    <td><?php echo $carcard['owen'] ?></td>
                                    <td><?php echo $carcard['owen_add'] ?></td>
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
<div class="row">
    <div class="col-xs-12">
        <div class="alert alert-success">
            <div>
                <strong>สรุปจำนวนบัตรอนุญาตติดรถยนต์</strong>
            </div>
            <div>
                <ul>
                    <li>บัตรรถยนต์คณะกรรมการ กฟผ. <?php echo $numCommitteeCar?> ใบ</li>
                    <li>บัตรรถยนต์บุคคลภายนอก <?php echo $numExternalCar?> ใบ</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#tblCommittee').DataTable({
            "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ]
        });
        $('#tblExternal').DataTable({
            "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ]
        });
        $('.dataTables_filter input[type="search"]').css(
                {'width': '350px', 'display': 'inline-block'}
        );
    });
</script>
