<?php
//  启动 Session
session_start();
//  声明一个名为 admin 的变量，并赋空值。
$_SESSION["admin"] = null;
?>

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
    $password = $_POST['passwordbase'];
    if($username=='' || $password==''){
        echo "用户名和密码不能为空，请返回重新登陆";
    }
    else{ 
        $posts = $_POST;
        $stmt = $conn->prepare("SELECT * FROM user 
        WHERE username = '$username' and passwordbase = '$password'"); 
        $stmt->execute(); 
        $num = count($stmt->fetchAll());
        if($num){
            //  注册登陆成功的 admin 变量，并赋值 true
            $_SESSION["admin"] = true;
            echo "欢迎回来，每一天都是新的开始。";
        }
        else{
            echo "用户名或密码错误，请返回重新输入";
        }
    }
}
catch(PDOException $e)
{
    echo "Error:" . "<br>" . $e->getMessage();
}
 
$conn = null;
?>