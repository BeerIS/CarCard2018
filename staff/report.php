<?php
session_start();
include("../function.php");
$objConnect = mysqli_connect("localhost", "root", "12345678");

if (!$objConnect) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_select_db($objConnect, "car_card_regis_2018") or die("ติดต่อฐานข้อมูลไม่ได้");
if (isset($_POST["btnSubmit"])) {
    //โดนกด submit
    $res = "<tr>
                    <th><center>อันดับ</center></th>
                    <th><center>เลขที่คำขอ</center></th>
                    <th><center>เลขประจำตัว</center></th>
                    <th><center>ชื่อ - สกุล</center></th>
                    <th><center>วันที่ขอ</center></th>
                    <th><center>สถานะคำขอ</center></th>
                    </tr>";
    $sql = "SELECT * FROM requests WHERE MONTH( request_date ) =  '" . $_POST["lmName1"] . "' AND YEAR (request_date) = '$_POST[year]' ORDER BY request_date";
    $objQuery = mysqli_query($objConnect, $sql);
    $i = 0;
    while ($row = mysqli_fetch_array($objQuery))
    {
        $sqli = "SELECT * FROM view_emp WHERE empn = $row[emp_id]";
        $obj = mysqli_query($objConnect, $sqli);
        while ($col = mysqli_fetch_array($obj))
            {      
            $sqlreq = "SELECT * FROM status_log WHERE request_id = $row[request_id]";
            $objreq = mysqli_query($objConnect, $sqlreq);
            while ($reqq = mysqli_fetch_array($objreq))
                {
                $i++;
                $res .= "<tr>";
                $res .= "<td style='text-align:center;'>" . $i . "</td>";
                $res .= "<td style='text-align:center;'>" . $row["request_id"] . "</td>";
                $res .= "<td style='text-align:center;'>" . $row["emp_id"] . "</td>";
                $res .= "<td>" . $col["name"] ."</td>";
                $res .= "<td style='text-align:center;'>" . $row["request_date"] . "</td>";
                $res .= "<td style='text-align:center;'>" . $reqq["comment"] . "</td>";
                $res .= "</td><br>";
        
                }
            }
    }
    $res .= "<table style='width:20%;margin-left: 300px;' border='1' class='table table-responsive table-hover table-striped table-bordered table-condensed;'><tr>"
            . "<td style='text-align:center;'>จำนวนคำขอในเดือนนี้</td>";
    $res .="<td style='text-align:center;';>".$i."</td>"
            . "<td style='text-align:center;'>คำขอ</td>"
            . "</table>";  
} else {
    //ไม่ได้กด submit
    $res = "";
}


function GetUserName($id) {
    //set for thai language
    mysqli_set_charset($objConnect, "utf8");
    //echo "Connection";
    $sql = "select name from view_emp where empn = '" . $id . "' ";
    $objQuery = mysqli_query($objConnect, $sql);
    $i = 0;
    $res = "";
    while ($row = mysqli_fetch_array($objQuery)) {
        $res = $row["name"];
    }
    mysqli_close($objConnect);
    return $res;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title> Car Card </title>

        <!-- Bootstrap Core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../css/metisMenu.min.css" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="../css/timeline.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../css/startmin.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="../css/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <style type="text/css">
            .navbar-inverse{
                background-color: #000;

            }
            .navbar-inverse .navbar-nav > li > a {
                color: white;
            }

            .navbar-inverse .navbar-brand
            {
                color: #1087dd;
            }
            .navbar-top-links > li > a
            {
                color: #08C;
            }
        </style>

        <!-- jQuery -->
        <script src="../js/jquery.min.js"></script>

    </head>
    <body> 
        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="pull-left"> 
                    <div style="margin-top: 5px;">
                        <a href="../request.php"><img src="../images/egat-logo.gif" style="width:40px;margin-left: 30px;" /> </a> 
                    </div>
                </div>
                <div class="navbar-header">
                    <a href="../request.php" class="navbar-brand" style="color: white;margin-left: 10px;"><i></i>ระบบลงทะเบียนเพื่อขอรับบัตรอนุญาตติดรถยนต์ ฝ่ายรักษาความปลอดภัย</a>
                </div>
                <!-- Top Navigation: Right Menu -->
                <ul class="nav navbar-right navbar-top-links">
                    <?
                    include '../config29.php';
                    $username = $_SESSION['username'];
                    $sql = "SELECT name FROM vw_egat_emp where empn='$username'";
                    $obj = mysqli_query($conn,$sql);
                    $name = mysqli_fetch_array($obj);
                    ?>
                <li style="color: white;"><i class="fa fa-user-plus fa-fw"></i> <? echo $username; ?> | <? echo $name['name']; ?></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-lock fa-fw"></i><i class="fa fa-chevron-down fa-fw"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user navbar-top-links" style="color: white;">
                            <li class="divider"></li>
                            <li><a href="../logout.php" style="color: #1295bf"><i class="fa fa-cog fa-fw" style="color: #1295bf"></i> Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <!-- Sidebar -->
                <div class="navbar-default sidebar" role="navigation" id="slidemenu" name="slidemenu">
                    <div class="sidebar-nav navbar-collapse">

                        <ul class="nav" id="side-menu">
                            <li>
                                <a href="index.php?menu=list" style="color: black;font-size: 17px;"><i class="fa fa-pencil-square-o fa-fw"></i> รายการคำขอบัตรอนุญาตจอดรถยนต์</a>
                            </li>
                        </ul>

                    </div>
                </div>
            </nav>
        <form action="report.php" method="post" name="form1">
            <h3><p style="margin-top: 100px;text-align: center;">เลือกเดือนที่ต้องการดูข้อมูล</p></h3>
            <div class="form-group">
                <div class="row">
                    <div style="text-align:center;margin-top:10px;"><label>เดือน: </label>
                        <select name="lmName1">
                            <option value="0">-- กรุณาเลือกเดือน --</option>
                            <?
                                foreach ($thai_month_arr as $m =>$n)
                                {
                                    if($m>0)
                                    {
                                        if($m==$_POST['lmName1'])
                                            $sel = "selected='selected'";
                                            else $sel = "";
                            ?>
                                        <option value="php echo$m?>" <?php echo $sel?>><?php echo $n?></option>
                            <?   
                                    }
                                }
                            ?>
                        </select>                       
                        <label>ปี: </label> 
                         <select name="year"> 
                            <option value="0">กรุณาเลือกปี</option>
                            <?
                                $curryear = date("Y");
                                for($y = $curryear-3;$y<=$curryear;$y++)
                                {
                                    if($y==$_POST['year'])
                                        $sel = "selected='selected'";
                                            else $sel = "";
                            ?>
                                    <option value="<?php echo $y?>" <?php echo $sel?>><?php echo $y+543?></option>
                            <?
                                }
                            ?>
                        </select>
                        <button type="submit" name="btnSubmit" class="btn btn-primary">ดูข้อมูล</button>
                    </div>
                </div>
                <?
                    if(isset($_POST['lmName1']) && isset($_POST['year']))
                    {
                ?>
                        <table style='width:1000px' align='center' border='1'class='table table-bordered'>
                            <?php echo $res; ?>           
                        </table> 
                        <div style="text-align: center;">
                            <a href="reportpdf.php?lmName=<?php echo $_POST["lmName1"]?>&year=<?php echo $_POST['year']?>"class="btn btn-warning" style="margin-top: 30px;">PRINT</a>
                        </div>
                <?
                    }
                ?>
            </div>
        </form>
            <footer>
                <nav class="navbar navbar-inverse navbar-fixed-bottom" role="navigation">
                    <div>
                        <p style="padding-top:5px;color:white;margin-left: 250px;;"> เจ้าของระบบ : แผนกบัตรรักษาความปลอดภัย (หปภ-ห.) กองระบบสารสนเทศรักษาความปลอดภัย (กรป-ห.) โทร.64222,64225</p>
                        <p style="padding-top:3px;color:white;margin-left: 250px;"> พัฒนาระบบโดย กองระบบสารสนเทศรักษาความปลอดภัย (กรป-ห.) ฝ่ายรักษาความปลอดภัย (อรป.) โทร. 64282</p>
                    </div>
                </nav>
            </footer>

            <!-- Bootstrap Core JavaScript -->
            <script src="../js/bootstrap.min.js"></script>

            <!-- Metis Menu Plugin JavaScript -->
            <script src="../js/metisMenu.min.js"></script>

            <!-- Custom Theme JavaScript -->
            <script src="../js/startmin.js"></script>

            <!--<script src="../js/jquery-3.1.0.min.js" type="text/javascript"></script>-->

        </div>
      
    </body>
</html>
<?php
$objConnect->close;
?>