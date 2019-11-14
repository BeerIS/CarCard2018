<?php
    include("../function.month.php");
    
    if(isset($_POST["ddlMonth"]) && isset($_POST["ddlYear"]))
    {
        $ddlMonth=$_POST["ddlMonth"];
        $ddlYear=$_POST["ddlYear"];
    }
    else 
    {
        $ddlMonth="";
        $ddlYear="";
    }
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
    <div class="col-lg-12 col-lg-offset-0">
        <h2 class="page-header">
            ประวัติการพิมพ์บัตรประจำเดือน 
        </h2>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <form action="index.php?menu=logreportmonth" class="form-inline" method="post">
            <div class="form-group">
                <label for="selectMonth">
                    เลือกเดือนที่ต้องการ: 
                </label>
                    <select name="ddlMonth" id="ddlMonth" class="form-control">
                            <?php 
                                
                            ?>
                            <?php 
                                for($i=0; $i<sizeof($month); $i++) 
                                {
                            ?>
                                <option value="<?PHP echo $i+1?>" <?php if(date("m")==$i+1){echo "selected=selected";}?>>
                                    <?php echo $month[$i]?>
                                </option>
                            <?php 
                                }
                            ?>
                    </select>
            </div>
            <div class="form-group">
            </div>
            <div class="form-group">
                <label for="selectYear">
                    ปี
                </label>
                <select name="ddlYear" id="ddlYear" class="form-control">
                    <?php
                        $year = date("Y");
                        for($i=$year;$i>=$year-5;$i--)
                        {
                    ?>
                            <option value="<?php echo $i ?>"><?php echo $i + 543;?></option>
                    <?php
                        }
                    ?>
                </select>
            </div>
            <button type="submit" name="btnSubmit" class="btn btn-primary">
                ดูข้อมูล
            </button>            
        </form>        
    </div>
</div>
<?php
    if($ddlMonth!="" && $ddlYear!="")
    {
?>
<hr>         
    <div class="row" style="margin-top:20px;">
        <div class="col-lg-8" >
            <h3>รายการพิมพ์บัตรอนุญาตติดรถยนต์ ประจำเดือน <?php echo $month[$ddlMonth-1]. " " . ($ddlYear+543); ?> </h3>
        </div>
        <div class="col-lg-12 text-right">
            <a href="rptMonthlyLog-pdf.php?month=<?php echo $ddlMonth;?>&year=<?php echo $ddlYear?>" class="btn btn-danger">
                <span class="fa fa-file-pdf-o"></span> พิมพ์รายงาน (PDF)
            </a>
        </div>
    </div>
<div class="row" style="margin-top:20px;">
    <div class="col-lg-12" >
        <table class="table table-bordered table-striped table-condensed">
            <thead>
                <tr>
                    <th class="text-center" style="width:15%">วันที่</th>
                    <th class="text-center" style="width:12%">หมายเลขบัตร</th>
                    <th class="text-center" style="width:13%">เลขประจำตัว</th>
                    <th class="text-center" style="width:20%">ชื่อ-นามสกุล</th>
                    <th class="text-center" style="width:20%">ผู้พิมพ์</th>
                    <th class="text-center" style="width:20%">หมายเหตุ</th>
                </tr>
            </thead>
                <tbody id="tblCardLog">
                    <?php
                        $month= date("month");
                        $sqlLog = "SELECT l.printedDate, l.printedBy, e.name, l.remark, c.card_id, e.empn, e2.name AS printedByName FROM card_log l ";
                        //$sqlLog .= "INNER JOIN egat1.vw_egat_emp e ON e.empn=l.printedBy ";
                        $sqlLog .= "INNER JOIN car_card c ON l.card_id=c.card_id ";
                        $sqlLog .= "INNER JOIN egat1.vw_egat_emp e ON e.empn=c.emp_id ";
                        $sqlLog .= "INNER JOIN egat1.vw_egat_emp e2 ON e2.empn=l.printedBy ";
                        $sqlLog .= "WHERE MONTH(l.printedDate) = $ddlMonth AND YEAR(l.printedDate) = $ddlYear ";
                        $qLog = mysqli_query($conn, $sqlLog) or die(mysqli_error($conn));
                        if(mysqli_num_rows($qLog)>0)
                        {
                            while($log = mysqli_fetch_array($qLog))
                        {
                    ?>
                        <tr>
                            <td><?php echo $log['printedDate'] ?></td>
                            <td style="text-align:center;">
                                <a href="carddetail.php?card_id=<?php echo $log['card_id'] ?>" class="detail">
                                    <?php echo $log['card_id'] ?>
                                </a>
                            </td>
                            <td style="text-align:center;"><?php echo $log['empn'] ?></td>
                            <td><?php echo $log['name'] ?></td>
                            <td><?php echo "$log[printedBy]: $log[printedByName]" ?></td>
                            <td><?php echo $log['remark'] ?></td>
                        </tr> 
                    <?php
                            }   
                        }
                    ?>                                        
                </tbody>
        </table>  
        <div class="alert alert-success">
            <strong>รวมจำนวนบัตรที่พิมพ์: <?php echo mysqli_num_rows($qLog);?> ใบ</strong>
        </div>              
    </div>
</div>
<?php        
    }
?>