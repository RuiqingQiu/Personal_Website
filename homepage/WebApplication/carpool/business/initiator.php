<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
include_once "../lib/db.php";
?>

<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>发起人信息</title>
    <link rel="shortcut icon" href="../img/carpoolIcon.ico">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<link rel="stylesheet" href="../css/register_form.css" />
		<link rel="stylesheet" type="text/css" href="../css/header.css" />
		<link rel="stylesheet" type="text/css" href="../css/footer.css" />
	</head>
  <body>
		<div class="header">
  		<?php
				include_once '../lib/header.php';
			?>
		</div>
		<?php
			mysql_query("set names utf8");
			$sql="SELECT `zh_name`,`gender`,`grade`,`email`,`mobile` FROM `ucsdcarpool`.`cp_user` WHERE `id`= ".$_GET['id'];
			//echo $sql;
			$re=mysql_query($sql) or die('Cannot Execute:'. mysql_error());
			$row=mysql_num_rows($re);
			if($row)
			{
				while($row2=mysql_fetch_array($re))
				{       //注意括号结束的位置
					$zh_name=$row2['zh_name'];
					$gender=$row2['gender'];
					$grade=$row2['grade'];
					$email=$row2['email'];
					$mobile=$row2['mobile'];
				}
			}
		?>
		<table>
		  <tr><td>发起人：<?echo $zh_name;?></td></tr>
			<tr><td>性别：<?echo $gender;?></td></tr>
			<tr><td>年级：<?echo $grade;?></td></tr>
			<tr><td>email:<?echo $email;?>@ucsd.edu</td></tr>
			<tr><td>Tel：<?echo $mobile;?></td></tr>
		</table>
		<div class="footer">
			<?php
				include_once '../lib/footer.php';?>
		</div>
	</body>
</html>
