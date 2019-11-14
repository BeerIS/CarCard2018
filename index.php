<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>ระบบทะเบียนบัตรอนุญาตติดรถยนต์</title>

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

        <link href="https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet">

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
                        <a href="index.php"> <img src="images/egat-logo.gif" style="width:40px;margin-left: 30px;" /> </a>
                    </div>
                </div>
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php" style="color: white;margin-left: 10px;">ระบบทะเบียนบัตรอนุญาตติดรถยนต์</a>

                </div>
            </nav>


            <div class="container" style="margin-top: 80px;">
                <!--Contents Here-->
                <center>
                    <h3> <span class="fa fa-lock"></span> เข้าสู่ระบบ </h3>
                </center>
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2" style="border:1px solid #000;">
                        <div class="row" style="padding:15px;">
                            <form class="form-horizontal" role="form" action="authen.php" method="post">
                                <center>
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="username">เข้าสู่ระบบสำหรับ</label>
                                        <div class="col-sm-6">
                                            <select name="logintype" id="logintype" class="form-control">
                                                <option value="0">ผู้ใช้บริการ</option>
                                                <option value="1" selected="selected">เจ้าหน้าที่ หบภ-ห.</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="username">เลขประจำตัว</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="email" name="username">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="pwd">รหัสผ่าน</label>

                                        <div class="col-sm-6">
                                            <input type="password" class="form-control" id="pwd" name="pwd" >
                                        </div>
                                        <input type="hidden" value="<?php echo $_GET["redirect"];?>" name="hidRedirect">
                                        <input type="hidden" value="<?php echo $_GET["req_id"];?>" name="hidReq">
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-group-xs" style="background-color: #000;color: #CCC;font-family: monospace">Login</button>
                                        </div>
                                    </div>
                                </center>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <center>
                                            <label><font color="gray">เข้าระบบโดยใช้รหัสผ่านเดียวกัน กับ EGAT Email ที่ท่านใช้อยู่</font></label>
                                            <label style="margin-top: 15px;"><font color="red"><u>หมายเหตุ</u> ผู้ปฏิบัติงานที่ต้องการขอรับบัตรอนุญาตติดรถยนต์เป็นครั้งแรก หรือ ผู้ที่ต้องการเพิ่มข้อมูลรถยนต์คันใหม่</font></label>
                                            <label><font color="red"><u>รวมแล้วไม่เกิน 2 คัน</u></font></label>
                                        </center>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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
        <script src="js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="js/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="js/startmin.js"></script>

    </body>
</html>
