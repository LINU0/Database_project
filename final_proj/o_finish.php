<?php 
session_start();


if ( isset($_GET['id'])){
	$order_id = $_GET['id'];
	$link = mysqli_connect("localhost","root","910106","final_proj")
	or die("無法連接");
	mysqli_query($link,'SET NAMES utf8');
	$sql = "UPDATE order_t SET status = 2                                           
                   WHERE order_id = '{$order_id}'";
    mysqli_query($link,$sql);

    $sql_s = "SELECT O.amount,I.stock,O.item  
    			FROM order_t AS O INNER JOIN (SELECT item_id,stock FROM item) AS I  
    			 ON O.item = I.item_id
    			WHERE O.order_id = '{$order_id}' ";
    $result = mysqli_query($link,$sql_s);
    $row = mysqli_fetch_array($result,MYSQLI_NUM);
    $new_stock = $row[1]-$row[0];
    $sql_stock = "UPDATE item SET stock = '{$new_stock}'                                           
                        WHERE item_id = '{$row[2]}'";
    mysqli_query($link,$sql_stock);
    $_SESSION['message'] = "訂單完成";
    header("Location: order_admin.php");




	
}else{
	$_SESSION['message'] = "失敗";
	header("Location: order_admin.php");
}
?>