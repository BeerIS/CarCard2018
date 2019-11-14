<div class="row" style="margin-top: 40px;">
    <div class="col-lg-12 col-lg-offset-0" style="border:0px solid #000;">
        <div class="row" style="padding:15px;">
            <div class="col-xs-12">
                <form class="form-horizontal" method="post" name="frmrequest" id="frmrequest">
                    <div class="form-group">
                        <label class="col-xs-2" style="font-size: 17px;">ชื่อ - สกุล</label>
                        <div class="col-xs-8">
                            <? echo $row['title'] . $row['name'] ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-2" style="font-size: 17px;">เลขประจำตัว</label>
                        <div class="col-xs-3">
                            <? echo $row['empn'] ?>
                        </div>
                        <label class="col-xs-2" style="font-size: 17px;">ตำแหน่ง</label>
                        <div class="col-xs-3">
                            <? echo $row['job_nm2'] ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-2" style="font-size: 17px;">สังกัดแผนก</label>
                        <div class="col-xs-3">
                            <? echo trim($row['section1']) == '' ? '-' : $row['section1']; ?>
                        </div>
                        <label class="col-xs-2" style="font-size: 17px;">กอง</label>
                        <div class="col-xs-3">
                            <? echo trim($row['section2']) == '' ? '-' : $row['section2']; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-2" style="font-size: 17px;">ฝ่าย</label>
                        <div class="col-xs-3">
                            <? echo trim($row['fay']) == '' ? '-' : $row['fay']; ?>
                        </div>
                        <label class="col-xs-2" style="font-size: 17px;">สายงาน</label>
                        <div class="col-xs-3">
                            <? echo trim($row['long']) == '' ? '-' : $row['long']; ?>
                        </div>
                    </div>



                </form>
            </div>
        </div>
    </div>
    <label style="margin-left: 50px;margin-top: 50px;font-size: medium;"><i class="fa fa-pencil-square-o fa-fw"></i> ลงทะเบียนขอบัตรอนุญาตจอดรถ <a style="color: blue;" href="request.php?menu=car"> คลิกที่นี่ </a></label>
</div>

<div class="row" style="margin-top: 40px;">
    <div class="col-lg-6 col-lg-offset-3" style="border:1px solid #0099FF;">
        <div class="row" style="padding:15px;">
            <div class="col-xs-12">
                <label>สถานะคำขอล่าสุด เลขที่</label>
                <?
                include 'connectSQL.php';
                $sql = "SELECT * FROM requests WHERE emp_id=$row[empn]";
                $obj = mysqli_query($objConnect, $sql);
                $col = mysqli_fetch_array($obj);

                $sqli = "SELECT * FROM status_log WHERE request_id=$col[request_id] ORDER BY status_date";
                $obji = mysqli_query($objConnect, $sqli);
                $status = mysqli_fetch_array($obji);
                mysqli_set_charset($conn, "utf8");
                ?>
                <u><?echo $status['request_id'];?></u>
                
                <table class="table">
                    <tr>

                        <td style="text-align: center;">สถานะ</td>
                        <td style="text-align: center;">วันที่</td>
                    </tr>
                        <? if ($status['status_id'] == 1) { ?>
                        <tr class="info">

                            <td>อยู่ระหว่างดำเนินการ</td>
                            <td><? echo $status['status_date'] ?></td>
                        </tr>
                        <?
                    } else if ($status['status_id'] == 2) {
                        ?>
                        <tr class="warning">

                            <td>ถูกระงับเนื่องจากเอกสารหรือข้อมูลไม่ถูกต้อง</td>
                            <td><? echo $status['status_date'] ?></td>
                        </tr>
                        <?
                    } else if ($status['status_id'] == 3) {
                        ?>
                        <tr class="success">

                            <td>เสร็จสิ้น</td>
                            <td><? echo $status['status_date'] ?></td>
                        </tr>
                        <?
                    } else if ($status['status_id'] == 4) {
                        ?>
                        <tr class="danger">

                            <td>ถูกยกเลิก</td>
                            <td><? echo $status['status_date'] ?></td>
                        </tr>
                        <?
                        }
                        ?>
                </table>
            </div>
        </div>
    </div>