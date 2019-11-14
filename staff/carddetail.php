<?php
session_start();
if (!isset($_GET['card_id'])) {
    die();
} else {
    $card_id = $_GET['card_id'];
}

include("../config29.php");
//include("../connectSQL.php");
include("../mCrypt.class.inc.php");



$sqlCarCard = "SELECT c.card_id,e.empn, e.title,e.name, e.job_nm2, e.section1, e.section2,e.fay, e.long, t.tel_1, t.tel_2, c.card_start, c.card_end, c.remark "
        . "FROM car_card c "
        . "INNER JOIN egat1.vw_egat_emp e ON  c.emp_id=e.empn "
        . "LEFT JOIN owen_tel t ON e.empn = t.emp_id "
        . "WHERE c.card_id='$card_id'";
$qCarCard = mysqli_query($conn, $sqlCarCard);
$card = mysqli_fetch_array($qCarCard);

$date_format = 'd-m-Y';
$startDate = new DateTime($card['card_start']);
$endDate = new DateTime($card['card_end']);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script src="../js/jquery-2.2.4.js" type="text/javascript"></script>
        <!-- Bootstrap Core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap Core JavaScript -->
        <script src="../js/bootstrap.min.js"></script>
        <!-- Custom Fonts -->
        <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet">
        <style type="text/css">
            body{
              font-family: 'Prompt', sans-serif;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-lg-offset-0">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-5 col-sm-12">
                                <h4><strong><span class="fa fa-file-text"></span> รายละเอียดบัตร หมายเลข </strong> <?php echo $card['card_id'] ?></h4>
                            </div>
                        </div>
                        <div class="row" style="margin-top:5px;">
                            <div class="col-lg-5 col-sm-12">
                                <strong>เลขประจำตัว :</strong> <?php echo $card['empn'] ?>
                            </div>
                            <div class="col-lg-7 col-sm-12">
                                <strong>ชื่อ-นามสกุล :</strong> <?php echo $card['title'] ?> <?php echo $card['name'] ?>
                            </div>
                        </div>
                        <div class="row" style="margin-top:5px;">
                            <div class="col-lg-12 col-sm-12">
                                <strong>สังกัด :</strong> <?php echo $card['section1'] ?> <?php echo $card['section2'] ?> <?php echo $card['fay'] ?>
                            </div>
                        </div>
                        <div class="row" style="margin-top:5px;">
                            <div class="col-lg-3 col-sm-12">
                                <strong>โทรศัพท์ :</strong>
                                <input  type="text" id="txtTel1" value="<?php echo $card['tel_1'] ?>" />
                            </div>
                            <div class="col-lg-3 col-lg-offset-2 col-sm-12">
                                <strong>มือถือ :</strong>
                                <input  type="text" id="txtTel2" value="<?php echo $card['tel_2'] ?>"/>
                            </div>
                            <div class="col-lg-3">
                                <button id="btnSaveTel" type="button" class="btn btn-primary"><span class="fa fa-save"></span> บันทึกเบอร์โทรศัพท์</button>
                            </div>
                        </div>
                        <div class="row" style="margin-top:5px;">
                            <div class="col-lg-5 col-sm-12">
                                <strong>วันออกบัตร :</strong> <?php echo date_format($startDate,$date_format); ?>
                            </div>
                            <div class="col-lg-7 col-sm-12">
                                <strong>วันหมดอายุ :</strong> <?php echo date_format($endDate,$date_format); ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <h4><strong><span class="fa fa-car"></span> ข้อมูลรถยนต์</strong></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-hover table-bordered">
                                    <tr>
                                        <th style="width:5%;text-align: center">คันที่</th>
                                        <th style="width:15%;text-align: center">หมายเลขทะเบียน</th>
                                        <th style="width:15%;text-align: center">จังหวัด</th>
                                        <th style="width:15%;text-align: center">ยี่ห้อ</th>
                                        <th style="width:15%;text-align: center">สี</th>
                                        <th style="width:15%;text-align: center">ประเภท</th>
                                        <th style="width:10%;text-align: center">เลือก</th>
                                        <th style="width:10%;text-align: center">ลบ</th>
                                    </tr>
                                    <?php
                                    $sqlCar = "SELECT * FROM vw_car_card_detail WHERE card_id=$card_id ORDER BY id";
                                    $qCars = mysqli_query($conn, $sqlCar);
                                    $i = 1;
                                    while ($cars = mysqli_fetch_array($qCars)) {
                                        ?>
                                        <tr>
                                            <td style="text-align: center"><?php echo $i ?></td>
                                            <td><?php echo $cars['car_regis_number'] ?></td>
                                            <td><?php echo $cars['pro_name'] ?></td>
                                            <td><?php echo $cars['brand_name'] ?></td>
                                            <td><?php echo $cars['color'] ?></td>
                                            <td><?php echo $cars['ctype_name'] ?></td>
                                            <td style="text-align: center">
                                                <a class="btn btn-primary" onclick="return editCar('edit',<?php echo$cars['id'] ?>,'<?php echo$cars['car_regis_number'] ?>',<?php echo $cars['pro_id']?>,<?php echo $cars['brand_id']?>,<?php echo $cars['ctype_id']?>,'<?php echo $cars['color']?>')">
                                                    <span class="fa fa-edit"></span> แก้ไข
                                                </a>
                                            </td>
                                            <td style="text-align: center">
                                                <a class="btn btn-danger" onclick="return deleteCar(<?php echo$cars['id'] ?>)" id="btnDel">
                                                    <span class="fa fa-trash"></span> ลบ
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                    if($i<3)
                                    {
                                    ?>
                                        <tr>
                                            <td colspan="8" style="text-align: center">
                                                <button class="btn btn-success" onclick="return addCar('new')" id="btnAdd">
                                                    <span class="fa fa-plus-circle"></span> เพิ่มรถยนต์
                                                </button>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>

                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <h4><strong><span class="fa fa-edit"></span> เพิ่ม/แก้ไขข้อมูลรถยนต์</strong></h4>
                            </div>
                        </div>
                        <form class="form" method="post" id="frmCar">
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">เลขทะเบียน</label>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control frmcar" name="txtCarRegis" id="txtCarRegis" disabled=""/>
                                    <input type="hidden" id="mode" name="mode" value=""/>
                                    <input type="hidden" id="hdnCardId" name="hdnCardId" value="<?php echo $card['card_id'] ?>" />
                                    <input type="hidden" id="hdnCarId" name="hdnCarId" value=""/>
                                </div>
                                <label class="col-lg-1 col-form-label">จังหวัด</label>
                                <div class="col-lg-2">
                                    <select class="form-control frmcar" id="ddlProvince" name="ddlProvince" disabled="">
                                        <option value="">--จังหวัด--</option>
                                        <?php
                                            $sqlProvince = "SELECT * FROM province ORDER BY pro_name";
                                            $qProvince=  mysqli_query($conn, $sqlProvince);
                                            while($province=mysqli_fetch_array($qProvince))
                                            {
                                        ?>
                                                <option value="<?php echo$province['pro_id']?>"><?php echo$province['pro_name']?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <label class="col-lg-1 col-form-label">ยี่ห้อ</label>
                                <div class="col-lg-2">
                                    <select class="form-control frmcar" id="ddlBrand" name="ddlBrand" disabled="">
                                        <option value="">--เลือกยี่ห้อ--</option>
                                        <?php
                                            $sqlBrand = "SELECT * FROM brand ORDER BY brand_name";
                                            $qBrand=  mysqli_query($conn, $sqlBrand);
                                            while($Brand=mysqli_fetch_array($qBrand))
                                            {
                                        ?>
                                                <option value="<?php echo$Brand['brand_id']?>"><?php echo$Brand['brand_name']?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">สี</label>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control frmcar" id="txtColor" name="txtColor" disabled=""/>
                                </div>
                                <label class="col-lg-1 col-form-label">ประเภท</label>
                                <div class="col-lg-2">
                                    <select class="form-control frmcar" id="ddlType" name="ddlType" disabled="">
                                        <option value="">--ประเภท--</option>
                                        <?php
                                            $sqlType = "SELECT * FROM ctype ORDER BY ctype_id";
                                            $qType=  mysqli_query($conn, $sqlType);
                                            while($type=mysqli_fetch_array($qType))
                                            {
                                        ?>
                                                <option value="<?php echo$type['ctype_id']?>"><?php echo$type['ctype_name']?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12" style="text-align: center">
                                    <?php
                                     //2__ = Print By CardId: Beer
                                    $fay = "4__".$card['card_id']."__";
                                    $mCrypt = new MCrypt();
                                    $encrypt=$mCrypt->encrypt($fay);
                                    ?>
                                    <a class="btn btn-success" id="btnPrint" href="http://10.20.192.19/servletCarcard2/rptService?param1=<?php echo $encrypt?>" target="_blank">
                                        <span class="fa fa-print"></span> พิมพ์บัตร
                                    </a>
                                    <button class="btn btn-primary" type="submit" id="btnUpdate" disabled>บันทึกข้อมูล</button>
                                    <button class="btn btn-danger" onclick="return addCar('new')" id="btnCancel" type="button" disabled>
                                        <span class="fa fa-ban"> ยกเลิก</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" class="">
                                    ประวัติการพิมพ์บัตร
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in" aria-expanded="true" style="">
                            <div class="panel-body">
                                <table class="table table-bordered table-striped table-condensed">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width:30%">วันที่</th>
                                            <th class="text-center" style="width:30%">ผู้พิมพ์</th>
                                            <th class="text-center" style="width:40%">หมายเหตุ</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tblCardLog">
                                        <?php
                                            $sqlLog = "SELECT l.printedDate, l.printedBy, e.name, l.remark FROM card_log l INNER JOIN egat1.vw_egat_emp e ON e.empn=l.printedBy WHERE card_id = '$card[card_id]' ORDER BY printedDate DESC LIMIT 0,5";
                                            $qLog = mysqli_query($conn, $sqlLog) or die(mysqli_error($conn));
                                            if(mysqli_num_rows($qLog)>0)
                                            {
                                                while($log = mysqli_fetch_array($qLog))
                                                {
                                        ?>
                                                    <tr>
                                                        <td><?php echo $log['printedDate'] ?></td>
                                                        <td><?php echo "$log[printedBy]: $log[name]" ?></td>
                                                        <td><?php echo $log['remark'] ?></td>
                                                    </tr>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            function editCar(mode,car_id,car_regis,pro_id,brand_id,ctype_id,color)
            {
                $(".frmcar").prop('disabled',false);
                $("#btnUpdate").prop("disabled", false);
                $("#btnCancel").prop("disabled", false);
                $("#mode").val(mode);
                $("#hdnCarId").val(car_id);
                $("#txtCarRegis").val(car_regis);
                $("#ddlProvince").val(pro_id);
                $("#ddlBrand").val(brand_id);
                $("#ddlType").val(ctype_id);
                $("#txtColor").val(color);
            }

            $(document).ready(function(){

                $("#frmCar").submit(function(){
                    if(confirm("ยืนยันการบันทึกข้อมูล"))
                    {
                        var f = $(this).serializeArray();

                        $.ajax({
                            url: "updatecar.php",
                            data: f,
                            type: 'POST',
                            success : function(msg) {
                                alert(msg);
                                window.location.reload(true);
                            }
                        });
                    }
                });

                $("#btnCancel").click(function(){
                    $(this).prop("disabled", true);
                    $("#btnUpdate").prop("disabled", true);
                    $(".frmcar").prop('disabled',true);
                    $(".frmcar").val('');
                });

                $("#btnSaveTel").click(function(){
                    var f ={"tel1":$("#txtTel1").val(), "tel2":$("#txtTel2").val(),"empId": <?php echo $card['empn'] ?>};
                    //console.log(f);
                    $.ajax({
                            url: "updatetel.php",
                            data: f,
                            type: 'POST',
                            success : function(data) {
                                console.log(data);
                                if(parseInt(data)==0)
                                {
                                    alert("เกิดข้อผิดพลาดในการบันทึกข้อมูล โปรดลองใหม่อีกครั้ง");
                                }
                                else
                                {
                                    alert("บันทึกข้อมูลเรียบร้อยแล้ว");
                                    window.location.reload(true);
                                }
                            }
                        });
                });

                $("#btnPrint").click(function(){
                    var remark = prompt("หมายเหตุในการพิมพ์บัตร");
                    if(remark)
                    {
                        var printlog = {
                                        "cardId" : <?php echo $card_id ?>,
                                        "printedBy" : <?php echo $_SESSION['username']; ?>,
                                        "remark" : remark
                                    }
                        $.ajax({
                            url : "saveprintlog.php",
                            data: printlog,
                            type: "POST",
                            dataType: "json",
                            success : function (result){
                                console.log(result);
                                if(result[0]==1)
                                {
                                    var printedName = result[1].printedBy + ": " + result[1].name
                                    var newRow = "<tr><td>" + result[1].printedDate + "</td><td>" +  printedName + "</td><td>" + result[1].remark + "</td></tr>";
                                    $("#tblCardLog").prepend(newRow);
                                }
                            }

                        });
                    }
                    else
                    {
                        return false;
                    }
                });
            });

            function addCar(mode)
            {
                $("#btnUpdate").prop("disabled", false);
                $("#btnCancel").prop("disabled", false);
                $("#mode").val(mode);
                $(".frmcar").prop('disabled',false);
                $(".frmcar").val('');
            }

            function deleteCar(car_id)
            {
                if(confirm("ยืนยันการลบข้อมูล?"))
                {
                    $.ajax({
                            url: "deletecar.php?car_id=" + car_id,
                            data: car_id,
                            type: 'POST',
                            success : function(msg) {
                                alert(msg);
                                window.location.reload(true);
                            }
                        });
                }
            }
        </script>
    </body>
</html>
