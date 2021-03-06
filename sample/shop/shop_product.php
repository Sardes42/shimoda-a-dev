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
	print '様　';
	print '<a href="member_logout.php">ログアウト</a><br />';
	print '<br />';
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>商品情報</title>
</head>
<body>

<?php
require_once('../common/common.php');
try
{

$pro_code=$_GET['procode'];

if (DEBUG) {
	$dsn='mysql:dbname=shop;host=localhost;charset=utf8';
	$user='root';
	$password='';
	$dbh=new PDO($dsn,$user,$password);
	$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	}
	else{
	$dbServer = '127.0.0.1';
	$dbUser = $_SERVER['MYSQL_USER'];
	$dbPass = $_SERVER['MYSQL_PASSWORD'];
	$dbName = $_SERVER['MYSQL_DB'];
	$dsn = "mysql:host={$dbServer};dbname={$dbName};charset=utf8";
	$dbh = new PDO($dsn, $dbUser, $dbPass);
	}

$sql='SELECT name,price,gazou,syousai FROM mst_product WHERE code=?';
$stmt=$dbh->prepare($sql);
$data[]=$pro_code;
$stmt->execute($data);

$sql2='SELECT name,score,comment FROM dat_review WHERE code=?';
$stmt2=$dbh->prepare($sql2);
$stmt2->execute($data);

$rec=$stmt->fetch(PDO::FETCH_ASSOC);
$pro_name=$rec['name'];
$pro_price=$rec['price'];
$pro_gazou_name=$rec['gazou'];
$pro_syousai=$rec['syousai'];

$dbh=null;

if($pro_gazou_name=='')
{
	$disp_gazou='';
}
else
{
	$disp_gazou='<img src="../product/gazou/'.$pro_gazou_name.'">';
}
print '<a href="shop_cartin.php?procode='.$pro_code.'">カートに入れる</a><br /><br />';

}
catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>

商品情報参照<br />
<br />
商品コード<br />
<?php print $pro_code; ?>
<br />
商品名<br />
<?php print $pro_name; ?>
<br />
価格<br />
<?php print $pro_price; ?>円
<br />
<?php print $disp_gazou; ?>
<br />
詳細説明<br />
<?php print $pro_syousai; ?>
<br ?>
<?php print '<a href="shop_add.php?procode='.$pro_code.'">レビューを入力する</a>' ?>
<br />
レビュー一覧<br/>
<?php
while(true)
{
	$rec2=$stmt2->fetch(PDO::FETCH_ASSOC);
	if($rec2==false)
{
	break;
}
print '●';
	print $rec2['name'].'---';
	print $rec2['score'].'点<br/>';
	print $rec2['comment'].'<br/>';
	print '<br />';
}
?>
<form>
<a href="shop_list.php">商品一覧に戻る</a>
</form>

</body>
</html>