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



<div class = 'panel panel-default'>
			<div class = 'panel-heading'>
				訂單紀錄 
			</div>
			<div class = 'panel-body'>
				<table class="table table-striped">
  					
 <?php
 $link = mysqli_connect("localhost","root","910106","final_proj")
	or die("無法連接");
	mysqli_query($link,'SET NAMES utf8');
$sql= "SELECT O.order_id,A.name,A.email,I.name,O.amount,O.total_price,O.time,S.status,I.stock,O.status
		FROM order_t AS O INNER JOIN order_status AS S 
		 ON O.status = S.os_id 
		  INNER JOIN item AS I 
		   ON O.item = I.item_id
		   INNER JOIN (SELECT ID,name,email FROM account) AS A  
		    ON O.customer = A.ID
		 ";
$result= mysqli_query($link,$sql);
$total_records = mysqli_num_rows($result);
if ($total_records > 0){ ?>
					<thead>
    					<tr>
      						<th scope="col">訂單編號</th>
      						<th scope="col">顧客</th>
      						<th scope="col">顧客聯絡方式</th>
      						<th scope="col">商品</th>
      						<th scope="col">數量</th>        						
      						<th scope="col">總價</th>
      						<th scope="col">訂購日期</th>
      						<th scope="col">訂單狀態</th>
      						<th scope="col">完成訂單</th>

      						      						
    					</tr>
  					</thead>
  					<tbody>
<?php while ($row =  mysqli_fetch_array($result,MYSQLI_NUM)){ ?>
                   <tr>
      					<td><?php echo $row[0]; ?></td>
      					<td><?php echo $row[1]; ?></td>
      					<td><?php echo $row[2]; ?></td>
      					<td><?php echo $row[3]; ?></td>
      					<td><?php echo $row[4]; ?></td>
      					<td><?php echo $row[5]; ?></td>
      					<td><?php echo $row[6]; ?></td>
      					<td><?php echo $row[7]; ?></td>
      					<?php if ($row[9] == 1){ ?>
      					<td><a href="o_finish.php?id=<?php echo $row[0]; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
      					<?php } ?>
      					
    				</tr>  
            
<?php };  
}else{
	echo "無紀錄";
}
?>
  					</tbody>
				</table>
			</div>
			<div class = 'panel-footer'>
				
				累積訂單 <?php echo $total_records ?> 筆
			</div>
		</div>

</body>
</html>