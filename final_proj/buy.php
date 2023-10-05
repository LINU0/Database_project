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

<?php 
if (isset($_GET['id']))
	$id = "{$_GET['id']}";
$link = mysqli_connect("localhost","root","910106","final_proj")or die("無法連接");
mysqli_query($link, 'SET NAMES utf8');
$sql = "SELECT * FROM item WHERE item_id = $id";
$result = mysqli_query($link,$sql);
$row =  mysqli_fetch_array($result,MYSQLI_NUM);
if (isset($_SESSION['user_id']))
	$uid = "{$_SESSION['user_id']}";
$sql_u = "SELECT name,email,ID FROM account WHERE ID = $uid";
$result_u = mysqli_query($link,$sql_u);
$row_u =  mysqli_fetch_array($result_u,MYSQLI_NUM);
$_SESSION['order'] = [$row_u[2],$id,$row[4],$row[3]];
            
mysqli_close($link);?>

<div class="container" align="center">
            
                <h1 class="textcolor" align="center">訂單</h1>
                <h1 class="textcolor" align="center">顧客:<?php echo $row_u[0]; ?></h1>
                <h1 class="textcolor" align="center">商品:<?php echo $row[1]; ?></h1>
                <form align="center" action="buy_f.php" method="POST">
                    <div class="form-group">
                        <label for="amount">數量:</label>
                        <input type="number" class="form-control" id="amount" name="amount" placeholder="(超過庫存可能無法下訂)">
                    </div>
                  
                    
                    <button type="submit" class="btn btn-primary btn-block" name="order">下訂</button> 
                </form>
            
        </div>



</body>
</html>