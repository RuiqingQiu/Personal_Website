<meta http-equiv="Content-Type" content="text/html; charset=utf8" />

<?php
	include_once '../lib/common.php';
	include_once '../lib/db.php';
	include_once '../lib/functions.php';
	include_once '../lib/user.php';
	
//session_start();

mysql_query("set names utf8");
if (isset($_GET['register']))
{
	if(isset($_POST['reg_name']) && isset($_POST['reg_gender'])
  && isset($_POST['reg_grade']) && isset($_POST['reg_type'])
  && isset($_POST['reg_dr_age']) && isset($_POST['reg_mobile'])
  && isset($_POST['reg_email']) && isset($_POST['reg_password'])
  && isset($_POST['reg_repeat'])) 
	{
		if(empty($_POST['reg_name']) || empty($_POST['reg_gender'])
    || empty($_POST['reg_grade']) || empty($_POST['reg_type']) //|| empty($_POST['reg_dr_age']) 
		|| empty($_POST['reg_mobile']) || empty($_POST['reg_email'])
    || empty($_POST['reg_password']) || empty($_POST['reg_repeat']))
		{		
			echo "请完整地填写每一项,谢谢";
		}
		else
		{
			if(!empty($_POST['reg_dr_age'])){
				$drive_age=$_POST['reg_dr_age'];
				if($drive_age < 0 || $drive_age > 30){
					//echo "驾龄必须在0到30之间,谢谢配合.";
					echo "<script type='text/javascript'>alert('驾龄必须在0到30之间,谢谢配合.');</script>";
					$drive_age_condition = false;
				}
			}
			
		
			$email=$_POST['reg_email'];
			$result1=mysql_query("select * from `ucsdcarpool`.`cp_user` where `email`='".$email."'");
			$row=mysql_num_rows($result1);
			
			if($row)
			{ 
				echo "邮箱已使用，请更换邮箱重试！"; 
				//echo $temp;
				echo"<a href=register_form.php>返回</a>";
			}
			
			
			else
			{
				//if( $_SESSION['sname']==$code)
				//{
				if($_POST['reg_password'] == $_POST['reg_repeat'])
				{
					echo $temp="认证码成功";
			 		$sql="INSERT INTO `ucsdcarpool`.`cp_user` (`zh_name`, `gender`, `grade`, `type`,`drive_age`, `mobile`, `email`, `password`, `credit`) VALUES('".$_POST['reg_name']."','"
					. $_POST['reg_gender'] ."','".$_POST['reg_grade'] ."','"
					. $_POST['reg_type'] ."','".$_POST['reg_dr_age']."','"
					. $_POST['reg_mobile']."','". $_POST['reg_email']."','" 
					.md5($_POST['reg_password']) ."','".'0'."')";
					echo $sql;
			 		$result=mysql_query($sql);

					if($result==true)
					{
						if($drive_age_condition == false)
							echo "<script>window.location.href='../user/register_form.php'</script>";
						echo "<script>window.location.href='../user/login_form.php'</script>";
					 // $_SESSION['mail']="注册成功,请登陆";
					  //echo "<script>window.location.href='login.php'</script>";
					}
					else
					{
						echo "注册失败".mysql_error();
					}
				}
				else
				{
					echo "重复密码错误！";
				}
				//}
			}

		}
	}
	else
	{
		echo "请完整地填写每一项,谢谢";
	}


}

?>
