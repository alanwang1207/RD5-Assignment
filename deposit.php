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
    $cash = (int)$_POST["cash"];
    $decash = (int)$_POST["decash"];
    if ($decash > 0) {
        $total = $cash + $decash;
        $sql = <<<multi
    update user set
       cash = '$total'
    where id = $id
    multi;
        $result = mysqli_query($link, $sql);

        $sql = <<<multi
        insert into detail (uid,decash,dcash,cash,date )
        values
        ($id,$decash,0,$total,current_timestamp() )
      multi;
        $result = mysqli_query($link, $sql);
        echo "<script> alert('存款完成，將跳回會員頁');location.replace('secret.php');</script>";
        //header("location: login.php");

        exit();
    }else{
        echo "<script> alert('金額輸入錯誤');location.replace('deposit.php?id=$id');</script>";
    }
    // var_dump($decash);


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
                <label for="decash" class="col-4 col-form-label">存放金額:</label>
                <div class="col-8">
                    <input id="decash" name="decash" value="<?= $row["decash"] ?>" type="text" class="form-control">
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