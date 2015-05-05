<?php
session_start();
$_SESSION['name'];
$_SESSION['role'];
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
  <form method = "POST" action ="signin.php" >

    <input type ="text" name = "email" placeholder = "e-mail" required><br/>
    <input type ="password" name = "password" placeholder = "password" required><br/>
    <input type="submit" name ="button" value = "Войти">
  </form>
  <a href="register.php">Зарегистрироваться</a></br>
  <a href = "index.php">Вернуться к заказам</a>
HERE;
  if(isset($_POST['button']))
  {
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
    {
      $hash = md5($_POST['password']);
      $user = $_POST['email'];
      $query = "SELECT * FROM user WHERE email='$user' AND password='$hash' ";
      $result = mysql_query($query) or die(mysql_error());
      $row = mysql_fetch_assoc($result);
      
      if($row!=null)
      {
        echo 'Вы успешно вошли, '.$row['name'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['role'] = $row['role']; 
      }
      else echo 'Такой пользователь не найден';

    }
    else echo 'Некорректный ввод';
  }

?>