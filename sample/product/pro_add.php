<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'])==false)
{
	print 'ログインされていません。<br />';
	print '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
	exit();
}
else
{
	print $_SESSION['staff_name'];
	print 'さんログイン中<br />';
	print '<br />';
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ろくまる農園</title>
</head>
<body>
<?php
require_once('../common/common.php');
?>

商品追加<br />
<br />
<form method="post" action="pro_add_check.php" enctype="multipart/form-data">
商品名を入力してください。<br />
<input type="text" name="name" style="width:200px"><br />
価格を入力してください。<br />
<input type="text" name="price" style="width:50px"><br />
画像を選んでください。<br />
<input type="file" name="gazou" style="width:400px"><br />
プルダウン情報を入力してください。<br/>
産地<?php pulldown_santi(); ?>&nbsp;
 銘柄<?php pulldown_meigara(); ?>&nbsp;
 値段<?php pulldown_nedan(); ?><br/>
 <br />
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="ＯＫ">
</form>

</body>
</html>