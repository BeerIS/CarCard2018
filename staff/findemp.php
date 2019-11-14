<?php
include("../config29.php");
if(!isset($_GET['empId']))
{    
    die();
}
else 
{
    $empn = $_GET['empId'];    
    $sqlEmp = "SELECT e.empn, CONCAT(e.title,e.name) as empName, e.job_nm2, e.section1, e.section2, e.fay, e.long, t.tel_1, t.tel_2 "
            . "FROM egat1.vw_egat_emp e LEFT JOIN owen_tel t "
            . "ON e.empn = t.emp_id "
            . "WHERE empn='$empn'" ;
    
    $qEmp = mysqli_query($conn, $sqlEmp);
    
    if(mysqli_num_rows($qEmp)>0)
    {
        $emp = mysqli_fetch_array($qEmp);
        $output = json_encode($emp);
    }
    else {
      $output = "Employee not found";
    }
    echo $output;    
}
?>