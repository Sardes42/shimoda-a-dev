<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login'])==false)
{
	print 'ようこそゲスト様　';
	print '<a href="member_login.html">会員ログイン</a><br />';
	print '<br />';
}
else
{
	print 'ようこそ';
	print $_SESSION['member_name'];
	print ' 様　';
	print '<a href="member_logout.php">ログアウト</a><br />';
	print '<br />';
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>レビュー登録</title>
</head>
<body>

<?php	$pro_code=$_GET['procode']?>

レビュー入力<br />
<br />
<?php print '<form method="post" action="shop_check.php?procode='.$pro_code.'">';?>
名前を入力してください。<br />
<input type="text" name="name" style="width:100px"><br />
評価点を入力してください。<br />
<input type="text" name="score" style="width:30px"><br />
コメントを入力してください。<br />
<textarea name="comment" rows="4" cols="40"wrap="soft">
</textarea>
<br />
<br />
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="ＯＫ">
</form>

</body>
</html>