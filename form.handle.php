<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>form.handle.php</title>
</head>
<body>
	<?php 
		define('DB_HOST', 'localhost');
		define('DB_USER', 'root');
		define('DB_PASSWORD', '123456');
		define('DB_NAME', '3dprintdb');

		//conneting database...
		$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		mysqli_query($dbc, 'set names utf8') or die('Error setting utf-8');
		
		//Post Message...
		$name = mysqli_real_escape_string($dbc, trim($_POST['name']));
		$mail = mysqli_real_escape_string($dbc, trim($_POST['mail']));
		$project = mysqli_real_escape_string($dbc, trim($_POST['project']));
		$message = mysqli_real_escape_string($dbc, trim($_POST['message']));
		if(!empty($name) && !empty($mail) && !empty($project) && !empty($message)){
			$regex = '/^[a-zA-Z0-9][a-zA-Z0-9\._\-&!?=#]*@/';
			if(!preg_match($regex, $mail)){
				echo '<script>alert("你输入的邮箱格式不正确，请重新输入!");window.location.href="http://localhost/mail.html";</script>';
			}
			else{
				$query = "INSERT INTO 3dprint(name,mail,project,message,date) VALUES('$name','$mail','$project','$message',NOW())";
				$relust = mysqli_query($dbc, $query) or die('Error querying');
				echo '<script>alert("提交成功!");window.location.href="http://localhost/mail.html";</script>';
			}
		}
		else{
			echo '<script>alert("请将表单填写完整!");window.location.href="http://localhost/mail.html";</script>';
		}
		mysqli_close($dbc);
	 ?>
</body>
</html>