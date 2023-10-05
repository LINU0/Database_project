<?php
session_start();
$link = mysqli_connect("localhost","root","910106","final_proj")or die("無法連接");
mysqli_query($link, 'SET NAMES utf8');
if (isset($_GET['id'])){
        $sql_delete = "DELETE FROM item  WHERE item_id = '{$_GET['id']}'";
        try{mysqli_query($link,$sql_delete);            
            $_SESSION['message'] = "已刪除商品";
            mysqli_close($link);
            header("Location: index_admin.php");

        }catch(Exception ){           
            $_SESSION['message'] = "刪除失敗";
            mysqli_close($link);
            header("Location: index_admin.php");
        }
    }
    
