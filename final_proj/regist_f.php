<?php
session_start();
$name="";
$email="";
$password="";
$identity="";
$link = mysqli_connect("localhost","root","910106","final_proj")or die("無法連接");
mysqli_query($link, 'SET NAMES utf8');
if ( isset($_POST['name'])){
    $name = $_POST['name'];
}
if ( isset($_POST['email'])){
    $email = $_POST['email'];
}
if ( isset($_POST['password'])){
    $password = $_POST['password'];
}
if ( isset($_POST['identity'])){
    $sql_identity = "SELECT i_id FROM identity WHERE identities = '{$_POST['identity']}'";
    $result_i = mysqli_query($link,$sql_identity);
    $row_i = mysqli_fetch_array($result_i,MYSQLI_NUM);
    $identity = $row_i[0];
}

if ($name != "" && $email != "" && $password != "" && $identity != ""){
    $sql = "SELECT identity FROM account WHERE name = '{$name}' ";
    $result = mysqli_query($link,$sql);
    $total_records = mysqli_num_rows($result);
    if ( $total_records > 0 ){
        $_SESSION['message'] = "相同姓名已註冊";
        mysqli_close($link);
        header("Location: login.php");
    }else{
        $sql_insert = "INSERT INTO `account` (`id`,`name`,`email`,`password`,`identity`) VALUES (Null,'$name','$email','$password',$identity)";
        if (mysqli_query($link,$sql_insert)) {           
            $_SESSION['message'] = "註冊成功，重新登入";
            mysqli_close($link);
            header("Location: login.php");
            
        }
        else {
            $_SESSION['message'] = "發生問題，註冊失敗";
            mysqli_close($link);
            header("Location: regist.php");
        }
    }

    
}else{
    $_SESSION['message'] = "欄位皆須填寫";
    mysqli_close($link);
    header("Location: regist.php");

}
        

?>