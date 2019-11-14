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
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="css/metisMenu.min.css" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="css/timeline.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/startmin.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="css/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <script src="js/jquery-2.1.4.js" type="text/javascript"></script>

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
            body
            {
                padding-bottom: 80px;
            }
        </style>

        <!-- jQuery -->
        <script src="js/jquery.min.js"></script>

    </head>
    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="pull-left"> 
                    <div style="margin-top: 5px;">
                        <a href="request.php"><img src="images/egat-logo.gif" style="width:40px;margin-left: 30px;" /> </a> 
                    </div>
                </div>
                <div class="navbar-header">
                    <a href="request.php" class="navbar-brand" style="color: white;margin-left: 10px;"><i></i>ระบบทะเบียนบัตรอนุญาตติดรถยนต์ ฝ่ายรักษาความปลอดภัย</a>
                </div>
                <!-- Top Navigation: Right Menu -->
                <ul class="nav navbar-right navbar-top-links">

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-lock fa-fw"></i><i class="fa fa-chevron-down fa-fw"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user" style="color: white;">
                            <li class="divider"></li>
                            <li><a href="logout.php"><i class="fa fa-cog fa-fw"></i> Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <!-- Sidebar -->
                <div class="navbar-default sidebar" role="navigation" id="slidemenu" name="slidemenu">
                    <div class="sidebar-nav navbar-collapse">

                        <ul class="nav" id="side-menu">
                            <li>
                                <a href="#" style="color: black;font-size: 17px;"><i class="fa fa-pencil-square-o fa-fw"></i> รายการคำขอบัตรอนุญาตจอดรถยนต์</a>
                            </li>
                        </ul>

                    </div>
                </div>
            </nav>

            <footer>
                <nav class="navbar navbar-inverse navbar-fixed-bottom" role="navigation">
                    <div>
                        <p style="padding-top:5px;color:white;margin-left: 250px;;"> เจ้าของระบบ : แผนกบัตรรักษาความปลอดภัย (หปภ-ห.) กองระบบสารสนเทศรักษาความปลอดภัย (กรป-ห.) โทร.(64222,64225)</p>
                        <p style="padding-top:3px;color:white;margin-left: 250px;"> พัฒนาระบบโดย กองระบบสารสนเทศรักษาความปลอดภัย (กรป-ห.) ฝ่ายรักษาความปลอดภัย (อรป.) โทร. 64282</p>
                    </div>
                </nav>
            </footer>

            <!-- Bootstrap Core JavaScript -->
            <script src="js/bootstrap.min.js"></script>

            <!-- Metis Menu Plugin JavaScript -->
            <script src="js/metisMenu.min.js"></script>

            <!-- Custom Theme JavaScript -->
            <script src="js/startmin.js"></script>

            <script src="js/jquery-3.1.0.min.js" type="text/javascript"></script>

        </div>
    </body>
</html>
