<?php
ini_set('max_execution_time', 300);
include("../config29.php");
include("../mCrypt.class.inc.php");

$emp_active="in active";
$emp_tab_active="class='active'";
$external_active ="";
$external_tab_active = "";

if(isset($_GET['ct']))
{
    $ct = $_GET['ct'];
    if($ct=="external")
    {
        $emp_active="";
        $emp_tab_active="";
        $external_active ="in active";
        $external_tab_active = "class='active'";
    }
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
        <h2 class="page-header">พิมพ์บัตรอนุญาตรายบุคคล</h2>
        <ul class="nav nav-tabs">
            <li <?php echo $emp_tab_active?>><a data-toggle="tab" href="#employee">บัตรผู้ปฏิบัติงาน/รถประจำตำแหน่ง</a></li>
            <li <?php echo $external_tab_active?>><a data-toggle="tab" href="#external">บัตรรถคณะกรรมการฯ/บุคคลภายนอก</a></li>
        </ul>
        <div class="tab-content">
            <div id="employee" class="tab-pane fade <?php echo $emp_active?>">
                <div class="row">
                    <div class="col-lg-8" style="margin-top: 15px;">
                        <form class="form-horizontal" method="post" action="index.php?menu=printsingle&ct=employee">
                            <div class="form-group">
                                <label class="col-lg-2" for="txtSearch">ค้นหาข้อมูลบัตร:</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" id="txtSearch" name="txtSearch">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2" for="searchBy">เลือกค้นหาจาก:</label>
                                <div class="col-lg-3">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="searchBy" id="searchByCardId" value="1" checked>
                                        หมายเลขบัตรอนุญาต
                                    </label> 
                                </div>
                                <div class="col-lg-7">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="searchBy" id="searchByCardId" value="2">
                                        เลขประจำตัว
                                    </label>
                                </div>
                                <div class="col-lg-3 col-lg-offset-2">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="searchBy" id="searchByCarRegis" value="3">
                                        หมายเลขทะเบียนรถยนต์
                                    </label> 
                                </div>
                                <div class="col-lg-7">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="searchBy" id="searchByName" value="4">
                                        ชื่อ - นามสกุล
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <button class="btn btn-primary"><span class="fa fa-search"></span> ค้นหา</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php
                    $sqlConcat ="";

                    if (isset($_REQUEST['txtSearch']) && isset($_REQUEST['searchBy']) && $_GET['ct']=="employee") 
                    {
                        $txtSearch = $_REQUEST['txtSearch'];
                        $searchBy = $_REQUEST['searchBy'];
                        switch ($searchBy)
                        {
                            case "1":
                            {
                                $sqlConcat = " AND c.card_id=$txtSearch";
                                break;
                            }
                            case "2":
                            {
                                $sqlConcat = " AND c.emp_id='$txtSearch'";
                                break;
                            }
                            case "3":
                            {
                                $sqlConcat = " AND cc.car_regis_number LIKE '%$txtSearch%'";
                                break;
                            }
                            case "4":
                            {
                                $sqlConcat = " AND e.name LIKE '%$txtSearch%'";
                                break;
                            }
                            default:
                            {
                                $sqlConcat = "";
                            }
                        }
                    $sqlAllCards = "SELECT c.card_id, c.emp_id, concat(e.title, e.name) AS empName,e.job_nm2, CONCAT(e.section1,' ',e.section2) AS emp_section, e.fay, cc.car_regis_number, p.pro_name, "
                            . " ct.card_type_name "
                            . " FROM egat1.vw_egat_emp e INNER JOIN car_card c ON c.emp_id = e.empn "
                            . " LEFT JOIN car cc ON c.card_id = cc.card_id "
                            . " LEFT JOIN province p ON cc.pro_id = p.pro_id "
                            . " LEFT JOIN card_type ct ON ct.card_type_id = c.card_type_id"
                            . " WHERE c.card_type_id IN (1,2) $sqlConcat";

                    $qAllCards = mysqli_query($conn, $sqlAllCards);
                ?>
                <hr>
                <div class="row" style="margin-top: 5px;">
                    <div class="col-lg-12" style="text-align: center;">
                        <h4><span class="fa fa-search"></span> ผลการค้นหา : "<?php echo $txtSearch?>"</h4>
                    </div>
                </div>
                <div class="row">
                    <table class='table table-bordered table-striped table-hover table-responsive' style='width:100%' id="tblEmpCars">
                        <thead>
                            <tr>
                                <th style='width:5%;text-align:center;'>หมายเลขบัตร</th>
                                <th style='width:8%;text-align:center'>เลขประจำตัว</th>
                                <th style='text-align:center'>ชื่อ - นามสกุล</th>
                                <th style='width:10%;text-align:center'>ตำแหน่ง</th>
                                <th style='width:13%;text-align:center'>สังกัด</th>
                                <th style='width:8%;text-align:center'>ฝ่าย</th>
                                <th style='width:13%;text-align:center'>ทะเบียนรถ</th>
                                <th style='width:13%;text-align:center'>จังหวัด</th>
                                <th style='width:10%;text-align:center'>ประเภทบัตร</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($card = mysqli_fetch_array($qAllCards)) {
                                ?>
                                <tr>
                                    <td style="text-align: center">
                                        <a href="carddetail.php?card_id=<?php echo $card['card_id'] ?>" class="detail">
                                            <?php echo $card['card_id'] ?>
                                        </a>
                                    </td>
                                    <td style="text-align: center"><?php echo $card['emp_id'] ?></td>
                                    <td><?php echo $card['empName'] ?></td>
                                    <td><?php echo $card['job_nm2'] ?></td>
                                    <td><?php echo $card['emp_section']?></td>
                                    <td style="text-align: center"><?php echo $card['fay'] ?></td>
                                    <td style="text-align: center"><?php echo $card['car_regis_number'] ?></td>
                                    <td><?php echo $card['pro_name'] ?></td>
                                    <td><?php echo $card['card_type_name'] ?></td>
                                </tr>
                           <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <?php
                }
                ?>
            </div>
            <div id="external" class="tab-pane fade <?php echo $external_active?>">
                <div class="row">
                    <div class="col-lg-8" style="margin-top: 15px;">
                        <form class="form-horizontal" method="post" action="index.php?menu=printsingle&ct=external">
                            <div class="form-group">
                                <label class="col-lg-2" for="txtSearch">ค้นหาข้อมูลบัตร:</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" id="txtSearch" name="txtSearch">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2" for="searchBy">เลือกค้นหาจาก:</label>
                                <div class="col-lg-10">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="searchBy" id="searchByCardId" value="1" checked>
                                        หมายเลขบัตรอนุญาต
                                    </label> 
                                </div>
                                <div class="col-lg-3 col-lg-offset-2">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="searchBy" id="searchByCarRegis" value="3">
                                        หมายเลขทะเบียนรถยนต์
                                    </label> 
                                </div>
                                <div class="col-lg-7">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="searchBy" id="searchByName" value="4">
                                        ชื่อ - นามสกุล
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <button class="btn btn-primary"><span class="fa fa-search"></span> ค้นหา</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php
                    $sqlConcat ="";

                    if (isset($_REQUEST['txtSearch']) && isset($_REQUEST['searchBy']) && $_GET['ct']=="external") 
                    {
                        $txtSearch = $_REQUEST['txtSearch'];
                        $searchBy = $_REQUEST['searchBy'];
                        switch ($searchBy)
                        {
                            case "1":
                            {
                                $sqlConcat = " AND c.card_id=$txtSearch";
                                break;
                            }
                            case "3":
                            {
                                $sqlConcat = " AND cc.car_regis_number LIKE '%$txtSearch%'";
                                break;
                            }
                            case "4":
                            {
                                $sqlConcat = " AND o.owen_name LIKE '%$txtSearch%'";
                                break;
                            }
                            default:
                            {
                                $sqlConcat = "";
                            }
                        }
                    $sqlAllCards = "SELECT c.card_id, o.owen_id, concat(o.owen_prefix, o.owen_name) AS owenName,o.owen_add, cc.car_regis_number, p.pro_name, "
                            . " ct.card_type_name "
                            . " FROM nonemp_owen o INNER JOIN car_card c ON c.emp_id = o.owen_id "
                            . " LEFT JOIN car cc ON c.card_id = cc.card_id "
                            . " LEFT JOIN province p ON cc.pro_id = p.pro_id "
                            . " LEFT JOIN card_type ct ON ct.card_type_id = c.card_type_id"
                            . " WHERE c.card_type_id IN (3,4) $sqlConcat";

                    $qAllCards = mysqli_query($conn, $sqlAllCards);
                ?>
                <hr>
                <div class="row" style="margin-top: 5px;">
                    <div class="col-lg-12" style="text-align: center;">
                        <h4><span class="fa fa-search"></span> ผลการค้นหา : "<?php echo $txtSearch?>"</h4>
                    </div>
                </div>
                <div class="row">
                    <table class='table table-bordered table-striped table-hover table-responsive' style='width:100%' id="tblEmpCars">
                        <thead>
                            <tr>
                                <th style='width:5%;text-align:center;'>หมายเลขบัตร</th>
                                <th style='width:8%;text-align:center'>เลขประจำตัว</th>
                                <th style='text-align:center'>ชื่อ - นามสกุล</th>
                                <th style='width:13%;text-align:center'>สังกัด</th>
                                <th style='width:13%;text-align:center'>ทะเบียนรถ</th>
                                <th style='width:13%;text-align:center'>จังหวัด</th>
                                <th style='width:13%;text-align:center'>ประเภทบัตร</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($card = mysqli_fetch_array($qAllCards)) {
                                ?>
                                <tr>
                                    <td style="text-align: center">
                                        <a href="carddetail_external.php?card_id=<?php echo $card['card_id'] ?>" class="detail">
                                            <?php echo $card['card_id'] ?>
                                        </a>
                                    </td>
                                    <td style="text-align: center"><?php echo $card['owen_id'] ?></td>
                                    <td><?php echo $card['owenName'] ?></td>
                                    <td><?php echo $card['owen_add'] ?></td>
                                    <td style="text-align: center"><?php echo $card['car_regis_number'] ?></td>
                                    <td><?php echo $card['pro_name'] ?></td>
                                    <td><?php echo $card['card_type_name'] ?></td>
                                </tr>
                           <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#tblEmpCars').DataTable({
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
        });
        $('.dataTables_filter input[type="search"]').css(
                {'width': '350px', 'display': 'inline-block'}
        );
    });
</script>