<?php
session_start();
include_once '../lib/common.php';
include_once '../lib/db.php';
include_once '../lib/functions.php';
include_once '../lib/user.php';
?>



<CTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">



                
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>请输入密码</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
	<link rel="stylesheet" type="text/css" href="../css/header.css" />
	<link rel="stylesheet" type="text/css" href="../css/footer.css" />
	<link rel="stylesheet" type="text/css" href="../css/password.css" />
</head>

<body>  
    <div class="header">
		<?php
			include_once '../lib/header.php';?>
		</div>
            
<div id="mainbar">         
		<h1>您可以通过联系司机来获取邀请码</h1><br>         
                <form action="verify.php?id=<?echo $_GET['id']?>" method="post" class="infoForm">
                        <table border="0">
                                <tr>    
                                        <td>请输入邀请码: <input style="width: 280px; height: 24px" type="password" name="password" id="password"></td>
                                </tr>
                                
                                <tr style="height:10px">
                                </tr>
                                <tr>
                                        <td align="center"><input class="button" value="提交" type=submit></td>
                                </tr>
                        </table>
                </form>                                 

</div>
<div class="footer">
			<?php
				include_once '../lib/footer.php';?>
		</div>
</body>
</html>
