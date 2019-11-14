<?php

function doLogin()
{
	// ถ้าพบ error ก็จะถูกเซฟลงใน array() ที่ชื่อว่า $errorMessage
	$errorMessage = '';
	
	//รับค่า Username และ Password มาจากแบบฟอร์มล็อกอิน
	$userName = $_POST['name'];
	$password = $_POST['email'];
        
        $initialVector = '123456789';
        $secretKey = 'secret';
        //$encrypt = encrypt($userName, $initialVector, $secretKey);
        
        //http://www.androidsnippets.com/encrypt-decrypt-between-android-and-php.html
        //Encrypt _ Decrypt Between Android and PHP - Android Snippets.pdf
        $mcrypt = new MCrypt();
        $encrypt = $mcrypt->encrypt($userName);
        
	//เข้ารหัส password ด้วยฟังก์ชัน md5() 
	//palm@17-02-17, $hashPassword = md5($password.SECRET_KEY);
	
        //debug_to_console($userName);
        //debug_to_console($password);
        
	// ประการแรกตรวจสอบให้แน่ใจว่า username & password ไม่เป็นอะไรที่ว่างๆ
	if ($userName == '') {
		$errorMessage = 'You must enter your username';
	//} else if ($password == '') {
	//	$errorMessage = 'You must enter the password';
	} else {
            
            //header('Location: index.php');
            //header('Location: http://10.20.146.168:8083/reportServlet/GenReport?param1=' + $encrypt);
            //$url = 'Location: http://10.20.146.168:8083/reportServlet/GenReport?param1=$en';
            //echo $url;
            
            header("Location: http://localhost:8083/servletCarcard2/rptService?param1=$encrypt");
            exit;
            
//		//ตรวจสอบฐานข้อมูลดูว่า username และ password ถูกต้องตรงกันหรือไม่ 
//		//และต้องมีฐานะเป็น admin โดยดูจาก user_role= 'admin'
//		$sql = "SELECT user_id
//		        FROM tbl_user 
//				WHERE user_name = '$userName' AND user_password = '$password' AND user_role = 'admin' ";
//		$result = dbQuery($sql);
//	
//		if (dbNumRows($result) == 1) {
//			$row = dbFetchAssoc($result);
//			$_SESSION['plaincart_user_id'] = $row['user_id'];
//			
//			// อัพเดท เวลาล็อคอิน ว่าได้มีการล็อคอินครั้งสุดท้ายเมื่อใด
//			$sql = "UPDATE tbl_user 
//			        SET user_last_login = NOW() 
//					WHERE user_id = '{$row['user_id']}'";
//			dbQuery($sql);
//
//			// ถ้าผู้ใช้ที่ล็อคอินในปัจจุปัน ถูกยืนยันชื่อและรหัสผ่านถูกต้อง ก็จะไปยังหน้าถัดไป
//			// ถ้าเคยเข้ามามายังส่วนของ Admin แล้ว
//			// ให้ไปยังเว็บเพจหน้าสุดท้ายที่เคยเยี่ยมชม
//			if (isset($_SESSION['login_return_url'])) {
//				header('Location: ' . $_SESSION['login_return_url']);
//				exit;
//			} else {
//				header('Location: index.php');
//				exit;
//			}
//		} else {
//			$errorMessage = 'Wrong username or password or don\'t have permission';
//		}		
			
	}
	
	return $errorMessage;
}

function encrypt($message, $initialVector, $secretKey) {
    return base64_encode(
        mcrypt_encrypt( 
            MCRYPT_RIJNDAEL_128,
            md5($secretKey),
            $message,  
            MCRYPT_MODE_CFB,
            $initialVector
        )
    );
}

    class MCrypt
        {
                private $iv = 'fedcba9876543210'; #Same as in JAVA
                private $key = '0123456789abcdef'; #Same as in JAVA


                function __construct()
                {
                }

                function encrypt($str) {

                  //$key = $this->hex2bin($key);    
                  $iv = $this->iv;

                  $td = mcrypt_module_open('rijndael-128', '', 'cbc', $iv);

                  mcrypt_generic_init($td, $this->key, $iv);
                  $encrypted = mcrypt_generic($td, $str);

                  mcrypt_generic_deinit($td);
                  mcrypt_module_close($td);

                  return bin2hex($encrypted);
                }

                function decrypt($code) {
                  //$key = $this->hex2bin($key);
                  $code = $this->hex2bin($code);
                  $iv = $this->iv;

                  $td = mcrypt_module_open('rijndael-128', '', 'cbc', $iv);

                  mcrypt_generic_init($td, $this->key, $iv);
                  $decrypted = mdecrypt_generic($td, $code);

                  mcrypt_generic_deinit($td);
                  mcrypt_module_close($td);

                  return utf8_encode(trim($decrypted));
                }

                protected function hex2bin($hexdata) {
                  $bindata = '';

                  for ($i = 0; $i < strlen($hexdata); $i += 2) {
                        $bindata .= chr(hexdec(substr($hexdata, $i, 2)));
                  }

                  return $bindata;
                }

        }

?>