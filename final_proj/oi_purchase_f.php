<?php 
session_start();
$link = mysqli_connect("localhost","root","910106","final_proj")or die("無法連接");
mysqli_query($link, 'SET NAMES utf8');
if ( isset($_POST['name'])){
    $name = $_POST['name'];
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
if ($name != "" &&$amount != "" && $p_price != "" && $p_date != "" ){
    $sql = "SELECT * FROM item WHERE name = '{$name}'";
    $result = mysqli_query($link,$sql);
    $total_records = mysqli_num_rows($result);
    if ($total_records=0){
        $_SESSION['message'] = "此品名不存在";
            mysqli_close($link);
            header("Location: index_admin.php");
    }
    $row =  mysqli_fetch_array($result,MYSQLI_NUM);
    $new_stock = $row[3]+$amount;    
    $sql_up = "UPDATE item SET stock = '{$new_stock}'                                           
                        WHERE item_id = '{$row[0]}'";
    mysqli_query($link,$sql_up);
    $sql_ipr = "INSERT INTO purchase_record (p_id,item,amount,purchase_price,p_time)
                VALUES (NULL,'{$row[0]}','{$amount}','{$p_price}','{$p_date}')";

    try{mysqli_query($link,$sql_ipr);            
        $_SESSION['message'] = "已紀錄{$new_stock} {$row[0]}";
        mysqli_close($link);
        header("Location: index_admin.php");

    }catch(Exception ){           
        $_SESSION['message'] = "失敗";
        mysqli_close($link);
        header("Location: index_admin.php");
        }
}
    

?>