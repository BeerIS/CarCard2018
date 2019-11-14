<meta charset="utf-8">
<?
    session_start();
    $username = $_SESSION['username'];
    $request_id = $_POST['req_id'];
    $radio = $_POST['optradio'];
    $comment = $_POST['comment'];
    function phpAlert($msg) {
        echo '<script type="text/javascript">alert("' . $msg . '")</script>';
    }
    if ($radio == 1) 
        {
            require '../connectSQL.php';
            $sql = "INSERT INTO status_log (status_id,request_id,status_date,staff_id,comment) VALUES (3,'$request_id',now(),'$username','อนุมัติ')";
            $obj = mysqli_query($objConnect, $sql) or die(mysqli_error($objConnect));
?>
            <script type="text/javascript">
                window.location.assign("index.php?menu=list");
                alert("อนุมัติคำขอเรียบร้อยแล้ว");
            </script>
<?
        } 
    else if ($radio == 0) 
        {
            require '../connectSQL.php';
            $sqli = "INSERT INTO status_log (status_id,request_id,status_date,staff_id,comment) VALUES (2,'$request_id',now(),'$username','$comment')";
            $obj = mysqli_query($objConnect, $sqli) or die(mysqli_error($objConnect));
?>
            <script type="text/javascript">
                window.location.assign("index.php?menu=list");
                alert("เอกสารไม่ถูกต้อง แก้ไขสถานะแล้ว");
            </script>
<?
        } 
    else if ($radio == 2)
        {
            require '../connectSQL.php';
            $sqli = "INSERT INTO status_log (status_id,request_id,status_date,staff_id,comment) VALUES (1,'$request_id',now(),'$username','อ่านแล้ว')";
            $obj = mysqli_query($objConnect, $sqli) or die(mysqli_error($objConnect));
?>
            <script type="text/javascript">
                window.location.assign("index.php?menu=list");
                alert("รับรู้คำขอแล้ว");
            </script>
<?
        }
?>

