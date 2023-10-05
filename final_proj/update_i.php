<?php
session_start();
if ( isset($_POST['stock'])){
    $stock = $_POST['stock'];
}
if ( isset($_POST['price'])){
    $price = $_POST['price'];
}
$link = mysqli_connect("localhost","root","910106","final_proj")or die("無法連接");
mysqli_query($link, 'SET NAMES utf8');
if ($stock != "" && $price != "" && isset($_GET['id'])){
        $sql_update = "UPDATE item SET stock = '{$stock}',
                                        price = '{$price}' WHERE item_id = '{$_GET['id']}'";
        try{mysqli_query($link,$sql_update);            
            $_SESSION['message'] = "已變更商品庫存或價格";
            mysqli_close($link);
            header("Location: index_admin.php");

        }catch(Exception ){           
            $_SESSION['message'] = "變更失敗";
            mysqli_close($link);
            header("Location: index_admin.php");
        }
    }
    