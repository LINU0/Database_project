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
if($_SESSION['login_session'] != 1 || isset($_SESSION['login_session']) == false){
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
<?php
$link = mysqli_connect("localhost","root","910106","final_proj")or die("無法連接");
mysqli_query($link, 'SET NAMES utf8');
if (isset($_GET['id'])){
	$id = $_GET['id'];
	$sql = "SELECT  I.name,PR.amount, PR.purchase_price, PR.p_time,I.stock,I.item_id 
			FROM purchase_record AS PR INNER JOIN (SELECT item_id,name,stock FROM item) AS I
				ON PR.item = I.item_id 
			WHERE p_id = '{$id}'";
    $result = mysqli_query($link,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_NUM);
    }
    $_SESSION['i_id'] = $row[5];
    $_SESSION['stock'] = $row[4];
    $_SESSION['old_amount'] = $row[1];
?>




	
        <div class="container" align="center">
                <h1 class="textcolor" align="center">進貨編號:<?php echo $id; ?> 品名:<?php echo $row[0]; ?></h1>
                <form align="center" action="update_pr_f.php?id=<?php echo $id; ?>" method="POST">
                    <div class="form-group">
                        <label for="amount">進貨數</label>
                        <input type="number" class="form-control" id="amount" name="amount" value = "<?php echo $row[1]; ?>" >
                    </div>
                    <div class="form-group">
                        <label for="p_price">進貨價</label>
                        <input type="number" class="form-control" id="p_price" name="p_price" value = "<?php echo $row[2]; ?>" >
                    </div>
                    <div class="form-group">
                        <label for="date">進貨日期</label>
                        <input type="date" class="form-control" id="date" name="date" value = "<?php echo $row[3]; ?>" >
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" name="submit" value="submit">確認修改</button> 
                </form>
           
        </div>

</body>
</html>

