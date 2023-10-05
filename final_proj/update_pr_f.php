<?php 
session_start();
$link = mysqli_connect("localhost","root","910106","final_proj")or die("無法連接");
mysqli_query($link, 'SET NAMES utf8');
if ( isset($_POST['amount'])){
    $amount = $_POST['amount'];
}
if ( isset($_POST['p_price'])){
    $p_price = $_POST['p_price'];
}
if ( isset($_POST['date'])){
    $p_date = $_POST['date'];
}
if(isset($_SESSION['stock'])&&isset($_SESSION['old_amount'])&&isset($_SESSION['i_id'])){
    $new_stock = $_SESSION['stock']+$amount-$_SESSION['old_amount'];
    $sql_stock = "UPDATE item SET stock = '{$new_stock}'                                           
                        WHERE item_id = '{$_SESSION['i_id']}'";
    mysqli_query($link,$sql_stock);
    unset($_SESSION['stock']);
    unset($_SESSION['old_amount']);
    unset($_SESSION['i_id']);
}

if ($amount != "" && $p_price != ""&& isset($_GET['id']) ){
        $sql_update = "UPDATE purchase_record SET amount = '{$amount}',
                                           purchase_price = '{$p_price}',
                                           p_time = '{$p_date}'
         				WHERE p_id = '{$_GET['id']}'";
        try{mysqli_query($link,$sql_update);            
            $_SESSION['message'] = "已變更紀錄";
            mysqli_close($link);
            header("Location: index_admin.php");

        }catch(Exception ){           
            $_SESSION['message'] = "變更失敗";
            mysqli_close($link);
            header("Location: index_admin.php");
        }
    }

?>