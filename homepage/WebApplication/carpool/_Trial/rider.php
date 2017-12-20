<CTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

﻿<?php
include_once '../lib/common.php';
include_once '../lib/db.php';
include_once '../lib/functions.php';
include_once '../lib/user.php';
//include_once '../user/interceptor.php';
include_once '../lib/status.php';
?>

<body>

<div id="mainbar">

	<h1>特殊请求</h1>	
		<table align="center">
		<tr><th>发起ID</th><th>地点</th><th>时间</th><th>备注</th></tr>
		<?php
		mysql_query("set names utf8");
		$sql="SELECT `id`,`place`,`time`,`num_limit`,`num_current`,`note` FROM `db_cp`.`cp_special_places` WHERE 1";
		//echo $sql;
		$re=mysql_query($sql) or die('Cannot Execute:'. mysql_error());
		$row=mysql_num_rows($re);
		if($row){
		while($row2=mysql_fetch_array($re)){       //注意括号结束的位置
			$id=$row2['id'];
			$place=$row2['place'];
			$time=$row2['time'];
			$note=$row2['note'];
		?>
		<tr><td align="center" valign="middle"><?echo $id;?></td><td align="center" valign="middle"><?echo $place;?></td><td align="center" valign="middle"><?echo $time;?></td><td align="center" valign="middle"><?echo $note;?></td></tr>
		<?php
		}           //while循环结束的括号
		}             //if结束的括号
		?>
		</table>

	<h1>我有车，我要提供Ride！</h1>	
		<form action="record.php?post-regular" method="post" class="infoForm">
			<table border="0">
				<tr>
					<td>地点</td>
					<td><input style="width: 280px; height: 24px" type="text" name="place" id="place"></td>
				</tr>
				<tr>
					<td>时间</td>
					<td><input style="width: 280px; height: 24px" type="text" name="time" id="time"></td>
				</tr>
				<tr>
					<td>人数</td>
					<td><input style="width: 280px; height: 24px" type="text" name="num" id="num"></td>
				</tr>
				<tr>
					<td>备注</td>
					<td><input style="width: 280px; height: 24px" type="text" name="note" id="note"></td>
				</tr>
				<tr>
					<td>请设定密码</td>
					<td><input style="width: 280px; height: 24px" type="password" name="password" id="password"></td>
				</tr>
				
				<tr style="height:10px">
				</tr>
				<tr>
					<td align="center"><input class="button" value="提交" type=submit></td>
				</tr>
			</table>
				                    		
		</form>		
		
	</div>
</body>
</html>

