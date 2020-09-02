<?php
//按下取消返回秘密頁
if (isset($_POST["cancelButton"])) {
    header("location: secret.php");
    exit();
}

//不存在id印出找不到
if (!isset($_GET["id"])) {
    die("id not found.");
}
$id = $_GET["id"];

//判斷變數是否為數字或數字的字串
if (!is_numeric($id))
    die("id not a number.");

//引入資料庫配置
require("config.php");

//按下送出取得表單內容
if (isset($_POST["okButton"])) {
    $username = $_POST["username"];
    $password = base64_encode($_POST["password"]);
    $email = $_POST["email"];

    //驗證帳號名稱是否使用
    $sql = <<<sqlstate
    select username from user where username = '$username';
  sqlstate;
    $result = mysqli_query($link, $sql);
    $count = mysqli_num_rows($result);
    if ($count > 0) {

        echo "<script> alert('帳號名稱已被使用，請重新輸入');location.replace('member.php');</script>";
    } else {
        $sql = <<<multi
        update user set
           username = '$username',
           password='$password',
           email='$email'
        where id = $id
      multi;
        $result = mysqli_query($link, $sql);
        echo "<script> alert('修改完成，請重新登入');location.replace('login.php');</script>";
        exit();
    }
} else {
    $sql = <<<multi
    select * from user where id = $id
  multi;
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>RD5 - 修改會員頁</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>線上網銀系統 - 修改會員資料</h2>
        <form method="post">
            <div class="form-group row">
                <label for="username" class="col-4 col-form-label">帳號:</label>
                <div class="col-8">
                    <input pattern="^[A-Za-z0-9]+$" id="username" name="username" value="<?= $row["username"] ?>" type="text" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-4 col-form-label">密碼:</label>
                <div class="col-8">
                    <input pattern="^[A-Za-z0-9]+$" id="password" name="password" value="<?= base64_decode($row["password"]) ?>" type="text" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-4 col-form-label">信箱:</label>
                <div class="col-8">
                    <input pattern="^\w+[-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$" id="email" name="email" value="<?= $row["email"] ?>" type="text" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-4 col-8">
                    <button name="okButton" value="OK" type="submit" class="btn btn-primary">確認修改</button>
                    <button name="cancelButton" value="Cancel" type="submit" class="btn btn-secondary">取消修改</button>
                </div>
            </div>
        </form>

    </div>

</body>

</html>