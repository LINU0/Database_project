<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>註冊介面</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

</head>
<body>
<?php 
session_start();
if (isset($_SESSION['message'])) {
    echo "<script>alert('". $_SESSION['message']."')</script>";

   
}
?>
	
        <div class="container" align="center">
            <div class="col-xs-6 col-md-4 " >
                <h1 class="textcolor" align="center">新顧客</h1>
                <form align="center" action="regist_f.php" method="POST">
                    <div class="form-group">
                        <label for="name">使用者姓名</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="yourname">
                    </div>
                    <div class="form-group">
                        <label for="email">聯絡信箱</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">密碼</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="form-group">
                        <label for="identity">身分</label>
                        <select class="form-control" id="identity" name="identity">
                             
<?php 
$link = mysqli_connect("localhost","root","910106","final_proj")or die("無法連接");
mysqli_query($link, 'SET NAMES utf8');
$sql = "SELECT identities FROM identity";
$result = mysqli_query($link,$sql);
while ($row =  mysqli_fetch_array($result,MYSQLI_NUM)){ ?>
                   <option><?php print($row[0]); ?></option>  
            
<?php }; 
mysqli_close($link);?>


                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" name="regist" value="註冊">註冊</button> 
                </form>
            </div>
        </div>
    

</body>
</html>

