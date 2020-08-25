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
$sql = <<<multi
    select decash,dcash,cash,date from detail d join user u on d.uid = u.id where uid = 1
  multi;
$result = mysqli_query($link, $sql);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>RD5-明細頁</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>


    <div class="container">
        <h2>線上網銀系統 - 明細</h2>
        <form method="post">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>存款</th>
                        <th>提款</th>
                        <th>目前金額</th>
                        <th>日期</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>

                            <td><?= $row["decash"] ?></td>
                            <td><?= $row["dcash"] ?></td>
                            <td><?= $row["cash"] ?></td>
                            <td><?= $row["date"] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
    </div>
    <div class="form-group row">
        <div class="offset-4 col-8">
            <button name="cancelButton" value="Cancel" type="submit" class="btn btn-secondary">返回</button>
        </div>
        </form>
    </div>
</body>

</html>