<?php 
session_start();
$link = mysqli_connect("localhost","root","910106","final_proj")or die("無法連接");
mysqli_query($link, 'SET NAMES utf8');
if ( isset($_POST['name'])){
    $name = $_POST['name'];
}
if ( isset($_POST['type'])){
    $type = $_POST['type'];
}
if ( isset($_POST['amount'])){
    $amount = $_POST['amount'];
}
if ( isset($_POST['p_price'])){
    $p_price = $_POST['p_price'];
}
if ( isset($_POST['date'])){
    $p_date = $_POST['date'];
}
if ($name != "" &&$type != "" &&$amount != "" && $p_price != "" && $p_date != "" ){
    $sql = "SELECT * FROM item WHERE name = '{$name}'";
    $result = mysqli_query($link,$sql);
    $total_records = mysqli_num_rows($result);
    if ($total_records>0){
        $_SESSION['message'] = "此品名已存在";
            mysqli_close($link);
            header("Location: index_admin.php");
    }
    $sql_ins = "INSERT INTO item (item_id,name,type,stock,price)
                VALUES (NULL,'{$name}','{$type}','{$amount}',NULL)";
    mysqli_query($link,$sql_ins);
    $sql2 = "SELECT * FROM item WHERE name = '{$name}'";
    $result2 = mysqli_query($link,$sql2);
    $row =  mysqli_fetch_array($result2,MYSQLI_NUM);
    $sql_ipr = "INSERT INTO purchase_record (p_id,item,amount,purchase_price,p_time)
                VALUES (NULL,'{$row[0]}','{$amount}','{$p_price}','{$p_date}')";

    try{mysqli_query($link,$sql_ipr);            
        $_SESSION['message'] = "已紀錄";
        mysqli_close($link);
        header("Location: index_admin.php");

    }catch(Exception ){           
        $_SESSION['message'] = "失敗";
        mysqli_close($link);
        header("Location: index_admin.php");
        }
}
    

?>