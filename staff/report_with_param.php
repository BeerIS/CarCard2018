<?php
require_once 'report_precess.php';

$errorMessage = '&nbsp;';

//if (isset($_POST['username'])) {
//    $tmp = $_POST['username'];
//    debug_to_console($tmp);
//}

if (isset($_POST['name'])) {
	$result = doLogin();
	
	if ($result != '') {
            $errorMessage = $result;
	}
}

?>

<html>
<body>

<form action="" method="post">
param1: <input type="text" name="name"><br>
param2: <input type="text" name="email"><br><br>
<input type="submit">
</form>

</body>
</html> 