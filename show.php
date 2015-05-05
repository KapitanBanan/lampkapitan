<?php
session_start();
$_SESSION['name'];
$_SESSION['role'];
?>
<html>
<head>
 <title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
    if($_SESSION['role']=='admin')
	{

	$connect = mysql_connect("localhost","root","") or die(mysql_error());
	mysql_select_db("sqlshop");
	$result = mysql_query("SELECT * FROM orders");
    echo '<table border>
    <tr>
    	<td>Номер</td>
    	<td>Получатель</td>
    	<td>Товар</td>
    	<td>Кол-во</td>
    	<td>Комментарий от заказчика</td>
    </tr>';
	
	while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) 
	{
    	echo "\t<tr>\n";
    	foreach ($line as $col_value) 
    	{
        	echo "\t\t<td>$col_value</td>\n";
    	}
    	echo "\t</tr>\n";
	}
	echo "</table>\n";
	mysql_free_result($result);
	}
?>
</body>
</html>
