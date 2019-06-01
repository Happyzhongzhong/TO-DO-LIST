<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "userbase";


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // 设置 PDO 错误模式，用于抛出异常
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $username = $_POST['username'];
    $stmt = $conn->prepare("SELECT * FROM user WHERE username = '$username'"); 
    $stmt->execute(); 
    $num = count($stmt->fetchAll());
    if("$_POST[passwordbase]"!="$_POST[confirmpassword]"){
      echo "第二次输入的密码需与第一次相同，请返回重新输入。";
    }
    elseif(!is_numeric( "$_POST[passwordbase]" )){
      echo "密码不符合规范（我们希望您使用全数字的密码)
    ,请返回重新输入。";
    }
    elseif($num){
      echo "您输入的用户名已经存在，请返回重新输入。";
    }
    else{
    $sql = "INSERT INTO user (username,passwordbase)
    VALUES ('$_POST[username]','$_POST[passwordbase]')";
    // 使用 exec() ，没有结果返回 
    $conn->exec($sql);
    echo "账号创建成功，欢迎加入YourList！！！";
    }
}
catch(PDOException $e)
{
    echo "Error:" . "<br>" . $e->getMessage();
}
 
$conn = null;
?>