<?php
session_start();
?>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" href="main.css">
</head>
<body>

<?php


$connect = mysql_connect("localhost","root","") or die(mysql_error());
mysql_select_db("sqlshop");

echo <<<HERE
  <form method = "POST" action ="register.php" >

    <input type ="text" name = "email" placeholder = "e-mail" required><br/>
    <input type ="text" name = "name" placeholder = "name" required><br/>
    <input type ="password" name = "password" placeholder = "password" required><br/>
    <input type ="password" name = "r_password" placeholder = "repeat password" required><br/>
    <input type="submit" name ="button" value = "Зарегистрироваться">
  </form>
  <a href = "index.php">Вернуться к заказам</a>
HERE;

  if(isset($_POST['button']))
  {

    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)&&($_POST['password']==$_POST['r_password']))
    {
      
      if($result = mysql_query("SELECT email FROM user WHERE email=".$_POST['email']."")){
        echo 'Пользователь с таким e-mail уже существует';
      } 
      else {
        $hash = md5($_POST['password']);
        $query = mysql_query("INSERT INTO user VALUES ('','".$_POST['email']."','".$_POST['name']."','$hash','user')");
        
        echo 'Вы успешно зарегистрированы';
        
      }
    }
    
    else echo 'Некорректный ввод';
  }
?>
</body>
</html>