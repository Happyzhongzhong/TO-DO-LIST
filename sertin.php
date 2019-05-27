<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "userbase";
 
// 创建连接
$conn = mysqli_connect($servername, $username, $password, $dbname);
// 检测连接
if (!$conn) {
    die("连接失败: " . mysqli_connect_error());
}
mysql_select_db("userbase", $con);//打开数据库
$sql="INSERT INTO MyGuests (username, passwordbase)
VALUES
('$_POST[username]','$_POST[passwordbase])";//插入数据
if (!mysql_query($sql,$con)){
  die('Error: ' . mysql_error());
}
echo "1 record added";
mysql_close($con);
?>