<?php
    include("../connectSQL.php");
    $cardId = $_POST['cardId'];
    $printedBy=$_POST['printedBy'];
    $remark=$_POST['remark'];
    $sqlInsertLog = "INSERT INTO card_log (card_id, printedBy, printedDate, remark) VALUES ('$cardId','$printedBy',now(),'$remark')";
    $qsaveLog = mysqli_query($objConnect, $sqlInsertLog);
    $result = array();

    if($qsaveLog)
    {
        $result[] = 1;
        $sqlLatest = "SELECT l.printedDate, l.printedBy, e.name, l.remark FROM card_log l INNER JOIN egat1.vw_egat_emp e ON e.empn=l.printedBy WHERE card_id = '$cardId' ORDER BY printedDate DESC LIMIT 1";
        $qLatest = mysqli_query($objConnect, $sqlLatest);
        $latestRow = mysqli_fetch_array($qLatest);

        $result[] = $latestRow;
    }
    else{
        $result[]=0;

    }
    echo json_encode($result);       
?>
