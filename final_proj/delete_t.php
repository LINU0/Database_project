<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>
<body>
<?php 
session_start();
if (isset($_SESSION['message'])) {
    echo "<script>
            alert('" .$_SESSION['message']."')
          </script>";
    unset($_SESSION['message']);
}
if($_SESSION['login_session'] == false || isset($_SESSION['login_session']) == false){
    $_SESSION['message'] = "請先登入";
    header("Location: login.php");
}
?>
<nav class="navbar navbar-default">
        <div class="container-floid">
            <div class="navbar-header">
                <div class="navbar-brand">
                    存貨管理
                </div>
            </div>
            <ul class="nav navbar-nav">
                <li ><a href="index_admin.php">庫存檢視</a></li>
                <li ><a href="ni_purchase.php">新商品進貨紀錄</a></li>
                <li ><a href="oi_purchase.php">已有商品進貨紀錄</a></li>
                <li ><a href="order_admin.php">訂單管理</a></li>
                <li ><a href="logout.php">登出</a></li>
                
            </ul> 
        </div>
</nav>
<div class="container" align="center">
                <h1 class="textcolor" align="center">刪除類別</h1>
                <form align="center" action="" method="POST">
                    <div class="form-group" >
                        <label for="name">類別名稱</label>
                        <input type="text" class="form-control" id="type" name="type" placeholder="無任何商品屬於該類別才可刪除">
                        <button type="submit" class="btn btn-primary btn-block" name="delete_t" value="刪除">刪除</button>
                        
                </form>
</div>

</body>
</html>
<?php
$type="";
$link = mysqli_connect("localhost","root","910106","final_proj")or die("無法連接");
mysqli_query($link, 'SET NAMES utf8');
if ( isset($_POST['type'])){
    $type = $_POST['type'];
}

if ($type != ""){
    $sql = "SELECT type FROM type WHERE type = '{$type}'";
    $result = mysqli_query($link,$sql);
    $total_records = mysqli_num_rows($result);
    if ( $total_records > 0 ){
        $sql_delete = "DELETE FROM type  WHERE type = '{$type}'";
        try{mysqli_query($link,$sql_delete);            
            $_SESSION['message'] = "已刪除類別";
            mysqli_close($link);
            header("Location: index_admin.php");

        }catch(Exception ){           
            $_SESSION['message'] = "刪除失敗，類別中仍有商品";
            mysqli_close($link);
            header("Location: index_admin.php");
        }
    }else{
        $_SESSION['message'] = "刪除失敗，類別不存在";
            mysqli_close($link);
            header("Location: index_admin.php");
    }    
}else{
    $_SESSION['message'] = "請填寫類別";
}      
?>
