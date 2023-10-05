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
if($_SESSION['login_session'] == 1 || isset($_SESSION['login_session']) == false){
	$_SESSION['message'] = "請先登入";
    header("Location: login.php");
}
?>
<nav class="navbar navbar-default">
		<div class="container-floid">
			<div class="navbar-header">
				<div class="navbar-brand">
					STORE
				</div>
			</div>
			<ul class="nav navbar-nav">
				<li ><a href="index_c.php">商品</a></li>
				<li ><a href="order_c.php">訂單記錄</a></li>
				<li ><a href="logout.php">登出</a></li>
				
			</ul> 
		</div>
</nav>



<div class = 'container-fluid'>
	<div class = 'row'>
		<div class = 'col-xs-2 col-md-3'>
			<div class = 'panel panel-default'>
				<div class="panel-heading">
					物品種類	
				</div>
				<div class="panel-body">
					<div class="list-group">
						<a href="index_c.php" class="list-group-item">所有物品</a>
<?php 
$link = mysqli_connect("localhost","root","910106","final_proj")or die("無法連接");
mysqli_query($link, 'SET NAMES utf8');
$sql_t = "SELECT * FROM type";
$result_t= mysqli_query($link,$sql_t);
while ($row =  mysqli_fetch_array($result_t,MYSQLI_NUM)){ ?>
                   		<a href="index_c.php?type=<?php echo $row[0]; ?>" class="list-group-item"><?php echo $row[1]; ?></a>            
<?php }; ?>
						
					</div>
				</div>
			</div>
		</div>
	

	<div class = 'col-xs-10 col-md-9'>
		<div class = 'panel panel-default'>
			<div class = 'panel-heading'>
				庫存數
			</div>
			<div class = 'panel-body'>
				<table class="table table-striped">
  					
 <?php
// 取得要顯示的類別參數
if (isset($_GET['type']))
	$ins_t = "WHERE I.type= {$_GET['type']}";
else{
	$ins_t = "";
}
$sql = "SELECT I.name,T.type, I.price,I.stock,I.item_id
		FROM item AS I INNER JOIN type AS T 
		 ON I.type = T.t_id
		 {$ins_t}";
$result = mysqli_query($link,$sql);
$total_records = mysqli_num_rows($result);
if ($total_records > 0){ ?>
					<thead>
    					<tr>
      						<th scope="col">商品名稱</th>
      						<th scope="col">商品種類</th>
      						<th scope="col">售價</th>
      						<th scope="col">剩餘庫存</th>       						
      						<th scope="col">下訂</th>
    					</tr>
  					</thead>
  					<tbody>
<?php while ($row =  mysqli_fetch_array($result,MYSQLI_NUM)){ 
		if($row[2] != Null){?>
			<tr>
      					<td><?php echo $row[0]; ?></td>
      					<td><?php echo $row[1]; ?></td>
      					<td><?php echo $row[2]; ?></td>
      					<td><?php echo $row[3]; ?></td>
      					<td><a href="buy.php?id=<?php echo $row[4]; ?>"><span class="glyphicon glyphicon-shopping-cart"></span></a></td>
      					
    		</tr>  
			
                   
            
<?php } };  
}else{
	echo "無此類型商品";
}
?>
  					</tbody>
				</table>
			</div>
			<div class = 'panel-footer'>
				
				共 <?php echo $total_records ?> 樣商品
			</div>
		</div>
	</div>	
</div>
</div>

</body>
</html>