<div class="row" style="margin-top: 20px;">
    <div class="col-lg-12 col-lg-offset-0" style="border:0px solid #08C;">
        <div class="row" style="padding:15px;">
            <div class="col-xs-12">
                <form name="request" method="post" action="request_car_1.php" enctype="multipart/form-data" onSubmit="JavaScript:return fncSubmit();">  
                    <div class="row">
                        <div class="col-xs-12">
                            <h4><b><u>ลงทะเบียนขอบัตรอนุญาตจอดรถยนต์</u></b></h4>
                        </div>
                        <div class="col-xs-12" style="margin-top: 17px;">
                            <h4>1. ข้อมูลผู้ขอใช้บริการ</h4>
                        </div
                        <?php
                        $connect = mysqli_connect("10.20.192.29", "intern_mfu", "mfu2016");
                        mysqli_select_db($connect, "ac_db") or die("ติดต่อฐานข้อมูลไม่ได้");

                        $username = $_SESSION['username'];
                        $empn = $username;
                        $sql = "SELECT * from vw_egat_emp where empn='$username'";
                        $objQuery = mysqli_query($connect, $sql);
                        $row = mysqli_fetch_array($objQuery);
                        ?>

                        <div class="form-group">
                            <div class="col-lg-12" style="margin-top: 15px;">
                                <div class="col-lg-2">
                                    <label>ชื่อ - สกุล</label>
                                </div>
                                <div class="col-lg-10">
                                    <? echo $row['title'] . $row['name'] ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-12" style="margin-top: 15px;">
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
                            <div class="col-lg-12" style="margin-top: 15px;">
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
                            <div class="col-lg-12" style="margin-top: 15px;">
                                <div class="col-lg-2">
                                    <label>ฝ่าย</label>
                                </div>
                                <div class="col-lg-4">
                                    <? echo trim($row['fay']) == '' ? '-' : $row['fay']; ?>
                                </div>

                                <div class="col-lg-2">
                                    <label>สายงาน</label>
                                </div>
                                <div class="col-lg-4">
                                    <? echo trim($row['long']) == '' ? '-' : $row['long']; ?>
                                </div>
                            </div>
                        </div>
                    
                    <div class="col-xs-12" style="margin-top: 17px;">
                        <h4><i class="fa fa-info-circle fa-fw"></i> ข้อมูลติดต่อ</h4>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-6" style="margin-top: 10px;">
                            <label for="address">ที่อยู่ปัจจุบัน</label>
                            <input type="text" class="form-control" id="address" name="address" maxlength="10"/>
                        </div>
                        <div class="col-lg-6" style="margin-top: 10px;">
                            <label for="moo">หมู่ที่</label>
                            <input type="text" class="form-control" id="moo" name="moo" maxlength="5"/>
                        </div>
                        <div class="col-lg-6" style="margin-top: 10px;">  
                            <label for="soi">ตรอก/ซอย</label>
                            <input type="text" class="form-control" id="soi" name="soi" maxlength="20"/>
                        </div>
                        <div class="col-lg-6" style="margin-top: 10px;">
                            <label for="road">ถนน</label>
                            <input type="text" class="form-control" id="road" name="road" maxlength="20"/>
                        </div>
                        <div class="col-lg-6" style="margin-top: 10px;">
                            <label for="subdistrict">ตำบล/แขวง</label>
                            <input type="text" class="form-control" id="subdistrict" name="subdistrict" maxlength="20"/>
                        </div>
                        <div class="col-lg-6" style="margin-top: 10px;">
                            <label for="district">อำเภอ/เขต</label>
                            <input type="text" class="form-control" id="district" name="district" maxlength="20"/>
                        </div>
                        <div class="col-lg-6" style="margin-top: 10px;">
                            <label for="province_id0">จังหวัด</label>
                            <select class="form-control" id="province_id0" name="province_id0">
                                <?php
                                include 'connectSQL.php';
                                $strSQL = "SELECT * FROM province";
                                $objQuery = mysqli_query($objConnect, $strSQL) or die(mysqli_error());
                                ?>
                                <option value="0" selected="selected" >เลือกจังหวัด</option>
                                <?php
                                while ($row = mysqli_fetch_array($objQuery)) {
                                    ?>
                                    <option value="<?php echo $row["pro_id"]; ?>"><?php echo $row["pro_name"]; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-6" style="margin-top: 10px;">
                            <label for="postcode">รหัสไปรษณีย์</label>
                            <input type="text" class="form-control" id="postcode" name="postcode" maxlength="5"/>
                        </div> <div class="col-lg-6" style="margin-top: 15px;">
                            <label for="tel">โทรศัพท์</label>
                            <input type="tel" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength=10 class="form-control" id="tel" name="tel" maxlength="10"/>
                        </div>
                        <div class="col-lg-6" style="margin-top: 15px;">
                            <label for="email">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" maxlength="50"/>
                        </div>                    

                    </div>                        
                    <div class="row">
                        <div class="col-xs-12" style="margin-top:30px;">                                
                            <h4>2. ข้อมูลรถยนต์</h4>                                
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">        
                            <strong>รถยนต์ที่มีการลงทะเบียนไว้แล้ว</strong>
                        </div>
                        <div class="col-xs-12">
                            <?
                            $sqlCars = "SELECT car_regis_number,p.pro_name, b.brand_name, c.color_name, t.ctype_name FROM car_card "
                                    . " INNER JOIN car ON car_card.card_id = car.card_id "
                                    . " INNER JOIN province p ON car.pro_id = p.pro_id "
                                    . " INNER JOIN brand b ON car.brand_id = b.brand_id "
                                    . " INNER JOIN ctype t ON car.ctype_id = t.ctype_id "
                                    . " INNER JOIN color c ON car.color_id = c.color_id "
                                    . " WHERE car_card.emp_id = '$empn'";
                            $qCars = mysqli_query($objConnect, $sqlCars);
                            $registeredCar = mysqli_num_rows($qCars);
                            ?>
                            <table class="table table-responsive table-hover table-striped table-bordered" >
                                <tr>
                                    <th style="text-align: center;width: 7%;"><u>ลำดับ</u></th>
                                <th style="text-align: center;width: 30%;">หมายเลขทะเบียน</th>
                                <th style="text-align: center;width: 30%;">จังหวัด</th>
                                <th style="text-align: center;width: 11%;">ยี่ห้อ</th>
                                <th style="text-align: center;width: 11%;">สี</th>
                                <th style="text-align: center;width: 11%;">ประเภท</th>
                                </tr>
                                <?php
                                if ($registeredCar == 0) {
                                    ?>
                                    <tr>
                                        <td colspan="6" style="text-align: center">--ไม่พบข้อมูลรถยนต์ที่ลงทะเบียนบัตรอนุญาตไว้แล้ว--</td>
                                    </tr>
                                    <?php
                                } else {
                                    $i = 1;
                                    while ($r = mysqli_fetch_array($qCars)) {
                                        ?>
                                        <tr>
                                            <td style="text-align: center;"><?php echo $i ?></td>
                                            <td><?php echo $r['car_regis_number'] ?></td>
                                            <td><?php echo $r['pro_name'] ?></td>
                                            <td><?php echo $r['brand_name'] ?></td>
                                            <td><?php echo $r['color_name'] ?></td>
                                            <td><?php echo $r['ctype_name'] ?></td>
                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                    <?php
                    $remainingCar = $limit_car - $registeredCar;
                    if ($remainingCar == 0) {
                        ?>
                        <div style="clear:" class="row">
                            <div class="col-xs-12" style="text-align:center">
                                <div class="alert alert-danger">
                                    ท่านได้ลงทะเบียนรถยนต์เพื่อขอรับบัตรอนุญาตฯ ครบตามจำนวนที่กำหนดแล้ว กรุณาติดต่อแผนกบัตรรักษาความปลอดภัย โทร.64222 เพื่อแจ้งแก้ไขข้อมูลรถยนต์
                                </div>
                            </div>
                        </div>

                        <?php
                    } else {
                        ?>
                        <div style="clear:" class="row">
                            <div class="col-xs-12" >
                                <strong>เพิ่มข้อมูลรถยนต์ใหม่</strong>
                            </div>
                        </div>
                        <?php
                        for ($i = 1; $i <= $remainingCar; $i++) {
                            if ($i == 1) {
                                $str = "disabled checked";
                            } else
                                $str = "";
                            ?>
                            <div style="clear:" class="col-lg-12">
                                <input type="checkbox" id="car<?php echo $i; ?>" name="car<?php echo $i; ?>" <?php echo $str; ?>><label><div style="margin-left:10px; margin-top: 15px;">รถคันที่ <?php echo $i; ?></div></label>
                                  <div class="lool" id="divcar<?$i;?>">
                                    <div class="form-group">
                                        <div class="col-lg-4">
                                            <label for="car_regis_number<?php echo $i; ?>">หมายเลขทะเบียน</label>
                                            <input type="text" class="form-control" id="car_regis_number<?php echo $i; ?>" name="car_regis_number[]" maxlength="10"/>
                                        </div>  
                                        <div class="col-lg-4">
                                            <label for="province_id<?php echo $i; ?>">จังหวัด</label>
                                            <select class="form-control" id="province_id<?php echo $i; ?>" name="province_id[]">
                                                <?php
                                                include 'connectSQL.php';
                                                $strSQL = "SELECT * FROM province";
                                                $objQuery = mysqli_query($objConnect, $strSQL) or die(mysqli_error());
                                                ?>
                                                <option value="0" selected="selected" >เลือกจังหวัด</option>
                                                <?php
                                                while ($row = mysqli_fetch_array($objQuery)) {
                                                    ?>
                                                    <option value="<?php echo $row["pro_id"]; ?>"><?php echo $row["pro_name"]; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="brand_id<?php echo $i; ?>">ยี่ห้อรถยนต์</label>
                                            <select class="form-control" id="brand_id<?php echo $i; ?>" name="brand_id[]">
                                                <?php
                                                $strSQL = "SELECT * FROM brand";
                                                $objQuery = mysqli_query($objConnect, $strSQL);
                                                ?>
                                                <option value="0" selected="selected">เลือกชื่อยี่ห้อ</option>
                                                <?php
                                                while ($row = mysqli_fetch_array($objQuery)) {
                                                    ?>
                                                    <option value="<?php echo $row["brand_id"]; ?>"><?php echo $row["brand_name"]; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>                        
                                        <div class="col-lg-4" style="margin-top: 10px;">
                                            <label for="color_id<?php echo $i; ?>">สี</label>
                                            <select class="form-control" id="color_id<?php echo $i; ?>" name="color_id[]">
                                                <?php
                                                $strSQL = "SELECT * FROM color";
                                                $objQuery = mysqli_query($objConnect, $strSQL)
                                                ?>
                                                <option value="0" selected="selected">เลือกสี</option>
                                                <?php
                                                while ($row = mysqli_fetch_array($objQuery)) {
                                                    ?>
                                                    <option value="<?php echo $row["color_id"]; ?>"><?php echo $row["color_name"]; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-4" style="margin-top: 10px;">
                                            <label for="ctype_id<?php echo $i; ?>">ลักษณะ/ประเภทรถยนต์</label>
                                            <select class="form-control" id="ctpye_id<?php echo $i; ?>" name="ctype_id[]">
                                                <?php
                                                $strSQL = "SELECT * FROM ctype";
                                                $objQuery = mysqli_query($objConnect, $strSQL)
                                                ?>
                                                <option value="0" selected="selected">เลือกลักษณะ/ประเภท</option>
                                                <?php
                                                while ($row = mysqli_fetch_array($objQuery)) {
                                                    ?>
                                                    <option value="<?php echo $row["ctype_id"]; ?>"><?php echo $row["ctype_name"]; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <!--<div class="col-lg-4" style="margin-top: 10px;">
                                            <label for="area_id<?php echo $i; ?>">ผ่านบริเวณ</label>
                                            <div class="radio">
                                         <label>
                                        <?php
                                        $strSQL = "SELECT * FROM area";
                                        $objQuery = mysqli_query($objConnect, $strSQL);
                                        while ($row = mysqli_fetch_array($objQuery)) {
                                            ?>
                                         <label>
                                           <input type="radio" id="area_id_<?php $row['area_id']; ?>" name="area_id[]" value="<?php echo $row["area_id"]; ?>" onchange="changeArea(1);"/><?php echo $row["area_name"]; ?><br>
                                         </label>
                                            <?php
                                        }
                                        ?>
                                         </label>
                                         </div>
                                         <input type="hidden" name="area<?php echo $i; ?>" id="area<?php echo $i; ?>" value="0"/>
                                         </div>-->
                                        <div class="col-xs-12" style="margin-top:10px;">                                
                                            <h4>โปรดแนบเอกสารประกอบการพิจารณาดังต่อไปนี้</h4>                                
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="car_license<?php echo $i; ?>">สำเนาทะเบียนรถยนต์</label>
                                            <input type="file" class="form-control" id="car_license<?php echo $i; ?>" name="car_license[]">
                                        </div>
                                        <div class="col-xs-12" style="margin-top:10px;">                                
                                            <h4>กรณีเป็นรถของบุคคลอื่น</h4>                                
                                        </div>
                                        <div style="clear:" class="col-lg-12">
                                            <input type="radio" id="dupHouse<?php echo $i; ?>" name="ownertype[]" value="1" checked="checked" onclick="popupPanel(this,<?php echo $i;?>)"><label><div style="margin-left:10px;">รถยนต์ของบิดา-มารดา</div></label>
                                            <div class="lool">
                                                <div class="col-lg-6" id="parent_panel<?php echo $i;?>">
                                                    <label for="house_registration<?php echo $i; ?>" id="house">สำเนาทะเบียนบ้าน</label>
                                                    <input type="file" class="form-control" id="house_registration" name="house_registration[]" aria-describedby="fileHelp_house">
                                                    <small id="fileHelp_car" class="form-text text-muted">กรณีเป็นรถยนต์ของบิดา-มารดา หรือบุตร</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="clear:" class="col-lg-12">
                                            <input type="radio" id="dupMarriage<?php echo $i; ?>" name="ownertype[]" value="2" onclick="popupPanel(this,<?php echo $i;?>)"><label><div style="margin-left:10px;">รถยนต์ของคู่สมรส</div></label>
                                            <div class="lool">
                                                <div class="col-lg-6 " id="marriage_panel<?php echo $i;?>">
                                                    <label for="marriage_license<?php echo $i; ?>" id="marriage">สำเนาทะเบียนสมรส</label>
                                                    <input type="file" class="form-control" id="marriage_license" name="marriage_license[]" aria-describedby="fileHelp_marriage">
                                                    <small id="fileHelp_car1" class="form-text text-muted">กรณีเป็นรถยนต์ของคู่สมรส</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <?php
                                                }
                                            }
                                ?>
                                <?php
                                    $remainingCar = $limit_car - $registeredCar;
                                    if ($remainingCar != 0) 
                                            {
                                ?>
                        <div class="row">
                            <div class="col-lg-10" style="margin-top: 20px; margin-bottom: 100px; margin-left: 15px;">
                                <button type="submit" class="btn btn-info" id="btnsubmit">
                                    <span class="fa fa-forward fa-fw" aria-hidden="true"></span>
                                    Submit
                                </button>
                            </div>
                        </div>
                                <?php
                                            }
                                ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
                    <script type="text/javascript">
                        $(document).ready(function (){
                            $("#marriage_panel1").hide();
                            $("#marriage_panel2").hide();
                        });
                        
                        function popupPanel(row,cnt){
                            //alert($(row).attr("id"));
                            if($(row).attr("id") === "dupHouse"+cnt){
                               $("#marriage_panel"+cnt).hide(700);
                               $("#parent_panel"+cnt).show(700);
                            }else{
                               $("#parent_panel"+cnt).hide(700);
                               $("#marriage_panel"+cnt).show(700);
                            }
                            
                        }
                    </script>