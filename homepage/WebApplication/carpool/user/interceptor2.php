<?php
require_once '../lib/db.php';

//开启一个会话
//session_start();

//$error_msg = "";
//如果用户已经登录，执行以下代码
if(isset($_SESSION['id'])){}
else{
	echo "<script>window.location.href='../user/login_form.php'</script>";
//exit;
}
?>
