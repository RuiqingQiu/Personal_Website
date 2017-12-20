<?php
	if(isset($_SESSION['id'])){
?>
		<div class="userInfo"><div class="userName"><b><?echo $_SESSION['zh_name'];?></div></b>,欢迎回来！[<a href="../user/logout.php">退出</a>]</div>
<?php
	}
  else
  {
?>
		<div>[<a href="../user/login_form.php">登录</a>|<a href="../user/register_form.php">注册</a>]</div>
<?php
	}
?>

