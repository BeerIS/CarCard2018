<?php
session_start();
include("../config29.php");
//include("../connectSQL.php");
include("../mCrypt.class.inc.php");
if (isset($_GET['owenType'])) {
    $owenType = $_GET['owenType'];
    if ($owenType == 3) {
        $typeName = "คณะกรรมการ กฟผ.";
    } else if ($owenType == 4) {
        $typeName = "บุคคลภายนอก";
    }
}
$sqlowen = "SELECT * FROM nonemp_owen "
        . " WHERE otype_id = '$owenType'"
        . " ORDER BY owen_id DESC";
//echo $sqlowen;
$qowen = mysqli_query($conn, $sqlowen);
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

        <link href="../datatables.css" rel="stylesheet" type="text/css"/>
        <script src="../datatables.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-lg-offset-0">
                    <h3>รายชื่อผู้ลงทะเบียนบัตร ประเภท: <?php echo $typeName ?> </h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-lg-offset-0">
                    <table class="table table-striped table-bordered table-hover table-condensed" id="tbllist">
                        <thead>
                            <tr>
                                <th style="text-align:center">ลำดับ</th>
                                <th style="text-align:center">ID</th>
                                <th style="text-align:center">ชื่อ - สกุล</th>
                                <th style="text-align:center">รายละเอียด</th>
                                <th style="text-align:center">โทรศัพท์</th>
                                <th style="text-align:center">มือถือ</th>
                                <th style="text-align:center">เลือก</th>
                                <th style="text-align:center">แก้ไข</th>
                                <th style="text-align:center">ลบ</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?
                        $i = 1;
                        while ($row = mysqli_fetch_array($qowen)) 
                        {
                        ?>
                                <tr>
                                    <td style="text-align: center"><?php echo $i ?></td>
                                    <td style="text-align: center" id="owenId-<?php echo $row['owen_id'] ?>"><?php echo $row['owen_id'] ?></td>
                                    <td id="owenName-<?php echo $row['owen_id'] ?>"><?php echo $row['owen_prefix'] ?> <?php echo $row['owen_name'] ?><input type="hidden" id="owenPrefix-<?php echo $row['owen_id'] ?>" name="owenPrefix-<?php echo $row['owen_id'] ?>" value="<?php echo $row['owen_prefix'] ?>"><input type="hidden" id="owenName2-<?php echo $row['owen_id'] ?>" name="owenName2-<?php echo $row['owen_id'] ?>" value="<?php echo $row['owen_name'] ?>">
                                    </td>
                                    <td id="owenAdd-<?php echo $row['owen_id'] ?>"><?php echo $row['owen_add'] ?></td>
                                    <td id="owenTel1-<?php echo $row['owen_id'] ?>"><?php echo $row['tel1'] ?></td>
                                    <td id="owenTel2-<?php echo $row['owen_id'] ?>"><?php echo $row['tel2'] ?></td>
                                    <td style="text-align: center">
                                        <input type="hidden" id="hdnOwenId" name="hdnOwenId" value="<?php echo$row['owen_id'] ?>" />
                                        <input type="hidden" id="hdnOwenType-<?php echo $row['owen_id'] ?>" name="hdnOwenType" value="<?php echo $row['otype_id'] ?>"/>
                                        <a class="select" data-id="<?php echo $row['owen_id'] ?>"><span class="fa fa-hand-paper-o"></span> เลือก</a>&nbsp;
                                    </td>
                                    <td style="text-align: center">
                                        <a class="edit" data-id="<?php echo $row['owen_id'] ?>"><span class="fa fa-pencil"></span> แก้ไข</a>
                                    </td>
                                    <td style="text-align: center">
                                        <a class="del" data-id="<?php echo $row['owen_id'] ?>"><span class="fa fa-trash"></span> ลบ</a>
                                    </td>
                                </tr>
                        <?
                            $i++;
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h4><strong><span class="fa fa-edit"></span> เพิ่ม/แก้ไขข้อมูลผู้ลงทะเบียนบัตร</strong></h4>
                </div>
            </div>
            <div class="row">
                <form name="frmNewCard" id="frmNewCard" method="post" class="form-horizontal">
                    <div class="row">
                        <div class="form-group">
                            <label for="owenId" class="control-label col-md-2">
                                เลขประจำตัว:
                            </label>
                            <div class="col-md-2">
                                <input type="text" id="txtOwenId" name="txtOwenId" class="form-control" readonly required>
                            </div>
                            <div class="col-md-1" style="padding-left: 0px;">
                                <button type="button" class="btn btn-primary btn-sm btn-block" id="btnNewOwen">
                                    <span class="fa fa-plus"></span> เพิ่ม
                                </button>
                            </div>
                            <label for="owenId" class="control-label col-md-2">
                                ชื่อ-นามสกุล:
                            </label>
                            <div class="col-md-1" style="padding-left:0px;padding-right: 0px;">
                                <input type="text" id="txtOwenPrefix" name="txtOwenPrefix" class="form-control" placeholder="คำนำหน้า" required>
                            </div>
                            <div class="col-md-4" style="padding-left: 0px;">
                                <input type="text" id="txtOwenName" name="txtOwenName" class="form-control" placeholder="ชื่อ-นามสกุล" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="owenId" class="control-label col-md-2">
                                รายละเอียด:
                            </label>
                            <div class="col-md-10">
                                <input type="text" id="txtOwenAdd" name="txtOwenAdd" class="form-control" placeholder="หน่วยงานที่สังกัดเช่น สอ.กฟผ. รส.กฟผ ธนาคารกรุงไทย" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="owenId" class="control-label col-md-2">
                                โทรศัพท์:
                            </label>
                            <div class="col-md-4">
                                <input type="text" id="txtOwenTel1" name="txtOwenTel1" class="form-control" required>
                            </div>
                            <label for="owenId" class="control-label col-md-2">
                                โทรศัพท์มือถือ:
                            </label>
                            <div class="col-md-4">
                                <input type="text" id="txtOwenTel2" name="txtOwenTel2" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-md-12" style="text-align: center;">
                                <input type="hidden" id="hdnOwenType" name="hdnOwenType" value="<?php echo$owenType?>" />
                                <input type="hidden" id="hdnMode" name="hdnMode" value="add"/>
                                <button type="button" class="btn btn-primary" id="btnSave">
                                    <span class="fa fa-save"></span> บันทึก
                                </button>
                                <button type="button" class="btn btn-danger" id="btnCancel">
                                    <span class="fa fa-ban"></span> ยกเลิก
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function () {
                
                $("#txtOwenId").attr("disabled",true);
                $("#txtOwenPrefix").attr("disabled",true);
                $("#txtOwenName").attr("disabled",true);
                $("#txtOwenAdd").attr("disabled",true);
                $("#txtOwenTel1").attr("disabled",true);
                $("#txtOwenTel2").attr("disabled",true);
                $("#btnSave").attr("disabled",true);
                $("#btnCancel").attr("disabled",true);
                
                $(".select").click(function () {
                    var id = $(this).attr("data-id");
                    console.log($("#owenName-" + id).text());
                    var owen = {"owenId": $("#owenId-" + id).text(),
                        "owenName": $("#owenName-" + id).text(),
                        "owenAdd": $("#owenAdd-" + id).text(),
                        "owenTel1": $("#owenTel1-" + id).text(),
                        "owenTel2": $("#owenTel2-" + id).text(),
                    }
                    parent.setInfo(owen);
                    parent.$.fancybox.close();
                });
                $(".edit").click(function(){
                    var id=$(this).attr("data-id");
                    $("#hdnMode").val("edit");
                    $("#btnNewOwen").attr("disabled",true);
                    $("#txtOwenId").val($("#owenId-"+id).text()).attr("disabled",false);
                    $("#txtOwenPrefix").val($("#owenPrefix-"+id).val()).attr("disabled",false);
                    $("#txtOwenName").val($("#owenName2-"+id).val()).attr("disabled",false);
                    $("#txtOwenAdd").val($("#owenAdd-"+id).text()).attr("disabled",false);
                    $("#txtOwenTel1").val($("#owenTel1-"+id).text()).attr("disabled",false);
                    $("#txtOwenTel2").val($("#owenTel2-"+id).text()).attr("disabled",false);
                    $("#btnSave").attr("disabled",false);
                    $("#btnCancel").attr("disabled",false);
                });

                $('#tbllist').DataTable({
                    "autoWidth": false,
                    "lengthMenu": [[5, 10, 20], [5, 10, 20]],
                    "columnDefs": [
                        { "width": "8%", "targets": 0 },
                        { "width": "8%", "targets": 1 },
                        { "width": "26%", "targets": 2 },
                        { "width": "15%", "targets": 3 },
                        { "width": "13%", "targets": 4 },
                        { "width": "13%", "targets": 5 },
                        { "width": "7%", "targets": 6 },
                        { "width": "5%", "targets": 7 },
                        { "width": "5%", "targets": 8 }
                      ]
                });
                $('.dataTables_filter input[type="search"]').css(
                        {'width': '350px', 'display': 'inline-block'}
                );
        
                $("#btnCancel").click(function(){
                    $("#hdnMode").val("add");
                    $("#btnNewOwen").attr("disabled",false);
                    $("#txtOwenId").val('').attr("disabled",true);
                    $("#txtOwenPrefix").val('').attr("disabled",true);
                    $("#txtOwenName").val('').attr("disabled",true);
                    $("#txtOwenAdd").val('').attr("disabled",true);
                    $("#txtOwenTel1").val('').attr("disabled",true);
                    $("#txtOwenTel2").val('').attr("disabled",true);
                    $("#btnSave").attr("disabled",true);
                    $("#btnCancel").attr("disabled",true);
                    
                });
                $("#btnNewOwen").click(function(){
                    $("#txtOwenId").attr("disabled",false);
                    $("#txtOwenPrefix").attr("disabled",false);
                    $("#txtOwenName").attr("disabled",false);
                    $("#txtOwenAdd").attr("disabled",false);
                    $("#txtOwenTel1").attr("disabled",false);
                    $("#txtOwenTel2").attr("disabled",false);
                    $("#btnSave").attr("disabled",false);
                    $("#btnCancel").attr("disabled",false);
                    
                    //read next owen id
                    $.ajax({
                        url:"readnextowen.php",
                        success: function(data){
                            $("#txtOwenId").val(data);
                        }
                    });
                });
                
                 $("#btnSave").click(function(){
                    var owen = $("#frmNewCard").serializeArray();
                    console.log(owen);
                    $.ajax({
                        url:"saveowen.php",
                        type:"POST",
                        data: owen,
                        success: function (data)
                        {
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
                
                $(".del").click(function(){
                    if(confirm("ยืนยันการลบข้อมูล?"))
                    {
                        var owenId = $("#hdnOwenId").val();
                        //console.log(owenId);
                        $.ajax({
                        url:"deleteowen.php?owenId=" + owenId,
                        success: function (data)
                        {
                            if(parseInt(data)==0)
                            {
                                alert("เกิดข้อผิดพลาดในการลบข้อมูล โปรดลองใหม่อีกครั้ง");
                            }
                            else
                            {
                                alert("ลบข้อมูลเรียบร้อยแล้ว");
                                window.location.reload(true);
                            }
                        }
                    });
                    }
                });
                
            });
        </script>
    </body>
</html>