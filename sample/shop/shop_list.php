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
<title>ろくまる農園</title>
</head>
<body>
<?php
require_once('../common/common.php');
?>


<form method="post" action="shop_list.php">
<?php pulldown_santi(); ?>
<?php pulldown_meigara(); ?>
<?php pulldown_nedan(); ?>
<p> 検索キーワードを入力
<input type="search" name="keyword" value=""></p>
<p><input type="submit" value="検索"></p>
</form>

<?php

try
{

require_once('../common/common.php');

$dsn='mysql:dbname=test;host=localhost;charset=utf8';
$user='root';
$password='';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql='SELECT code,name,price,santi,meigara,nedan FROM mst_product WHERE 1';
$stmt=$dbh->prepare($sql);
$stmt->execute();

$dbh=null;

print '商品一覧<br /><br />';



if($sql!==0){
while(true)
{
	$rec=$stmt->fetch(PDO::FETCH_ASSOC);
	if($rec==false)
	{
		break;
	}
	if(isset($_POST['keyword']) && $_POST['keyword'] != '')
{
 $keyword = $_POST['keyword'];
 $santi=$_POST['santi'];
 $meigara=$_POST['meigara'];
 $nedan=$_POST['nedan'];

  if((strpos($rec['name'],$keyword)!==false)
  &&(strpos($rec['santi'],$santi)!==false)
	&&(strpos($rec['meigara'],$meigara)!==false)
	&&(strpos($rec['nedan'],$nedan)!==false))
  {
	print '<a href="shop_product.php?procode='.$rec['code'].'">';
	print $rec['name'].'---';
	print $rec['price'].'円';
	print '</a>';
	print '<br />';
	}
}
  else
  {
	print '<a href="shop_product.php?procode='.$rec['code'].'">';
	print $rec['name'].'---';
	print $rec['price'].'円';
	print '</a>';
	print '<br />';
	}
}
}


print '<br />';
print '<a href="shop_cartlook.php">カートを見る</a><br />';

}
catch (Exception $e)
{
	 print 'ただいま障害により大変ご迷惑をお掛けしております。';
	 exit();
}

?>


</body>
</html>