<?php
session_start();
include("../config29.php");
?>
<div class="row" style="margin-top: 20px;">
    <div class="col-lg-12 col-lg-offset-0" style="border:0px solid #08C;">
        <div class="row" style="padding:15px;">
            <form method="post" asction="requestdetail.php">
                <div class="row">
                    <div class="col-xs-12" style="margin-left: 10px;">
                        <label><h5><b><i class="fa fa-file fa-fw"></i> คำขอใหม่</b></h5></label>
                        <table class="table table-responsive table-hover table-striped table-bordered table-condensed" style="width: 80%">
                            <tr class="info">
                                <th style="text-align: center;width: 7%">ลำดับ</th>
                                <th style="text-align: center;width: 10%">เลขที่คำขอ</th>
                                <th style="text-align: center;width: 13%">วันที่ / เวลา</th>
                                <th style="text-align: center;width: 13%">เลขประจำตัว</th>
                                <th style="text-align: center;">ชื่อ - สกุล</th>
                                <th style="text-align: center;width: 10%">ฝ่าย</th>
                                <th style="text-align: center;width: 10%">รายละเอียด</th>
                            </tr>
                            <?php
                            $sql = "select r.request_id, r.request_date, r.emp_id "
                                    . " FROM requests r INNER JOIN status_log l"
                                    . " ON r.request_id = l.request_id"
                                    . " WHERE l.status_id = 0 "
                                    . " AND l.request_id NOT IN (SELECT request_id FROM status_log WHERE status_id>0)"
                                    . " order by r.request_date";

                            $obj = mysqli_query($objConnect, $sql);
                            $i = 1;
                            while ($detail = mysqli_fetch_array($obj)) {
                                $req_id = $detail['request_id'];
                                ?>
                                <tr>
                                    <td style="text-align: center"><?php echo $i; ?></td>
                                    <td style="text-align: center"><?php echo $detail['request_id']; ?></td>
                                    <td style="text-align: center"><?php echo $detail['request_date']; ?></td>
                                    <td style="text-align: center"><?php echo $detail['emp_id']; ?></td>
                                    <td>
                                        <?php
                                        $sqlEmp = "SELECT name, fay FROM vw_egat_emp WHERE empn=$detail[emp_id]";
                                        $qEmp = mysqli_query($conn, $sqlEmp);
                                        $emp = mysqli_fetch_array($qEmp);
                                        echo $emp['name'];
                                        ?>
                                    </td>
                                    <td style="text-align: center"><?php echo $emp['fay']; ?></td>
                                    <td style="text-align: center"><a href="index.php?menu=detail&req_id=<?php echo $req_id; ?>">Detail</a></td>
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>
                        </table>

                        <label style="margin-top: 50px;"><h5><b><i class="fa fa-thumb-tack  fa-fw"></i> คำขอที่ดำเนินการอยู่</b></h5></label>
                        <table class="table table-responsive table-hover table-striped table-bordered table-condensed" style="width: 80%">
                            <tr class="warning">
                                <th style="text-align: center;width: 7%">ลำดับ</th>
                                <th style="text-align: center;width: 10%">เลขที่คำขอ</th>
                                <th style="text-align: center;width: 13%">วันที่ / เวลา</th>
                                <th style="text-align: center;width: 13%">เลขประจำตัว</th>
                                <th style="text-align: center;">ชื่อ - สกุล</th>
                                <th style="text-align: center;width: 10%">ฝ่าย</th>
                                <th style="text-align: center;width: 10%">รายละเอียด</th>
                            </tr>
                            <?php
                            $sql = "select r.request_id, r.request_date, r.emp_id "
                                    . " FROM requests r INNER JOIN status_log l"
                                    . " ON r.request_id = l.request_id"
                                    . " WHERE l.status_id = 1 "
                                    . " AND l.request_id NOT IN (SELECT request_id FROM status_log WHERE status_id>1)"
                                    . " order by r.request_date";
                            $obj = mysqli_query($objConnect, $sql);
                            $i = 1;
                            while ($detail = mysqli_fetch_array($obj)) {
                                $req_id = $detail['request_id'];
                                ?>
                                <tr>
                                    <td style="text-align: center"><? echo $i; ?></td>
                                    <td style="text-align: center"><? echo $detail['request_id']; ?></td>
                                    <td style="text-align: center"><? echo $detail['request_date']; ?></td>
                                    <td style="text-align: center"><? echo $detail['emp_id']; ?></td>
                                    <td>
                                        <?php
                                        $sqlEmp = "SELECT name, fay FROM vw_egat_emp WHERE empn=$detail[emp_id]";
                                        $qEmp = mysqli_query($conn, $sqlEmp);
                                        $emp = mysqli_fetch_array($qEmp);
                                        echo $emp['name'];
                                        ?>
                                    </td>
                                    <td style="text-align: center"><? echo $emp['fay']; ?></td>
                                    <td style="text-align: center"><a href="index.php?menu=detail&req_id=<?php echo $req_id; ?>">Detail</a></td>
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>
                        </table>

                        <label style="margin-top: 50px;"><h5><b><i class="fa fa-stop-circle fa-fw"></i> คำขอที่ถูกระงับ</b></h5></label>
                        <table class="table table-responsive table-hover table-striped table-bordered table-condensed" style="width: 80%">
                            <tr class="danger">
                                <th style="text-align: center;width: 7%">ลำดับ</th>
                                <th style="text-align: center;width: 10%">เลขที่คำขอ</th>
                                <th style="text-align: center;width: 13%">วันที่ / เวลา</th>
                                <th style="text-align: center;width: 13%">เลขประจำตัว</th>
                                <th style="text-align: center;">ชื่อ - สกุล</th>
                                <th style="text-align: center;width: 10%">ฝ่าย</th>
                                <th style="text-align: center;width: 10%">รายละเอียด</th>
                            </tr>
                            <?php
                            $sql = "select r.request_id, r.request_date, r.emp_id "
                                    . " FROM requests r INNER JOIN status_log l"
                                    . " ON r.request_id = l.request_id"
                                    . " WHERE l.status_id = 2 "
                                    . " AND l.request_id NOT IN (SELECT request_id FROM status_log WHERE status_id>2)"
                                    . " order by r.request_date";
                            $obj = mysqli_query($objConnect, $sql);
                            $i = 1;
                            while ($detail = mysqli_fetch_array($obj)) {
                                $req_id = $detail['request_id'];
                                ?>
                                <tr>
                                    <td style="text-align: center"><?php echo $i; ?></td>
                                    <td style="text-align: center"><?php echo $detail['request_id']; ?></td>
                                    <td style="text-align: center"><?php echo $detail['request_date']; ?></td>
                                    <td style="text-align: center"><?php echo $detail['emp_id']; ?></td>
                                    <td>
                                        <?php
                                        $sqlEmp = "SELECT name, fay FROM vw_egat_emp WHERE empn=$detail[emp_id]";
                                        $qEmp = mysqli_query($conn, $sqlEmp);
                                        $emp = mysqli_fetch_array($qEmp);
                                        echo $emp['name'];
                                        ?>
                                    </td>
                                    <td style="text-align: center"><? echo $emp['fay']; ?></td>
                                    <td style="text-align: center"><a href="index.php?menu=detail&req_id=<?php echo $req_id; ?>">Detail</a></td>
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>
                        </table>

                        <label style="margin-top: 50px;"><h5><b><i class="fa fa-check-circle fa-fw"></i> คำขออนุมัติแล้ว</b></h5></label>
                        <table class="table table-responsive table-hover table-striped table-bordered table-condensed" style="width: 80%">
                            <tr class="success">
                                <th style="text-align: center;width: 7%">ลำดับ</th>
                                <th style="text-align: center;width: 10%">เลขที่คำขอ</th>
                                <th style="text-align: center;width: 13%">วันที่ / เวลา</th>
                                <th style="text-align: center;width: 13%">เลขประจำตัว</th>
                                <th style="text-align: center;">ชื่อ - สกุล</th>
                                <th style="text-align: center;width: 10%">ฝ่าย</th>
                                <th style="text-align: center;width: 10%">รายละเอียด</th>
                            </tr>
                            <?php
                            $sql = "select status_id,r.request_id, r.request_date, r.emp_id "
                                    . " FROM requests r INNER JOIN status_log l"
                                    . " ON r.request_id = l.request_id"
                                    . " WHERE l.status_id = 3 "
                                    . " AND l.request_id NOT IN (SELECT request_id FROM status_log WHERE status_id>3)"
                                    . " order by r.request_date";
                            $obj = mysqli_query($objConnect, $sql);
                            $i = 1;
                            while ($detail = mysqli_fetch_array($obj)) {
                                $req_id = $detail['request_id'];
                                ?>

                                <tr>
                                    <td style="text-align: center"><?php echo $i; ?></td>
                                    <td style="text-align: center"><?php echo $detail['request_id']; ?></td>
                                    <td style="text-align: center"><?php echo $detail['request_date']; ?></td>
                                    <td style="text-align: center"><?php echo $detail['emp_id']; ?></td>
                                    <td>
                                        <?php
                                        $sqlEmp = "SELECT name, fay FROM vw_egat_emp WHERE empn=$detail[emp_id]";
                                        $qEmp = mysqli_query($conn, $sqlEmp);
                                        $emp = mysqli_fetch_array($qEmp);
                                        echo $emp['name'];
                                        ?>
                                    </td>
                                    <td style="text-align: center"><?php echo $emp['fay']; ?></td>
                                    <td style="text-align: center"><a href="index.php?menu=detail&req_id=<?php echo $req_id; ?>">Detail</a></td>
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
