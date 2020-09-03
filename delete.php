<?php
//引入資料庫配置
require("config.php");

//檢查是否有id
if (!isset($_GET["id"])) {
  die("id not found");
}
$id = $_GET["id"];

//判斷id是否為數字或數字的字串
if (!is_numeric($id))
  die("id not a number.");

//刪除明細
$sql = <<<multi
  delete from detail where uid = $id
multi;
mysqli_query($link, $sql);

//刪除user
$sql = <<<multi
  delete from user where id = $id
multi;
mysqli_query($link, $sql);


echo "<script> alert('刪除成功，將跳回登入頁');location.replace('login.php');</script>";

