<?php 
session_start();
$amount="";

if ( isset($_POST['amount']))
	$amount = $_POST['amount'];
if ( isset($_SESSION['order']))
	$order = $_SESSION['order'];


if ($amount != "" && $amount <= $order[3] ){
	$link = mysqli_connect("localhost","root","910106","final_proj")
	or die("無法連接");
	mysqli_query($link,'SET NAMES utf8');
	$tprice = $order[2]*$amount;
	$sql = "INSERT INTO `order_t` (`order_id`,`customer`,`item`,`amount`,`total_price`,`status`,`time`) VALUES (Null,'$order[0]','$order[1]',$amount,$tprice,1,DEFAULT)";
	try{mysqli_query($link,$sql);            
            $_SESSION['message'] = "訂購完成";
            unset($_SESSION['order']);
            mysqli_close($link);
            header("Location: index_c.php");

        }catch(Exception ){           
            $_SESSION['message'] = "失敗";
            unset($_SESSION['order']);
            mysqli_close($link);
            header("Location: index_c.php");
        }
	
}else{
	$_SESSION['message'] = "庫存不足";
	unset($_SESSION['order']);
	header("Location: index_c.php");
}
?>