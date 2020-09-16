<?php
session_start();

//檢查是否有session
if (isset($_SESSION["userName"])) {
  $sUserName = $_SESSION["userName"];
}
if (!isset($_SESSION["userName"])) {
  header("Location: login.php");
  exit();
}

//引入資料庫配置
require_once("config.php");


$commandText = <<<SqlQuery
  select id,username,password,cash from user where username='$sUserName';
SqlQuery;
$result = mysqli_query($link, $commandText);

?>
<style>
  .main
{
  display:block;font-size:0;line-height:0;text-indent:-9999px;
}
</style>
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
  <title>RD5 - 戶頭頁</title>
</head>
<!-- 顯示提示字特效 -->
<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
<body>
  <form method="post">
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
      <div class="container">
        <h2>線上網銀系統 - 戶頭管理</h2>
        <p>This page for member only.</p>
        <span>
          <a href="index.php" class="btn btn-outline-primary">回首頁</a>
          <a href="./deposit.php?id=<?= $row["id"] ?>" class="btn btn-outline-info">存款</a>
          <a href="./draw.php?id=<?= $row["id"] ?>" class="btn btn-outline-info">提款</a>
          <a href="./transfer.php?id=<?= $row["id"] ?>" class="btn btn-outline-info">轉帳</a>
          <a href="./detail.php?id=<?= $row["id"] ?>" class="btn btn-outline-secondary">查詢明細</a>
          <input class="btn btn-outline-dark" type="button" value="*" onclick="HideCash(2)" data-toggle="tooltip" title="屏蔽餘額">
        </span>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>會員編號</th>
              <th>帳號</th>
              <th class="hide">金額</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><?= $row["id"] ?></td>
              <td><?= $row["username"] ?></td>
              <td class="hide"><?= $row["cash"] ?></td>
            </tr>
          </tbody>
        </table>
      </div>
    <?php } ?>
    <script language="javascript">
      $("input").click(function() {
        $(".hide").toggleClass("main");
      });
    </script>
  </form>
</body>

</html>