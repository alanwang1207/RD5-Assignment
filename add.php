<?php

if (isset($_POST["okButton"])) {
    $userName = $_POST["userName"];
    echo $firstName;
    $passWord = base64_encode($_POST["passWord"]);

    if (trim(($userName && $passWord) != "")) {
        $sql = <<<sqlstate
    insert into user (username,password)
    values('$userName','$passWord')
  sqlstate;
        require_once("config.php");
        mysqli_query($link, $sql);
        echo "<script> alert('加入成功，請重新登入');location.replace('login.php');</script>";
    } else {
        // 使用js語法
        echo '<script language="javascript">';
        echo 'alert("帳號或密碼請輸入完整")';
        echo '</script>';
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <form method="post">
        <div class="form-group row">
            <label for="userName" class="col-4 col-form-label">帳號</label>
            <div class="col-8">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fa fa-address-card"></i>
                        </div>
                    </div>
                    <input id="userName" name="userName" type="text" class="form-control">
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="passWord" class="col-4 col-form-label">密碼</label>
            <div class="col-8">
                <input id="passWord" name="passWord" type="text" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <div class="offset-4 col-8">
                <button name="okButton" type="submit" class="btn btn-primary">確認送出</button>
            </div>
        </div>
    </form>
</body>

</html>