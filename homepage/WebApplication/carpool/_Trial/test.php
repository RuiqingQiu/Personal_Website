<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	</head>
	
	<?php
	con = mysql_connect("localhost","","");
	if (!con)
	{
	die('Could not connect: ' . mysql_error());
	}mysql_select_db("my_db", con);sql="INSERT INTO person (FirstName, LastName, Age)
	VALUES
	('_POST[firstname]','_POST[lastname]','_POST[age]')";if (!mysql_query(sql,con))
	{
	die('Error: ' . mysql_error());
	}
	echo "1 record added";mysql_close(con)
	?>

	<body>
		<form action="insert.php" method="post">
			Firstname: <input type="text" name="firstname" />
			Lastname: <input type="text" name="lastname" />
			Age: <input type="text" name="age" />
		<input type="submit" />
		</form>
	</body>
</html>
