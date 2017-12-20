<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
include_once '../lib/common.php';
include_once '../lib/db.php';
include_once '../lib/functions.php';
include_once '../lib/user.php';
include_once '../lib/status.php';
//include_once '../user/interceptor.php';
?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>注册成功</title>
		<link rel="shortcut icon" href="../img/carpoolIcon.ico">
		<link href="../css/login.css" rel="stylesheet" type="text/css" />
		<link href="../css/page_bottom.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="../js/jquery-1.4.3.js"></script>
	</head>
	<body>
		<div class="">
			<div class="">
				<!--<div class="succ">
					<img src="${pageContext.request.contextPath}/images/login_success.jpg" />
				</div>-->
				<h5>
					<?email;?>，欢迎回来！
				</h5>
				<h6>
					请牢记您的登录邮件地址：<?email;?>
				</h6>

				<ul>
					<li class="nobj">
						您现在可以：
					</li>
				<!--	<li>
						进入“
						<a href="#"></a>”查看并管理您的个人信息
					</li>
				-->
						<a href="../business/rider.php">提供ride</a>
					</li>
					<li>
						<a href="../business/passenger.php">查看所有可用ride</a>
					</li>
				</ul>
			</div>
		</div>

	</body>
</html>

