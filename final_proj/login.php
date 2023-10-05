<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>登入介面</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

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
?>
	
        <div class="container" align="center">
            <div class="col-xs-6 col-md-4 " >
                <h1 class="textcolor" align="center">登入</h1>
                <form align="center" action="login.php" method="POST">             
                        <input type="text" class="form-control" id="name" name="name" placeholder="請輸入帳號"/>
                        <!-- 輸入密碼 -->                   
                        <input type="password" class="form-control" id="password" name="password" placeholder="請輸入密碼"/>   <br/>

                    <button type="submit" class="btn btn-success btn-block" name="submit" value="登入">登入</button>
                    <br/>
                    <a class="btn btn-primary btn-block" href="regist.php" role="button">註冊</a>                   
                </form>
            </div>
        </div>
    
</body>
</html>
<?php 
$name="";
$password="";
if ( isset($_POST['name']))
	$name = $_POST['name'];
if ( isset($_POST['password']))
	$password = $_POST['password'];
if ($name != "" && $password != ""){
	$link = mysqli_connect("localhost","root","910106","final_proj")
	or die("無法連接");
	mysqli_query($link,'SET NAMES utf8');
	$sql = "SELECT identity,ID FROM account WHERE name = '{$name}' AND password = '{$password}'";
	$result = mysqli_query($link,$sql);
	$total_records = mysqli_num_rows($result);
	$row = mysqli_fetch_row($result);
	if ($total_records > 0){
		$_SESSION['login_session'] = $row[0];
		$_SESSION['user_id'] = $row[1];
		$_SESSION['message'] = "歡迎$name";
		if ($_SESSION['login_session'] == 1)
			header("Location: index_admin.php");
		else
			header("Location: index_c.php");		
	}
	else{		
		$_SESSION['message'] = "名稱或密碼錯誤";
		$_SESSION['login_session'] = false;
	}
	mysqli_close($link);
}else{
	$_SESSION['message'] = "請填入名稱或密碼";
}



