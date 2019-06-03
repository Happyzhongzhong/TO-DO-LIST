<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "userbase";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // 设置 PDO 错误模式，用于抛出异常
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $admin = false;
    //  启动会话，这步必不可少
    session_start();
    //  判断是否登陆
    if (isset($_SESSION["admin"]) && $_SESSION["admin"] === true) {
        echo "亲爱的";
        $user = $_SESSION["username"];
        echo $user;
        echo ",";
        $sql = "INSERT INTO list (title,time,frequency,description,username)
        VALUES ('$_POST[title]', '$_POST[time]', '$_POST[frequency]',
        '$_POST[description]','$user')";
        // 使用 exec() ，没有结果返回 
        $conn->exec($sql);
        echo "一个新的日程已经建立，下面就去大胆做吧！";


    } else {
        //  验证失败，将 $_SESSION["admin"] 置为 false
        $_SESSION["admin"] = false;
        die("您无权访问");
    }








    
}
catch(PDOException $e)
{
    echo 'error' . "<br>" . $e->getMessage();
}
 
$conn = null;
?>