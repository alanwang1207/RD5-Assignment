<?php
$secret = "";
//$sUserName = "";
session_start();
if (isset($_SESSION["userName"])) {
    $sUserName = $_SESSION["userName"];
}
if (!isset($_SESSION["userName"])) {
    $sUserName = $_SESSION["userName"];
    $secret = "secret.php";
    $_SESSION["lastPage"] = $secret;
    header("Location: login.php");
    exit();
}
require_once("config.php");
$commandText = <<<SqlQuery
select id,username,password,email from user where username='$sUserName';
SqlQuery;

$result = mysqli_query($link, $commandText);
// var_dump($result);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RD5 - 會員頁</title>
</head>

<body>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="container">
            <h2>線上網銀系統 - 會員中心</h2>
            <p>This page for member only.</p>
            <span>
                <a href="index.php" class="btn btn-outline-primary">回首頁</a>
                <a href="./editmember.php?id=<?= $row["id"] ?>" class="btn btn-outline-success">修改會員資料</a>
                <a href="./delete.php?id=<?= $row["id"] ?>" class="btn btn-outline-danger">刪除會員</a>
            </span>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>會員編號</th>
                        <th>帳號</th>
                        <th>密碼</th>
                        <th>信箱</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= $row["id"] ?></td>
                        <td><?= $row["username"] ?></td>
                        <td><?= base64_decode($row["password"]) ?></td>
                        <td><?= $row["email"] ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php } ?>
</body>

</html>