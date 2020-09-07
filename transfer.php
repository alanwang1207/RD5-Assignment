<?php

//按下取消
if (isset($_POST["cancelButton"])) {
    header("location: secret.php");
    exit();
}

//檢查id
if (!isset($_GET["id"])) {
    die("id not found.");
}
$id = $_GET["id"];
if (!is_numeric($id))
    die("id not a number.");

//引入資料庫配置
require("config.php");

//按下ok
if (isset($_POST["okButton"])) {
    $cash = (int)$_POST["cash"];
    $tcash = (int)$_POST["tcash"];
    $muser = $_POST["muser"];
    $total = $cash - $tcash;

    //檢查是否有此人
    $sql = <<<multi
    select * from user where username = '$muser'
    multi;
    $result = mysqli_query($link, $sql);
    $count = mysqli_num_rows($result);
    if ($count > 0) {
        //更新匯款人
        $sql = <<<multi
    update user set
       cash = '$total'
    where id = '$id'
    multi;
        $result = mysqli_query($link, $sql);

        //更新被匯款人
        $sql = <<<multi
    update user set
       cash = cash + $tcash
    where username = '$muser'
    multi;
        $result = mysqli_query($link, $sql);


        //建立匯款人明細
        $sql = <<<multi
        insert into detail (uid,decash,dcash,cash,date )
        values
        ($id,0,$tcash,$total,current_timestamp() )
      multi;
        $result = mysqli_query($link, $sql);

        //查詢被匯款人資料做比較
        $sql = <<<multi
    select id,cash from user where username = '$muser'
    multi;
        $result = mysqli_query($link, $sql);
        $row = mysqli_fetch_assoc($result);
        $mid = $row["id"];
        $total = $row["cash"];

        //建立被匯款人明細
        $sql = <<<multi
        insert into detail (uid,decash,dcash,cash,date )
        values
        ($mid,$tcash,0,$total,current_timestamp() )
      multi;
        $result = mysqli_query($link, $sql);
        echo "<script> alert('匯款完成，將跳回會員頁');location.replace('secret.php');</script>";
        exit();
    } else {
        echo "<script> alert('查無此人，將跳回會員頁');location.replace('secret.php');</script>";
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
    <title>RD5-存款頁</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>線上網銀系統 - 存款</h2>
        <form method="post">
            <div class="form-group row">
                <label for="cash" class="col-4 col-form-label">目前餘額:</label>
                <div class="col-8">
                    <input id="cash" name="cash" value="<?= $row["cash"] ?>" type="text" class="form-control" readonly unselectable="on">
                </div>
            </div>
            <div class="form-group row">
                <label for="tcash" class="col-4 col-form-label">轉帳金額:</label>
                <div class="col-8">
                    <input pattern="^\+?[1-9][0-9]*$" id="tcash" name="tcash" value="<?= $row["tcash"] ?>" type="text" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="muser" class="col-4 col-form-label">匯款帳號:</label>
                <div class="col-8">
                    <input id="muser" name="muser" value="<?= $row["muser"] ?>" type="text" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-4 col-8">
                    <button name="okButton" value="OK" type="submit" class="btn btn-primary">確認</button>
                    <button name="cancelButton" value="Cancel" type="submit" class="btn btn-secondary">取消</button>
                </div>
            </div>
        </form>

    </div>

</body>

</html>