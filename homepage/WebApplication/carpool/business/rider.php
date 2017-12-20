<?php session_start();
?>
<CTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />


<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">


﻿<?php
include_once '../lib/common.php';
include_once '../lib/db.php';
include_once '../lib/functions.php';
include_once '../lib/user.php';
include_once '../user/interceptor2.php';
?>


<head>
 
  <meta charset="utf-8" />
  <title>发起人页面</title>
  <link rel="shortcut icon" href="../img/carpoolIcon.ico">
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
  <link rel="stylesheet" href="../css/status.css" />
  <link rel="stylesheet" href="../css/carpoolInfo.css" />
  <link rel="stylesheet" href="../css/rider.css" />
  <link rel="stylesheet" href="../css/header.css" />
  <link rel="stylesheet" href="../css/footer.css" />
  <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
  <script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
  <script>
  $(function() {
    $( "#datepicker" ).datepicker();
    
    $(".fieldSlider").click(function() {
    	if ($("#giveRideField").css("display") == "none") {
	    	console.log("slideup");
		    $(".fieldSlider a").css("color", "#424242");
	    } else {
		    $(".fieldSlider a").css("color", "white");
		    console.log("slidedown");
	    }
	    $("#giveRideField").slideToggle();
        
        return false;
     });
     
     $("#notrequired").click(function() {
    	if ($("#myMenu").css("display") == "none") {
	    	console.log("slideup");
	    } else {
		    console.log("slidedown");
	    }
	    
        $("#myMenu").slideToggle();
        return false;
     });
      
  });
       
  function slideDown(){
	     $("#giveRideField").slideToggle();
  }
  
  function checkboxGasClick(){
	  var textbox = document.forms[0].note;
  		if(gas.checked == 1){
  			//textbox.value="NO smoking";
	  		 if(smoke.checked == 1){ 
		  		 textbox.value = ("No Smoking and share gas fee");
	  		 }
	  		 else{
		  		 textbox.value = ("Share gas fee");
	  		 }	 
  		}
  		else{
	  		if(smoke.checked == 1){ 
		  		 textbox.value = ("No Smoking");
	  		 }
	  		 else{
		  		 textbox.value = ("");
	  		 }	 
  		}
  }
  
  function checkboxSmokeClick(){
		var textbox = document.forms[0].note;
  		if(smoke.checked == 1){
  			//textbox.value="NO smoking";
	  		 if(gas.checked == 1){ 
		  		 textbox.value = ("No Smoking and share gas fee");
	  		 }
	  		 else{
		  		 textbox.value = ("No Smoking");
	  		 }	 
  		}
  		else{
	  		if(gas.checked == 1){ 
		  		 textbox.value = ("Share gas fee");
	  		 }
	  		 else{
		  		 textbox.value = ("");
	  		 }	 

  		}
  }
  </script>
</head>

<body onload="slideDown()">
<div class="header">
	<?php
		include_once '../lib/header.php';?>
</div>


<div class="main">
	
	<div class="dropdownField" id="giveRideField">
		<h1>我要提供Ride！</h1>	
		<form class="infoForm" action="record.php?post-regular" method="post">
			<table border="0">
				<tr>
					<td>地点</td>
					<td>
						<select style="width: 280px; height: 24px" name="place" id="place">
							<option value="null" select="selected">--请选择地点--</option>
							<option value="Convoy Street">Convoy Street</option>
							<option value="Costco">Costco</option>
							<option value="Fashion Valley">Fashion Valley</option>
							<option value="LAX Airport">LAX Airport</option>
							<option value="Ralphs">Ralphs</option>
							<option value="Ranch 99">Ranch 99</option>
							<option value="SAN Airport">SAN Airport</option>
							<option value="UCSD">UCSD</option>
							<option value="UTC">UTC</option>
							<option value="Vons">Vons</option>
							<option value="Walmart">Walmart</option>
							
						</select>
					</td>
				</tr>
				<tr>
					<td>日期</td>
					<td>
					<p><input type="text" id="datepicker" name="time" style="width: 280px; height: 24px" /></p></td>
				</tr>
				<tr>
					<td>人数</td>
					<td><input style="width: 280px; height: 24px" type="text" name="num" id="num"></td>
					
				</tr>
				<tr>
					<td>备注(最大字数100)</td>
					<td><input style="width: 280px; height: 24px" type="text" name="note" id="note"></td>
					<td>						
						<input type="checkbox" id="smoke" name="smoke" value="No Smoking" onclick="checkboxSmokeClick()">No Smoking<br>
						<input type="checkbox" id="gas" name="gas" value="gas" onclick="checkboxGasClick()">Share Gas Fee
					</td>
				</tr>
				<tr>
					<td>请设定邀请码(您的乘客可以通过邀请码加入)</td>
					<td><input style="width: 280px; height: 24px" type="password" name="password" id="password"></td>
				</tr>
			</table>
			
			<input class="submitBtn" align="center" value="提交" type=submit>
		</form>		
	</div>
	
	<div class="fieldSlider"><a href="#">我要提供Ride！</a></div>
	<div id="thanksRide"><a href="http://ucsdcssa.org">UCSD CSSA</a> 感谢您的参与! <a href="http://page.renren.com/601269960?checked=true">人人</a>为我，我为<a href="http://page.renren.com/601269960?checked=true">人人</a>！</div>
	
	<div class="mainList">	
		<div class="mainbar">
			<h1 class="titleMainbar">已有请求Carpool信息</h1>	
				<table class="infoList">
				<tr>
				<th>发起人</th>
				<th><a href="?orderby=place"> 地点</a></th>
				<th><a href="?orderby=time"> 日期</a></th>
				<th>备注</th>
				</tr>
				
				<?php
			mysql_query("set names utf8");
			if (isset($_GET['orderby']))
			{
				$order = $_GET['orderby']; 
			}
			else
			{
				$order="time";
			}
			$sql="SELECT `ucsdcarpool`.`cp_special_places`.`id`,`place`,`time`,`num_limit`,`num_current`,`note`,`initiator_id`, `zh_name` FROM `ucsdcarpool`.`cp_special_places` JOIN `ucsdcarpool`.`cp_user` WHERE `ucsdcarpool`.`cp_special_places`.`initiator_id` = `ucsdcarpool`.`cp_user`.`id` ORDER BY `ucsdcarpool`.`cp_special_places`.`".$order."` DESC";
			//echo $sql;
			$re=mysql_query($sql) or die('Cannot Execute:'. mysql_error());
			$row=mysql_num_rows($re);
			if($row){
				while($row2=mysql_fetch_array($re)){       //注意括号结束的位置
					$id=$row2['id'];
					$init_id =$row2['initiator_id'];
					$place=$row2['place'];
					$time=$row2['time'];
					$note=$row2['note'];
					$zh_name=$row2['zh_name'];
				?>
				
					<tr valign="top" class="tb_row">
						<td class="tb_name"><a href="../business/initiator.php?id=<?echo $init_id;?>"><?echo $zh_name;?></td>
						<td class="tb_place"><?echo $place;?></td>
						<td class="tb_time"><?echo $time;?></td>
						<td class="tb_note"><?echo $note;?></td>
						
					</tr>
					<?php
					}           //while循环结束的括号
				}             //if结束的括号
				?>
</table>
		</div>
		
		<div class="mainbar">
			<h1 class="titleMainbar" id="notrequired"><a href="">已有提供Carpool信息</a></h1>	
			<table class="infoList" id="myMenu" hidden="true">
			<tr>
			<th>发起人</th>
			<th><a href="?orderby=place"> 地点</a></th>
			<th><a href="?orderby=time"> 日期</a></th>
			<th>最大人数</th><th>目前人数</th>
			<th>备注</th>
			</tr>
			<?php
				mysql_query("set names utf8");

                        if (isset($_GET['orderby']))
                        {
                                $order = $_GET['orderby'];
                        }
                        else
                        {
                                $order="time";
                        }
				$sql="SELECT `ucsdcarpool`.`cp_regular_places`.`id`,`place`,`time`,`num_limit`,`num_current`,`note`,`initiator_id`, `zh_name` FROM `ucsdcarpool`.`cp_regular_places` JOIN `ucsdcarpool`.`cp_user` WHERE `ucsdcarpool`.`cp_regular_places`.`initiator_id` = `ucsdcarpool`.`cp_user`.`id` ORDER BY `ucsdcarpool`.`cp_regular_places`.`".$order."` DESC";
				//echo $sql;
				$re=mysql_query($sql) or die('Cannot Execute:'. mysql_error());
				$row=mysql_num_rows($re);
				if($row){
					while($row2=mysql_fetch_array($re)){       //注意括号结束的位置
						$id=$row2['id'];
						$place=$row2['place'];
						$time=$row2['time'];
						$num_lim=$row2['num_limit'];
						$num_cur=$row2['num_current'];
						$note=$row2['note'];
						$zh_name=$row2['zh_name'];
				?>
				
				<tr valign="top" class="tb_row">
					<td class="tb_name"><a href="../business/initiator.php?id=<?echo $init_id;?>"><?echo $zh_name;?></a></td>
					<td class="tb_place"><?echo $place;?></td>
					<td class="tb_time"><?echo $time;?></td>
					<td class="tb_numlim"><?echo $num_lim;?></td>
					<td class="tb_numcur"><?echo $num_cur;?></td>
					<td class="tb_note"><?echo $note;?></td>
				</tr>
				<?php
				}           //while循环结束的括号
			}             //if结束的括号
			?>
			</table>
	
		</div>
	</div>
</div>

<div class="footer">
	<?php
		include_once '../lib/footer.php';?>
</div>

</body>
</html>

