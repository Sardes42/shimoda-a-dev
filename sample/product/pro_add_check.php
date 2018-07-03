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

$post=sanitize($_POST);
$pro_name=$post['name'];
$pro_price=$post['price'];
$pro_gazou=$_FILES['gazou'];
$pro_santi=$post['santi'];
$pro_meigara=$post['meigara'];
$pro_nedan=$post['nedan'];

if($pro_name=='')
{
	print '商品名が入力されていません。<br />';
}
else
{
	print '商品名:';
	print $pro_name;
	print '<br />';
}

if(preg_match('/^[0-9]+$/',$pro_price)==0)
{
	print '価格をきちんと入力してください。<br />';
}
else
{
	print '価格:';
	print $pro_price;
	print '円<br />';
}

if($pro_gazou['size']>0)
{
	if($pro_gazou['size']>1000000)
	{
		print '画像が大き過ぎます';
	}
	else
	{
		move_uploaded_file($pro_gazou['tmp_name'],'./gazou/'.$pro_gazou['name']);
		print '<img src="./gazou/'.$pro_gazou['name'].'">';
		print '<br />';
	}
}

 if($pro_santi=='')
{
	print '産地が選択されていません。<br />';
}
else
{
	print '産地:';
	print $pro_santi;
	print '<br />';
}

if($pro_meigara=='')
{
	print '銘柄が選択されていません。<br />';
}
else
{
	print '銘柄:';
	print $pro_meigara;
	print '<br />';
}

if($pro_nedan=='')
{
	print '値段が選択されていません。<br />';
}
else
{
	print '値段:';
	print $pro_nedan;
	print '<br />';
}
if($pro_name=='' || preg_match('/^[0-9]+$/',$pro_price)==0 || $pro_gazou['size']>1000000
   || $pro_santi=='' || $pro_meigara=='' || $pro_nedan=='')
{
	print '<form>';
	print '<input type="button" onclick="history.back()" value="戻る">';
	print '</form>';
}
else
{
	print '上記の商品を追加します。<br />';
	print '<form method="post" action="pro_add_done.php">';
	print '<input type="hidden" name="name" value="'.$pro_name.'">';
	print '<input type="hidden" name="price" value="'.$pro_price.'">';
	print '<input type="hidden" name="gazou_name" value="'.$pro_gazou['name'] .'">';
	print '<input type="hidden" name="santi" value="'.$pro_santi.'">';
	print '<input type="hidden" name="meigara" value="'.$pro_meigara.'">';
	print '<input type="hidden" name="nedan" value="'.$pro_nedan.'">';
	print '<br />';
	print '<input type="button" onclick="history.back()" value="戻る">';
	print '<input type="submit" value="ＯＫ">';
	print '</form>';
}

?>
</body>
</html>