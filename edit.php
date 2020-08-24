<?php
if (isset($_POST["cancelButton"])) {
    header("location: secret.php");
    exit();
}
if (!isset($_GET["id"])) {
    die("id not found.");
}
$id = $_GET["id"];
if (!is_numeric($id))
    die("id not a number.");

//echo $sql;
require("config.php");
if (isset($_POST["okButton"])) {
    $username = $_POST["username"];
    $password = base64_encode($_POST["password"]);
    $sql = <<<multi
    update user set
       username = '$username',
       password='$password'
    where id = $id
  multi;
    $result = mysqli_query($link, $sql);
    echo "<script> alert('修改完成，請重新登入');location.replace('login.php');</script>";
    //header("location: login.php");

    exit();
} else {
    $sql = <<<multi
    select * from user where id = $id
  multi;
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
}

//var_dump($row);
// header("location: index.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>修改會員資料</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">

        <form method="post">
            <div class="form-group row">
                <label for="username" class="col-4 col-form-label">帳號:</label>
                <div class="col-8">
                    <input id="username" name="username" value="<?= $row["username"] ?>" type="text" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-4 col-form-label">密碼:</label>
                <div class="col-8">
                    <input id="password" name="password" value="<?= base64_decode($row["password"]) ?>" type="text" class="form-control">
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