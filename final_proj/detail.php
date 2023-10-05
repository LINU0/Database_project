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

if (isset($_GET['id']))
	$ins_t = "WHERE I.item_id= {$_GET['id']}";
else{
	header("Location: index_admin.php");
}
$sql = "SELECT I.item_id,I.name,T.type, I.stock,I.price,PR.purchase_price,PR.amount,`max(P.p_time)`
		FROM item AS I INNER JOIN type AS T 
		 ON I.type = T.t_id
		 	INNER JOIN (SELECT P.item,P.amount,P.purchase_price,max(P.p_time) FROM purchase_record AS P GROUP BY P.item) AS PR  
		 	 ON I.item_id = PR.item {$ins_t}";
$result = mysqli_query($link,$sql);
$total_records = mysqli_num_rows($result);
if ($total_records > 0){ 
	$row =  mysqli_fetch_array($result,MYSQLI_NUM); ?>
		<div class="container" align="center" >
			
				<div class="card" align="center">
  						<ul class="list-group list-group-flush">
    						<li class="list-group-item">商品編號:<?php echo $row[0]; ?></li>
    						<li class="list-group-item">商品名稱:<?php echo $row[1]; ?></li>
    						<li class="list-group-item">商品種類:<?php echo $row[2]; ?></li>
    						<form action="update_i.php?id=<?php echo $row[0]; ?>" method="POST">
  								<li class="list-group-item">庫存數:
  								<input type="number" id="stock" name="stock" value="<?php echo $row[3]; ?>"><input type="submit" value="Submit"></li>
  								<li class="list-group-item">售價:
  								<input type="number" id="price" name="price" value="<?php echo $row[4]; ?>"><input type="submit" value="Submit"></li>
							</form>
    						<li class="list-group-item">上回進貨價(單價):<?php echo $row[5]; ?></li>
    						<li class="list-group-item">上回進貨數:<?php echo $row[6]; ?></li>
    						<li class="list-group-item">上回進貨日期:<?php echo $row[7]; ?></li>
    						<li class="list-group-item"><a href="delete_i.php?id=<?php echo $row[0]; ?>"><span class="glyphicon glyphicon-trash"></span></a></li>
  						</ul>
					</div>
			
		</div>
                   
<?php 
};  
?>
		
	
		<div class = 'panel panel-default'>
			<div class = 'panel-heading'>
				進貨紀錄
			</div>
			<div class = 'panel-body'>
				<table class="table table-striped">
  					
 <?php
$sql_pr= "SELECT * FROM purchase_record WHERE item = {$_GET['id']} ORDER BY p_time DESC";
$result_pr= mysqli_query($link,$sql_pr);
$total_records_pr = mysqli_num_rows($result_pr);
if ($total_records_pr > 0){ ?>
					<thead>
    					<tr>
      						<th scope="col">進貨編號</th>
      						<th scope="col">品名</th>
      						<th scope="col">進貨數</th>      						
      						<th scope="col">進貨價(單價)</th>
      						<th scope="col">進貨日期</th>
      						<th scope="col">編輯</th>
      						<th scope="col">刪除</th>
    					</tr>
  					</thead>
  					<tbody>
<?php while ($row_pr =  mysqli_fetch_array($result_pr,MYSQLI_NUM)){ ?>
                   <tr>
      					<td><?php echo $row_pr[0]; ?></td>
      					<td><?php echo $row[1]; ?></td>
      					<td><?php echo $row_pr[2]; ?></td>
      					<td><?php echo $row_pr[3]; ?></td>
      					<td><?php echo $row_pr[4]; ?></td>
      					<td><a href="update_pr.php?id=<?php echo $row_pr[0]; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
      					<td><a href="delete_pr.php?id=<?php echo $row_pr[0]; ?>"><span class="glyphicon glyphicon-trash"></span></a></td>
    				</tr>  
            
<?php };  
}else{
	echo "無進貨紀錄";
}
?>
  					</tbody>
				</table>
			</div>
			<div class = 'panel-footer'>
				
				累積進貨 <?php echo $total_records_pr ?> 次
			</div>
		</div>
		

</body>
</html>