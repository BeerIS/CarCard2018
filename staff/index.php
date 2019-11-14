<?php
session_start();
include("../config29.php");
if (!isset($_SESSION["username"])) {
    if (isset($_GET['menu']) && $_GET["req_id"]) {
        header("Location: ../index.php?redirect=" . $_GET["menu"] . "&req_id=" . $_GET['req_id']);
    } else {
        header("Location: ../index.php");
    }
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

        <title>ระบบทะเบียนบัตรอนุญาตติดรถยนต์ ฝ่ายรักษาความปลอดภัย</title>

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
        <script src="../js/jquery-2.2.4.js" type="text/javascript"></script>

        <link href="../datatables.css" rel="stylesheet" type="text/css"/>

        <link href="https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet">

        <script src="../datatables.js" type="text/javascript"></script>
        <style type="text/css">
            body{
              font-family: 'Prompt', sans-serif;
            }
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
            body
            {
                padding-bottom: 150px;
            }
            .navbar-top-links > li > a {
                color: white;
            }
            #tblCars tr td{
                vertical-align: middle;
                text-align: center;
            }
            .required
            {
                color: red;
            }
        </style>



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
                    <a href="../request.php" class="navbar-brand" style="color: white;margin-left: 10px;"><i></i>ระบบทะเบียนบัตรอนุญาตติดรถยนต์</a>
                </div>
                <!-- Top Navigation: Right Menu -->
                <ul class="nav navbar-right navbar-top-links">
                    <?php
                    $username = $_SESSION['username'];
                    $sql = "SELECT name FROM egat1.vw_egat_emp where empn='$username'";
                    $obj = mysqli_query($conn, $sql);
                    $name = mysqli_fetch_array($obj);
                    ?>
                    <li style="color: white;"><a href="report.php">รายงานคำขอ </a></li>
                    <li style="color: white;"><i class="fa fa-user-plus fa-fw"></i> <?php echo $username; ?> | <?php echo $name['name']; ?></li>
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
                                <a href="#"><i class="fa fa-print fa-fw"></i> พิมพ์บัตรอนุญาตติดรถยนต์<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="index.php?menu=printdivision"><i class="fa fa-print fa-fw"></i> พิมพ์ทั้งฝ่าย</a>
                                    </li>
                                    <!--<li>
                                        <a href="index.php?menu=printexecutive"><i class="fa fa-print fa-fw"></i> พิมพ์รถประจำตำแหน่ง</a>
                                    </li>-->
                                    <li>
                                        <a href="index.php?menu=printexternal"><i class="fa fa-print fa-fw"></i> พิมพ์บัตรคณะกรรมการ กฟผ./บุคคลภายนอก</a>
                                    </li>
                                    <li>
                                        <a href="index.php?menu=printsingle"><i class="fa fa-print fa-fw"></i> พิมพ์รายบุคคล</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="index.php?menu=newcard">
                                    <i class="fa fa-file-text-o fa-fw"></i> ลงทะเบียนบัตรใหม่
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                  <i class="fa fa-file-text-o fa-fw"></i> รายงานการพิมพ์บัตร <span class="fa arrow"></span>
                                </a>
                                <ul class="nav nav-second-level">
                                  <li>
                                      <a href="index.php?menu=logreport">
                                          <i class="fa fa-file-text-o fa-fw"></i> รายงานการพิมพ์บัตรประจำวัน
                                      </a>
                                  </li>
                                  <li>
                                      <a href="index.php?menu=logreportmonth">
                                          <i class="fa fa-file-text-o fa-fw"></i> รายงานการพิมพ์บัตรประจำเดือน
                                      </a>
                                  </li>
                                </ul>
                            </li>
                            <li>
                                <a href="index.php?menu=list">
                                    <i class="fa fa-pencil-square-o fa-fw"></i> รายการคำขอบัตรอนุญาตติดรถยนต์
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <?php
            if (isset($_GET["menu"])) {
                $menu = $_GET["menu"];
            } else {
                $menu = "";
            }
            switch ($menu) {
                case "list" : $page = "requestlist.php";
                    break;
                case "detail":
                    {
                        $page = "requestdetail.php";
                        break;
                    }
                case "printdivision" :
                    {
                        $page="printdivision.php";
                        break;
                    }
                case "divisiondetail":
                    {
                        $page="divisiondetail.php";
                        break;
                    }
                case "printexternal":
                    {
                        $page = "printexternal.php";
                        break;
                    }
                case "newcard":
                    {
                        $page = "newcard.php";
                        break;
                    }
                case "printsingle":
                {
                    $page="printsingle.php";
                    break;
                }

                case "logreport":
                {
                    $page="logreport.php";
                    break;
                }
                case "logreportmonth":
                {
                    $page="logreportmonth.php";
                    break;
                }
                default : $page="";
            }
            require '../connectSQL.php';
            ?>
            <div id="page-wrapper">
                <div class="container-fluid">
                    <?php
                    if ($menu != "") {
                        //echo $page;
                        include ($page);
                    }
                    ?>
                </div>
            </div>
            <footer>
                <nav class="navbar navbar-inverse navbar-fixed-bottom" role="navigation">
                    <div>
                        <p style="padding-top:5px;color:white;text-align:center"> เจ้าของระบบ : แผนกข้อมูลข่าวสารลับและบัตรรักษาความปลอดภัย (หปภ-ห.) กองบริหารสารสนเทศและการข่าว (กบสข-ห.) โทร.64222, 64225</p>
                        <p style="padding-top:3px;color:white;text-align:center"> พัฒนาระบบโดย แผนกอุปกรณ์และเทคโนโลยีรักษาความปลอดภัย (หอทป-ห.) กองปฏิบัติการรักษาความปลอดภัย (กปป-ห.) ฝ่ายความปลอดภัย (อปภ.) โทร. 64281</p>
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
