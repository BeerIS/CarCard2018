<meta charset="utf-8">
<?php
session_start();
// Report all errors except E_NOTICE
//error_reporting(E_ALL & ~E_NOTICE &~E_WARNING &~E_DEPRECATE);
$log = $_POST['logintype'];
$username = $_POST['username'];
$pwd = $_POST['pwd'];

if($log==0)//employee
{
    include("lib/nusoap.php");
    $client = new soap_client('http://webservices.egat.co.th/authentication/au_provi.php', 'wsdl');
    $para = array("a" => $username, "b" => $pwd);
    $result = $client->call("validate_user", $para);
    //$req_id = $_GET["req_id"];

    if (!$result) {
        ?>
        <script>

            alert("ชื่อผู้ใช้งาน หรือรหัสผ่านไม่ถูกต้อง");
            window.location = 'index.php';
        </script>
        <?php
    } else {
        $_SESSION['username'] = $username;  //รหัสพนักงาน
        ?>
        <script>
            window.location = 'request.php';
        </script>
        <?php
    }
}
else if($log==1)  //staff
{
    include("connectSQL.php");
    $sql = "SELECT * FROM staff WHERE staff_id='$username' AND password = '$pwd' ";
    $qUser = mysqli_query($objConnect, $sql);
    if(mysqli_num_rows($qUser)==0)
    {
    ?>
        <script>
            alert("ชื่อผู้ใช้งาน หรือรหัสผ่านไม่ถูกต้อง");
            window.location = 'index.php';
        </script>
   <?php
    }
    else
    {
        $_SESSION['username'] = $username;  //รหัสพนักงาน
        $Redirect = $_POST["hidRedirect"];
        $req_id = $_POST["hidReq"];
        $path = "staff/index.php";
        if(strlen($Redirect) > 0  && strlen($req_id)>0){
            $path .= "?menu=".$Redirect;
            $path .= "&req_id=".$req_id;
        }
    ?>
        <script>
            window.location = '<?=$path;?>';
        </script>
<?php
    }
}
?>