<?php
session_start();
$sUserName = "";

if (isset($_SESSION["userName"])) {
    $sUserName = $_SESSION["userName"];
} else {
    $sUserName = "Guest";
}
if (isset($_POST["member"])) {
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>RD5 - 首頁</title>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>線上網銀系統 - 首頁</h2>
        <p><td align="center" bgcolor="#CCCCCC"><?php echo "Hello~ " . $sUserName ?> </td></p>
            
        <span>
            
                <td>
                <a href="secret.php" id="member" type="submit" class="btn btn-outline-info">戶頭管理</a>
                <a href="member.php" id="member" type="submit" class="btn btn-outline-primary">會員中心</a>

                </td>
                <?php if ($sUserName == "Guest") : ?>
                <a href="login.php" class="btn btn-outline-success btn-md">登入</a>
            <?php else : ?>
                <a href="login.php?logout=1" class="btn btn-outline-secondary btn-md">登出</a>
            <?php endif; ?>

        </span>

        
        <img src="dog.png" class="rounded-circle img-thumbnail mx-auto d-block" alt="Cinque Terre" style="width:20%">
        </table>


</body>

</html>