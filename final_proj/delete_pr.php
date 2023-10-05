<?php
session_start();
$link = mysqli_connect("localhost","root","910106","final_proj")or die("無法連接");
mysqli_query($link, 'SET NAMES utf8');
if(isset($_GET['id'])){
    $sql = "SELECT I.stock, PR.amount,PR.item
            FROM item AS I INNER JOIN (SELECT p_id,item,amount FROM purchase_record ) AS PR
            ON I.item_id = PR.item
            WHERE PR.p_id = '{$_GET['id']}'";
    $result=mysqli_query($link,$sql);
    $row =  mysqli_fetch_array($result,MYSQLI_NUM);
    $_SESSION['stock'] = $row[0];
    $_SESSION['old_amount'] = $row[1];
}


if(isset($_SESSION['stock'])&&isset($_SESSION['old_amount'])&&isset($row[2])){
    $new_stock = $_SESSION['stock']-$_SESSION['old_amount'];
    $sql_stock = "UPDATE item SET stock = '{$new_stock}'                                           
                        WHERE item_id = '{$row[2]}'";
    mysqli_query($link,$sql_stock);
    unset($_SESSION['stock']);
    unset($_SESSION['old_amount']);
    
}
if (isset($_GET['id'])){
        $sql_delete = "DELETE FROM purchase_record  WHERE p_id = '{$_GET['id']}'";
        try{mysqli_query($link,$sql_delete);            
            $_SESSION['message'] = "已刪除該紀錄";
            mysqli_close($link);
            header("Location: index_admin.php");

        }catch(Exception ){           
            $_SESSION['message'] = "刪除失敗";
            mysqli_close($link);
            header("Location: index_admin.php");
        }
    }
    