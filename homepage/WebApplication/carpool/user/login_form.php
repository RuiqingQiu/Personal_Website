<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
require_once '../lib/db.php';
include_once '../lib/db.php';
include_once '../lib/functions.php';
include_once '../lib/user.php';
//include_once 'interceptor2.php';


$error_msg = "";
//如果用户未登录，即未设置$_SESSION['user_id']时，执行以下代码
if(!isset($_SESSION['id'])){
    if(isset($_POST['submit'])){//用户提交登录表单时执行如下代码

        //$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_SCHEMA);
        //$user_username = mysqli_real_escape_string($dbc,trim($_POST['email']));
        //$user_password = mysqli_real_escape_string($dbc,trim($_POST['password']));
        //if(!empty($user_username)&&!empty($user_password)){

			if(!empty($_POST['email'])&&!empty($_POST['password'])){
            //MySql中的SHA()函数用于对字符串进行单向加密:password = SHA('$user_password')";
						mysql_query("set names utf8");
            $query = "SELECT `id`, `zh_name` FROM `cp_user` WHERE `email` = '".$_POST['email']."' AND "."`password` = '".md5($_POST['password'])."'";
						//echo $query;
            //用用户名和密码进行查询
            $data = mysql_query($query);//mysqli_query($dbc,$query);
            //若查到的记录正好为一条，则设置SESSION，同时进行页面重定向
            if(mysql_num_rows($data)==1){
                $row = mysql_fetch_array($data);
                //$_SESSION['user_id']=$row['user_id'];
                $_SESSION['id']=$row['id'];
								$_SESSION['zh_name']=$row['zh_name'];
								//$_SESSION['password']=$row['password'];
                echo "<script>window.location.href='../main/index.php'</script>";
            }else{//若查到的记录不对，则设置错误信息
                $error_msg = 'Sorry, you must enter a valid email and password to log in.';
            }
        }else{
            $error_msg = 'Sorry, you must enter a valid email and password to log in.';
        }
    }
}else{//如果用户已经登录，则直接跳转到已经登录页面
    echo "<script>window.location.href='../main/index.php'</script>";
}
?>



<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>用户登录</title>
		<link rel="shortcut icon" href="../img/carpoolIcon.ico">
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<link rel="stylesheet" href="../css/login_form.css" />
		<link rel="stylesheet" type="text/css" href="../css/header.css" />
		<link rel="stylesheet" type="text/css" href="../css/footer.css" />
	</head>

	<body>
		<div class="header">
		<?php
			include_once '../lib/header.php';?>
		</div>
		<div class="enter_part">
			<div class="enter_in">
				<div class="bj_top"></div>
				<div class="center">
					<div class="main">
						<h1>登录</h1><br />

				<!--通过$_SESSION['user_id']进行判断，如果用户未登录，则显示登录表单，让用户输入用户名和密码-->
        <?php
        if(!isset($_SESSION['id'])){
            echo '<p class="error" style="color: red;">'.$error_msg.'</p>';
        ?>
        <!-- $_SERVER['PHP_SELF']代表用户提交表单时，调用自身php文件 -->
						<form method="post" action="<?echo $_SERVER['PHP_SELF'];?>">
							<ul>
								<li>
									<span>Email:</span>
									<input type="text" name="email" id="email" class="textbox" />&nbsp;@ucsd.edu
                  <br /><br />
								</li>
								<li>
									<span class="blank">密码:&ensp;</span>
									<input type="password" name="password" id="password"
										class="textbox" /><br /><br />
								</li>
								<li>
									<input name="submit" type="submit" id="" class="button_enter"
										value="登 录" /><br /><br />
									<div style="height: 30px; padding: 5px; color: red" 
										id="divErrorMssage"></div>
								</li>
							</ul>
							<input type="hidden" name="uri" value="${uri}" />
						</form>
						<?php
        		}
        		?>
					</div>
					<div class="user_new">
						<p>
							还未注册？<a href="../user/register_form.php">创建一个新用户&gt;&gt;</a>
						</p>
					</div>
				</div>
			</div>
		</div>

		<div class="footer">
			<?php
				include_once '../lib/footer.php';?>
		</div>
	</body>
</html>

