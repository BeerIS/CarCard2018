<?php
include("../config29.php");
include("../mCrypt.class.inc.php");
?>
<!-- Add fancyBox main JS and CSS files -->
<script src="../js/jquery.fancybox.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="../source/jquery.fancybox.css?v=2.1.5" media="screen" />
<script type="text/javascript">
    $(document).ready(function () {
        $('a[class="list"]').fancybox({
            'width': '70%',
            'height': '60%',
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
    <div class="col-lg-12 col-lg-offset-0">
        <h2 class="page-header">ลงทะเบียนบัตรอนุญาตติดรถยนต์ใหม่</h2>
    </div>
    <div class="col-lg-10 col-lg-offset-1">
        <form name="frmNewCard" id="frmNewCard" method="post" class="form-horizontal">
            <div class="row">
                <div class="form-group">
                    <label for="CardType" class="control-label col-lg-2">ประเภทบัตร:</label>
                    <div class="col-lg-4">
                        <select class="form-control" id="ddlCardType" name="ddlCardType">
                            <option value="">--เลือกประเภทบัตร--</option>
                            <?php
                            $sqlCardType = "SELECT * FROM card_type WHERE card_type_id IN (1,2,3,4)ORDER BY card_type_id";
                            $qCardType = mysqli_query($conn, $sqlCardType);
                            while ($cardType = mysqli_fetch_array($qCardType)) {
                                ?>
                                <option value="<?php echo  $cardType[0] ?>"><?php echo  $cardType[1] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <input type="hidden" id="hdnCardType" name="hdnCardType" value=""/>
                    </div>
                    <label for="CardType" class="control-label col-lg-2" style="text-align: right">หมายเลขบัตร: </label>
                    <div class="col-lg-4">
                        <input type="text" class="form-control" id="txtCardNo" name="txtCardNo" readonly/>
                    </div>
                </div>
            </div>
            <div class="row" id="frmEmpCar">
                <div class="form-group">
                    <label for="EmpNo" class="control-label col-lg-2">หมายเลขประจำตัว:<span class="required">*</span></label>
                    <div class="col-lg-4">
                        <input type="text" class="form-control" id="txtEmpNo" name="txtEmpNo" maxlength="6"/>
                    </div>
                    <div class="col-lg-6">
                        <span style="color: #b52b27;font-style: italic">ใส่หมายเลขประจำตัว 6 หลัก แล้วกด Enter หรือดับเบิ้ลคลิกเพื่อเคลียร์ค่า</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="EmpName" class="control-label col-lg-2">ชื่อ - นามสกุล:</label>
                    <div class="col-lg-4">
                        <input type="text" class="form-control" id="txtEmpName" name="txtEmpName" readonly/>
                    </div>
                     <label for="jobName" class="control-label col-lg-2">ตำแหน่ง:</label>
                    <div class="col-lg-4">
                        <input type="text" class="form-control" id="txtjobName" name="txtjobName" readonly/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="section1" class="control-label col-lg-2">แผนก:</label>
                    <div class="col-lg-4">
                        <input type="text" class="form-control" id="txtSection1" name="txtSection1" readonly/>
                    </div>
                    <label for="section2" class="control-label col-lg-2">กอง:</label>
                    <div class="col-lg-4">
                        <input type="text" class="form-control" id="txtSection2" name="txtSection2" readonly/>
                    </div>
                </div>
                 <div class="form-group">
                    <label for="division" class="control-label col-lg-2">ฝ่าย:</label>
                    <div class="col-lg-4">
                        <input type="text" class="form-control" id="txtDivision" name="txtDivision" readonly/>
                    </div>
                    <label for="unit" class="control-label col-lg-2">สายงาน:</label>
                    <div class="col-lg-4">
                        <input type="text" class="form-control" id="txtUnit" name="txtUnit" readonly/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="division" class="control-label col-lg-2">โทรศัพท์:<span class="required">*</span></label>
                    <div class="col-lg-4">
                        <input type="text" class="form-control" id="txtTel1" name="txtTel1"/>
                    </div>
                    <label for="unit" class="control-label col-lg-2">มือถือ:</label>
                    <div class="col-lg-4">
                        <input type="text" class="form-control" id="txtTel2" name="txtTel2"/>
                    </div>
                </div>
            </div>
            <div class="row" id="frmExternalCar">
                <div class="form-group">
                    <label for="EmpNo" class="control-label col-lg-2">หมายเลขประจำตัว:<span class="required">*</span></label>
                    <div class="col-lg-4">
                        <input type="text" class="form-control" id="txtOwenId" name="txtOwenId" maxlength="6" readonly/>
                    </div>
                    <div class="col-lg-6 control-label" style='text-align: left'>
                        <a id="newlist" class="list" href="">
                            <span class="fa fa-search"></span> คลิกที่นี่เพื่อค้นหารายชื่อ
                        </a>
                    </div>
                </div>
                <div class="form-group">
                    <label for="EmpName" class="control-label col-lg-2">ชื่อ - นามสกุล:</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="txtOwenName" name="txtOwenName" readonly/>
                        <input type="hidden" name="hdnId" id="hdnId" value=""/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="jobName" class="control-label col-lg-2">รายละเอียด:</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="txtOwenAdd" name="txtOwenAdd" readonly/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="division" class="control-label col-lg-2">โทรศัพท์:<span class="required">*</span></label>
                    <div class="col-lg-4">
                        <input type="text" class="form-control" id="txtOwenTel1" name="txtOwenTel1" readonly/>
                    </div>
                    <label for="unit" class="control-label col-lg-2">มือถือ:</label>
                    <div class="col-lg-4">
                        <input type="text" class="form-control" id="txtOwenTel2" name="txtOwenTel2" readonly/>
                    </div>
                </div>
            </div>
            <div class="row" id="frmCars">
                <div class="col-lg-12">
                    <h4><strong><span class="fa fa-edit"></span> ข้อมูลรถยนต์</strong></h4>
                    <div class="form-group">
                        <label class="col-lg-1 control-label" for="license">ทะเบียน</label>
                        <div class="col-lg-3">
                            <input type="text" class="form-control frmcar" name="txtCarRegis" id="txtCarRegis"/>
                        </div>
                        <label class="col-lg-1 control-label">จังหวัด</label>
                        <div class="col-lg-3">
                            <select class="form-control frmcar" id="ddlProvince" name="ddlProvince">
                                <option value="">--จังหวัด--</option>
                                <?php
                                    $sqlProvince = "SELECT * FROM province ORDER BY pro_name";
                                    $qProvince=  mysqli_query($conn, $sqlProvince);
                                    while($province=mysqli_fetch_array($qProvince))
                                    {
                                ?>
                                        <option value="<?php echo $province['pro_id']?>"><?php echo $province['pro_name']?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <label class="col-lg-1 control-label">ยี่ห้อ</label>
                        <div class="col-lg-3">
                            <select class="form-control frmcar" id="ddlBrand" name="ddlBrand">
                                <option value="">--เลือกยี่ห้อ--</option>
                                <?php
                                    $sqlBrand = "SELECT * FROM brand ORDER BY brand_name";
                                    $qBrand=  mysqli_query($conn, $sqlBrand);
                                    while($Brand=mysqli_fetch_array($qBrand))
                                    {
                                ?>
                                        <option value="<?php echo $Brand['brand_id']?>"><?php echo $Brand['brand_name']?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-1 control-label">สี</label>
                        <div class="col-lg-3">
                            <input type="text" class="form-control frmcar" id="txtColor" name="txtColor"/>
                        </div>
                        <label class="col-lg-1 control-label">ประเภท</label>
                        <div class="col-lg-3">
                            <select class="form-control frmcar" id="ddlType" name="ddlType">
                                <option value="">--ประเภท--</option>
                                <?php
                                    $sqlType = "SELECT * FROM ctype ORDER BY ctype_id";
                                    $qType=  mysqli_query($conn, $sqlType);
                                    while($type=mysqli_fetch_array($qType))
                                    {
                                ?>
                                        <option value="<?php echo $type['ctype_id']?>"><?php echo $type['ctype_name']?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-4" style="text-align: center">
                            <button class="btn btn-success" type="button" id="btnAdd">
                                <span class="fa fa-plus-circle"> เพิ่มรถยนต์</span>
                            </button>
                            <button class="btn btn-primary" type="button" id="btnSave">
                                <span class="fa fa-save"> บันทึก</span>
                            </button>
                             <button class="btn btn-danger" type="button" id="btnCancel">
                                <span class="fa fa-ban"> ยกเลิก</span>
                            </button>
                            <input type="hidden" id="hdnCarId" name="hdnCarId" value=""/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-hover table-bordered" id="tblCars">
                                <tr>
                                    <th style="width:5%;text-align: center">คันที่</th>
                                    <th style="width:15%;text-align: center">หมายเลขทะเบียน</th>
                                    <th style="width:15%;text-align: center">จังหวัด</th>
                                    <th style="width:15%;text-align: center">ยี่ห้อ</th>
                                    <th style="width:15%;text-align: center">สี</th>
                                    <th style="width:15%;text-align: center">ประเภท</th>
                                    <th style="width:10%;text-align: center">แก้ไข</th>
                                    <th style="width:10%;text-align: center">ลบ</th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="form-group" style="margin-top: 15px;">
                    <label class="col-lg-12">หมายเหตุ:</label>
                    <div class="col-lg-12">
                        <textarea id="txtRemark" name="txtRemark" class="form-control" rows="5" style="resize: none;"></textarea>
                    </div>
                </div>
                <div class="form-group" style="margin-top: 15px;">
                    <div class="col-lg-12" style="text-align: center">
                        <button type="button" id="btnSaveCard" class="btn btn-primary"><span class="fa fa-save"></span> บันทึกข้อมูลบัตร</button>
                        <a href="index.php" class="btn btn-danger" ><span class="fa fa-backward"></span> ยกเลิก</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    function setInfo(data)
    {
        console.log(data);
        $("#txtOwenId").val(data.owenId);
        $("#txtOwenName").val(data.owenName);
        $("#txtOwenAdd").val(data.owenAdd);
        $("#txtOwenTel1").val(data.owenTel1);
        $("#txtOwenTel2").val(data.owenTel2);
    }

    function Car (id,carRegis, provinceId, brandId, color, typeId)
    {
        this.id = id;
        this.carRegis = carRegis;
        this.provinceId = provinceId;
        this.brandId=brandId;
        this.color=color;
        this.typeId=typeId;
    }
    var allCars = new Array();

    function deleteCar(id)
    {
        if(confirm("ยืนยันการลบข้อมูลรถยนต์"))
        {
            for(var i=0; i<allCars.length; i++)
            {
                var obj = allCars[i];
                if(obj.id==id)
                {
                    allCars.splice(i,1);
                    //remove from table
                    $("#row-" + id).remove();
                }
            }
            console.log(allCars);
        }
    }
    function editCar(id)
    {
        for(var i=0; i<allCars.length; i++)
        {
            var obj = allCars[i];
            if(obj.id==id)
            {
                $("#btnSave").show();
                $("#btnCancel").show();
                $("#btnAdd").hide();

                $("#hdnCarId").val(id);
                $("#txtCarRegis").val(obj.carRegis);
                $("#ddlProvince").val(obj.provinceId);
                $("#ddlBrand").val(obj.brandId);
                $("#txtColor").val(obj.color);
                $("#ddlType").val(obj.typeId);
            }
        }
        console.log(allCars);
    }

    $(document).ready(function () {

        $("#btnSave").hide();
        $("#btnCancel").hide();

        $("#frmEmpCar").hide();
        $("#frmExecutiveCar").hide();
        $("#frmCommitteeCar").hide();
        $("#frmExternalCar").hide();
        $("#frmCars").hide();
        $("#ddlCardType").change(function () {
            var cardType = $(this).val();
            $("#hdnCardType").val(cardType);

            if(cardType=="1"||cardType=="2")
            {
                $("#frmEmpCar").show(100);
                $("#frmExternalCar").hide(100);
                $("#frmCars").show(100);
            }
            else if(cardType=="3"||cardType=="4")
            {
                $("#frmEmpCar").hide(100);
                $("#frmExternalCar").show(100);
                $("#frmCars").show(100);

                $('#txtOwenId').val('');
                $('#txtOwenName').val('');
                $('#txtOwenAdd').val('');
                $('#txtOwenTel1').val('');
                $('#txtOwenTel2').val('');
            }
            $("#newlist").attr("href","owenlist.php?owenType="+cardType);
        });
        $("#txtEmpNo").keypress(function(e){
            if(e.which==13)//press enter
            {
               //find employee
               var empId = $(this).val();
               var cardType = $("#hdnCardType").val();
               var cardTypeName;
               switch (cardType) {
                 case "1":
                      cardTypeName="ผู้ปฏิบัติงาน";
                      break;
                 case "2" :
                       cardTypeName="รถประจำตำแหน่ง";
                       break;
                 default: cardTypeName="";
               }
               $.ajax({
                   url: "findcard.php?card_type=" + cardType + "&empId="+empId,
                   type: "GET",
                   success: function (data){
                       var numcard = parseInt(data);
                       //console.log(data);
                       if(numcard>0)
                       {
                           if(confirm("ผู้ปฏิบัติงานหมายเลขประจำตัว " + empId + " มีการลงทะเบียนบัตรอนุญาตประเภท " + cardTypeName + " ไว้แล้ว คุณต้องการดูรายละเอียดหรือไม่"))
                           {
                               window.open("index.php?menu=printsingle&txtSearch=" + empId + "&searchBy=2");
                           }
                       }
                       else
                       {
                            //find emp data
                            $.ajax({
                                url: "findemp.php?empId=" + empId,
                                type: "GET",
                                success : function (data){
                                    //set to textboxes
                                    try
                                    {

                                         var emp = JSON.parse(data);
                                         $("#txtEmpName").val(emp["empName"]);
                                         $("#txtjobName").val(emp["job_nm2"]);
                                         $("#txtSection1").val(emp["section1"].trim()==""?"-":emp["section1"]);
                                         $("#txtSection2").val(emp["section2"].trim()==""?"-":emp["section2"]);
                                         $("#txtDivision").val(emp["fay"].trim()==""?"-":emp["fay"]);
                                         $("#txtUnit").val(emp["long"].trim()==""?"-":emp["long"]);
                                         $("#txtTel1").val(emp["tel_1"]);
                                         $("#txtTel2").val(emp["tel_2"]);
                                    }
                                    catch(e)
                                    {
                                         alert("ไม่พบชื่อผู้ปฏิบัติงานตามหมายเลขประจำตัวที่ระบุ");
                                         $("#txtEmpName").val('');
                                         $("#txtjobName").val('');
                                         $("#txtSection1").val('');
                                         $("#txtSection2").val('');
                                         $("#txtDivision").val('');
                                         $("#txtUnit").val('');
                                         $("#txtTel1").val('');
                                         $("#txtTel2").val('');
                                    }
                                }
                            });
                       }
                   }
               });
               e.preventDefault();
            }
        });
        $("#txtEmpNo").dblclick(function(){
            $(this).val('');
        });
        $("#btnAdd").click(function (){
            var i = $("#tblCars tr").length;

            var CarRegis = $("#txtCarRegis").val();
            var ProvinceId = $("#ddlProvince").val();
            var ProvinceName = $("#ddlProvince :selected").text();
            var BrandId = $("#ddlBrand").val();
            var BrandName = $("#ddlBrand :selected").text();
            var Color = $("#txtColor").val();
            var typeId = $("#ddlType").val();
            var typeName= $("#ddlType :selected").text();

            if(CarRegis==""||ProvinceId==""||BrandId==""||Color==""||typeId=="")
            {
                alert("กรุณาตรวจสอบข้อมูลรถยนต์ให้ครบถ้วนก่อนคลิกที่ปุ่มเพิ่มรถยนต์");
                if(CarRegis=="")
                    $("#txtCarRegis").focus();
                else if (ProvinceId=="")
                    $("#ddlProvince").focus();
                else if(BrandId=="")
                    $("#ddlBrand").focus();
                else if(Color=="")
                    $("#txtColor").focus();
                else
                    $("#ddlType").focus();
            }
            else
            {
                if(i>=3)
                {
                    alert("ท่านสามารถเพิ่มข้อมูลรถยนต์ได้ไม่เกิน 2 คัน");
                }
                else
                {
                    var car = new Car();
                    var tr="";
                    car.id=parseInt(Math.random()*100);
                    car.carRegis = CarRegis;
                    car.provinceId = ProvinceId;
                    car.brandId = BrandId;
                    car.color = Color;
                    car.typeId = typeId;

                    tr = "<tr id='row-" + car.id + "'>";
                        tr += "<td id='col-" +car.id + "-1'" +  ">" + i + "</td>";
                        tr += "<td id='col-" +car.id + "-2'" +  ">" + car.carRegis + "</td>";
                        tr += "<td id='col-" +car.id + "-3'" +  ">" + ProvinceName + "</td>";
                        tr += "<td id='col-" +car.id + "-4'" +  ">" + BrandName + "</td>";
                        tr += "<td id='col-" +car.id + "-5'" +  ">" + car.color + "</td>";
                        tr += "<td id='col-" +car.id + "-6'" +  ">" + typeName + "</td>";
                        tr += "<td id='col-" +car.id + "-7'" +  "><a class='btn btn-primary' onclick='return editCar("+ car.id + ")'><span class='fa fa-edit'></span> แก้ไข</a></td>";
                        tr += "<td id='col-" +car.id + "-8'" +  "><a class='btn btn-danger' onclick='return deleteCar( " + car.id +  ")'><span class='fa fa-trash'></span> ลบ</a></td>";
                    tr += "</tr>";
                    $("#tblCars tr:last").after(tr);
                    $("#txtCarRegis").val('');
                    $("#ddlProvince").val('');
                    $("#ddlBrand").val('');
                    $("#txtColor").val('');
                    $("#ddlType").val('');
                    allCars.push(car);
                    console.log(allCars);
                }
            }
        });
        $("#btnCancel").click(function(){
            $("#hdnCarId").val('');
            $("#txtCarRegis").val('');
            $("#ddlProvince").val('');
            $("#ddlBrand").val('');
            $("#txtColor").val('');
            $("#ddlType").val('');

            $("#btnSave").hide();
            $("#btnCancel").hide();
            $("#btnAdd").show();
        });
        $("#btnSave").click(function(){
            var CarRegis = $("#txtCarRegis").val();
            var ProvinceId = $("#ddlProvince").val();
            var ProvinceName = $("#ddlProvince :selected").text();
            var BrandId = $("#ddlBrand").val();
            var BrandName = $("#ddlBrand :selected").text();
            var Color = $("#txtColor").val();
            var typeId = $("#ddlType").val();
            var typeName= $("#ddlType :selected").text();
            if(CarRegis==""||ProvinceId==""||BrandId==""||Color==""||typeId=="")
            {
                alert("กรุณาตรวจสอบข้อมูลรถยนต์ให้ครบถ้วนก่อนคลิกที่ปุ่มเพิ่มรถยนต์");
                if(CarRegis=="")
                    $("#txtCarRegis").focus();
                else if (ProvinceId=="")
                    $("#ddlProvince").focus();
                else if(BrandId=="")
                    $("#ddlBrand").focus();
                else if(Color=="")
                    $("#txtColor").focus();
                else
                    $("#ddlType").focus();
            }
            else
            {
                if(confirm("ยืนยันการแก้ไขข้อมูล?"))
                {
                   id=$("#hdnCarId").val();
                   for(var i=0; i<allCars.length; i++)
                    {
                        if(allCars[i].id==id)
                        {
                            allCars[i].carRegis=$("#txtCarRegis").val();
                            allCars[i].provinceId=$("#ddlProvince").val();
                            allCars[i].brandId=$("#ddlBrand").val();
                            allCars[i].color=$("#txtColor").val();
                            allCars[i].typeId=$("#ddlType").val();

                            $("#col-" + id + "-2").text($("#txtCarRegis").val());
                            $("#col-" + id + "-3").text($("#ddlProvince :selected").text());
                            $("#col-" + id + "-4").text($("#ddlBrand :selected").text());
                            $("#col-" + id + "-5").text($("#txtColor").val());
                            $("#col-" + id + "-6").text($("#ddlType :selected").val());
                        }
                    }
                    console.log(allCars);
                    $("#hdnCarId").val('');
                    $("#txtCarRegis").val('');
                    $("#ddlProvince").val('');
                    $("#ddlBrand").val('');
                    $("#txtColor").val('');
                    $("#ddlType").val('');

                    $("#btnSave").hide();
                    $("#btnCancel").hide();
                    $("#btnAdd").show();
                }
            }
        });
        $("#btnSaveCard").click(function(){
            var cardType = $("#ddlCardType").val();
            if(cardType==1||cardType==2)
            {
                var empId= $("#txtEmpNo").val();
                var tel1= $("#txtTel1").val();
                console.log(empId);
                    if(empId==""||tel1=="")
                    {
                        alert("กรุณากรอกข้อมูลที่มีเครื่องหมาย * กำกับให้ครบถ้วน");
                        if(empId=="")
                            $("#txtEmpNo").focus();
                        else $("#txtTel1").focus();
                        return false;
                    }
                    if(allCars.length==0)
                    {
                        alert("กรุณากรอกข้อมูลรถยนต์อย่างน้อย 1 คัน");
                        return false;
                    }

                    var card = {"empId" : empId, "card_type" : $("#ddlCardType").val(), "cars" : allCars, "remark" : $("#txtRemark").val(), "tel1":$("#txtTel1").val(),"tel2":$("#txtTel2").val()};
                    console.log(card);
                    $.ajax({
                        url: "insertcard.php",
                        type: "POST",
                        data: card,
                        success: function (data){
                            if(parseInt(data)==0)
                            {
                                alert("เกิดข้อผิดพลาดในการลงทะเบียนบัตร โปรดลองใหม่อีกครั้ง");
                            }
                            else
                            {
                                if(confirm("บันทึกข้อมูลบัตรเรียบร้อยแล้ว หมายเลขบัตรคือ " + data + "ต้องการพิมพ์บัตรนี้เลยหรือไม่?"))
                                {
                                    window.open("carddetail.php?card_id=" + data,"Card Detail","width=1400,height=700");

                                }
                                  window.location = "index.php?menu=newcard";

                            }
                        }
                    });
            }
            else if(cardType==3||cardType==4)
            {
                var owenId = $("#txtOwenId").val();
                if(owenId=="")
                {
                    alert("กรุณากรอกข้อมูลที่มีเครื่องหมาย * กำกับให้ครบถ้วน")
                    $("#txtOwenId").focus();
                }
                if(allCars.length==0)
                {
                    alert("กรุณากรอกข้อมูลรถยนต์อย่างน้อย 1 คัน");
                    return false;
                }
                var card = {"empId" : owenId, "card_type" : $("#ddlCardType").val(), "cars" : allCars, "remark" : $("#txtRemark").val()};
                console.log(card);
                $.ajax({
                        url: "insertcard.php",
                        type: "POST",
                        data: card,
                        success: function (data){if(parseInt(data)==0)
                            {
                                alert("เกิดข้อผิดพลาดในการลงทะเบียนบัตร โปรดลองใหม่อีกครั้ง");
                            }
                            else
                            {
                                if(confirm("บันทึกข้อมูลบัตรเรียบร้อยแล้ว หมายเลขบัตรคือ " + data + "ต้องการพิมพ์บัตรนี้เลยหรือไม่?"))
                                {
                                    window.open("carddetail_external.php?card_id=" + data,"Card Detail","width=1400,height=700");
                                    window.location = "index.php?menu=newcard";
                                }
                            }
                        }
                    });
            }
        });
    });
</script>
