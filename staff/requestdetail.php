<?php
session_start();

$request_id = $_GET['req_id'];

$sqlii = "SELECT * from requests "
        . "INNER JOIN province ON requests.province_id = province.pro_id where request_id='$request_id'";
$objQuery2 = mysqli_query($objConnect, $sqlii);
$pro = mysqli_fetch_array($objQuery2);


//______________________________________________//


$sql = "SELECT * from vw_egat_emp where empn='$pro[emp_id]'";
$objQuery = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($objQuery);
?>

        <!-- Add jQuery library -->
        <!--<script src="../js/jquery.min.js" type="text/javascript"></script>-->

        <!-- Add mousewheel plugin (this is optional) -->
        <script src="../js/jquery.mousewheel-3.0.6.pack.js" type="text/javascript"></script>

        <!-- Add fancyBox main JS and CSS files -->
        <script src="../js/jquery.fancybox.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="../source/jquery.fancybox.css?v=2.1.5" media="screen" />

        <!-- Add Button helper (this is optional) -->
        <link href="../source/helpers/jquery.fancybox-buttons.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="../source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>

        <!-- Add Thumbnail helper (this is optional) -->
        <link rel="stylesheet" type="text/css" href="../source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
        <script type="text/javascript" src="../source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

        <!-- Add Media helper (this is optional) -->
        <script type="text/javascript" src="../source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>


<script type="text/javascript">
                    $(document).ready(function() {                        
                        $('a[class="file"]').fancybox({
				'width'				: '80%',
				'height'			: '60%',
				'autoScale'     	: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'type'				: 'iframe',
				onClosed	:	function() {
					parent.location.reload(true); 
				}
                            });
			});
</script>
 <form method="post" action="approve.php">
<div class="row" style="margin-top: 20px;">
    <div class="col-lg-12 col-lg-offset-0" style="border:0px solid #08C;">
        <div class="row">
                <div class="form-group">
                    <div class="col-lg-12" style="margin-top: 15px;margin-left: 15px;">
                        <div class="col-lg-2">
                            <label>ชื่อ - สกุล</label>
                        </div>
                        <div class="col-lg-10">
                            <? echo $row['title'] . $row['name'] ?>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-12" style="margin-top: 15px;margin-left: 15px;">
                        <div class="col-lg-2">
                            <label>เลขประจำตัว</label>
                        </div>
                        <div class="col-lg-4">
                            <? echo $row['empn'] ?>
                        </div>

                        <div class="col-lg-2">
                            <label>ตำแหน่ง</label>
                        </div>
                        <div class="col-lg-4">
                            <? echo $row['job_nm2'] ?>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-12" style="margin-top: 15px;margin-left: 15px;">
                        <div class="col-lg-2">
                            <label>สังกัดแผนก</label>
                        </div>
                        <div class="col-lg-4">
                            <? echo trim($row['section1']) == '' ? '-' : $row['section1']; ?>
                        </div>

                        <div class="col-lg-2">
                            <label>กอง</label>
                        </div>
                        <div class="col-lg-4">
                            <? echo trim($row['section2']) == '' ? '-' : $row['section2']; ?>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-12" style="margin-top: 15px;margin-left: 15px;">
                        <div class="col-lg-2">
                            <label>โทรศัพท์</label>
                        </div>
                        <div class="col-lg-4">
                            <? echo $pro['tel'] ?>
                        </div>

                        <div class="col-lg-2">
                            <label>E-mail</label>
                        </div>
                        <div class="col-lg-4">
                            <? echo $pro['email'] ?>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-12" style="margin-top: 15px;margin-left: 15px;">
                        <div class="col-lg-2">
                            <label>ที่อยู่</label>
                        </div>
                        <div class="col-lg-4">
                            <? echo $pro['address'] ?>
                        </div>

                        <div class="col-lg-2">
                            <label>หมู่</label>
                        </div>
                        <div class="col-lg-4">
                            <? echo $pro['moo'] ?>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-12" style="margin-top: 15px;margin-left: 15px;">
                        <div class="col-lg-2">
                            <label>ตรอก/ซอย</label>
                        </div>
                        <div class="col-lg-4">
                            <? echo $pro['soi'] ?>
                        </div>

                        <div class="col-lg-2">
                            <label>ถนน</label>
                        </div>
                        <div class="col-lg-4">
                            <? echo $pro['road'] ?>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-12" style="margin-top: 15px;margin-left: 15px;">
                        <div class="col-lg-2">
                            <label>ตำบล/แขวง</label>
                        </div>
                        <div class="col-lg-4">
                            <? echo $pro['subdistrict'] ?>
                        </div>

                        <div class="col-lg-2">
                            <label>อำเภอ/เขต</label>
                        </div>
                        <div class="col-lg-4">
                            <? echo $pro['district'] ?>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-12" style="margin-top: 15px;margin-left: 15px;">
                        <div class="col-lg-2">
                            <label>จังหวัด</label>
                        </div>
                        <div class="col-lg-4">
                            <? echo $pro['pro_name'] ?>
                        </div>

                        <div class="col-lg-2">
                            <label>รหัสไปรษณีย์</label>
                        </div>
                        <div class="col-lg-4">
                            <? echo $pro['postcode'] ?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12" style="margin-top: 15px;">
                    <label><u>รายละเอียดคำขอ</u></label>
                </div>
                <?
                $sqlCars = "SELECT request_id,request_car_id,car_regis_number,pro_name,brand_name,color_name,ctype_name,owner_type from request_car "
                        . "inner join province on request_car.province_id=province.pro_id "
                        . "inner join brand on request_car.brand=brand.brand_id "
                        . "inner join color on request_car.color=color.color_id "
                        . "inner join ctype on request_car.ctype=ctype.ctype_id "
                        . "where request_id='$request_id'";
                $qCars = mysqli_query($objConnect, $sqlCars);
                $i = 1;
                while ($registeredCar = mysqli_fetch_array($qCars)) {
                    ?>
                    <input type="hidden" name="req_id" value="<?echo $registeredCar['request_id'];?>">
                    <div class="col-lg-12" style="margin-top: 15px;">
                        <label><i class="fa fa-tags fa-fw"></i> รถยนต์คันที่ <? echo $i; ?></label>
                    </div>
                    <div class="col-lg-12" style="margin-top: 15px;margin-left: 15px;">
                        <div class="col-lg-2">
                            <label>หมายเลขทะเบียนรถ</label>
                        </div>
                        <div class="col-lg-4">
                            <? echo $registeredCar['car_regis_number'] ?>
                        </div>
                        <div class="col-lg-2">
                            <label>จังหวัด</label>
                        </div>
                        <div class="col-lg-4">
                            <? echo $registeredCar['pro_name'] ?>
                        </div>
                    </div>
                    <div class="col-lg-12" style="margin-top: 15px;margin-left: 15px;">
                        <div class="col-lg-2">
                            <label>ยี่ห้อ</label>
                        </div>
                        <div class="col-lg-4">
                            <? echo $registeredCar['brand_name'] ?>
                        </div>
                        <div class="col-lg-2">
                            <label>สี</label>
                        </div>
                        <div class="col-lg-4">
                            <? echo $registeredCar['color_name'] ?>
                        </div>
                    </div>
                    <div class="col-lg-12" style="margin-top: 15px;margin-left: 15px;">
                        <div class="col-lg-2">
                            <label>ประเภท</label>
                        </div>
                        <div class="col-lg-4">
                            <? echo $registeredCar['ctype_name'] ?>
                        </div>
                    </div>
                    <div class="col-lg-12" style="margin-top: 15px;margin-left: 15px;">
                        <div class="col-lg-2">
                            <label>เป็นรถยนต์ของ</label>
                        </div>
                        <div class="col-lg-4">
                            <?
                                switch ($registeredCar['owner_type']) {
                                    case 0:$owner = "ตนเอง";
                                        break;
                                    case 1:$owner = "บิดา-มารดา";
                                        break;
                                    case 2:$owner = "คู่สมรส";
                                        break;
                                }
                                echo $owner;
                                ?>
                        </div>
                    </div>
                    <div class="col-lg-12" style="margin-left: 15px;margin-top: 15px;">
                        <div class="col-lg-2">
                            <label>เอกสารประกอบ</label>
                        </div>
                    </div>
                    <div class="col-lg-8 col-lg-offset-1" style="border:1px solid #000;margin-top: 10px;" id="form1" name="form1">
                        <table style="width: 100%">
                            <tr>
                                <td style="width: 20%">1.สำเนาทะเบียนรถยนต์ :</td>
                                <td><a href="viewfile.php?req_id=<?php echo $request_id?>&req_car_id=<?php echo $registeredCar[request_car_id]?>&doc=0" class="file" name="file"><i class="fa fa-file-pdf-o fa-fw"></i>คลิกเพื่อดูเอกสาร</a></td>
                            </tr>
                            <tr>
                                <?
                                if ($registeredCar['owner_type'] == 1) {
                                    ?>
                                    <td style="width: 20%">2.สำเนาทะเบียนบ้าน :</td>
                                    <td><a href="viewfile.php?req_id=<?php echo $request_id?>&req_car_id=<?php echo $registeredCar[request_car_id]?>&doc=1" class="file" name=""><i class="fa fa-file-pdf-o fa-fw"></i>คลิกเพื่อดูเอกสาร</a></td>
                                    <?
                                } else if ($registeredCar['owner_type'] == 2) {
                                    ?>
                                    <td style="width: 20%">2.สำเนาทะเบียนสมรส :</td>
                                    <td><a href="viewfile.php?req_id=<?php echo $request_id?>&req_car_id=<?php echo $registeredCar[request_car_id]?>&doc=2" class="file" name=""><i class="fa fa-file-pdf-o fa-fw"></i>คลิกเพื่อดูเอกสาร</a></td>
                                    <?
                                }
                                ?>
                            </tr>
                        </table>
                    </div>
                <?
                    $i++;
                }
                ?>
                
                <?
                    $sql = "SELECT MAX(status_id) as ST FROM status_log WHERE request_id='$request_id'";
                    $status = mysqli_query($objConnect,$sql);
                    $s = mysqli_fetch_array($status);
                    if($s['ST']!=3){
                ?>
                <div class="col-lg-12" style="margin-top: 15px;">
                    <label><u>การพิจารณา</u></label>
                </div>  
                    
                <div class="col-lg-12">
                    <?
                    if($s['ST']<=0){
                    ?>
                        <div class="radio">
                            <label style="margin-left: 15px;"><input type="radio" name="optradio" id="radio2" value="2" checked="checked">รอการตัดสินใจ</label>
                        </div>
                    <?
                                }
                    ?>
                        <div class="radio">
                            <label style="margin-left: 15px;"><input type="radio" name="optradio" id="radio" value="1">ข้อมูลถูกต้องแล้ว ดำเนินการออกบัตรได้</label>
                        </div>
                        <div class="radio">
                            <label style="margin-left: 15px;"><input type="radio" name="optradio" id="radio1" value="0">ข้อมูลไม่ถูกต้อง เนื่องจาก..</label>
                        </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group" style="margin-top: 15px;margin-left: 15px;">
                        <textarea class="form-control" rows="5" id="comment" name="comment" placeholder="เนื่องจาก..."></textarea>
                    </div>
                </div>
            
        </div>
        <button type="submit" class="btn btn-primary" id="btnsave">บันทึกข้อมูล</button>
        <button class="btn btn-warning" id="btnback"><a href="requestlist.php"></a>ย้อนกลับ</button>
                <?
                                }
                
                ?>
        </div>   
    </div>
</form>
        <script type="text/javascript">
            $(document).ready(function (){
                $("#comment").hide();
                $("#radio1").click(function (){
                    $("#comment").show(800);
                $("#radio").click(function (){
                    $("#comment").hide(800);
                $("#radio2").click(function (){
                    $("#comment").hide(800);
                        });
                    });
                });
            });
        </script>