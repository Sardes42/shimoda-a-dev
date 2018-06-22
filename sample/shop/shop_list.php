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
産地<?php pulldown_santi(); ?>&nbsp;
 銘柄<?php pulldown_meigara(); ?>&nbsp;
 値段<?php pulldown_nedan(); ?><br/>
<input type="hidden" name="search" value="search"/><br />
検索キーワードを入力
<br/>
<input type="search" name="keyword" value="">
<input type="submit" value="検索">
</form>

<?php

try
{

require_once('../common/common.php');

print '商品一覧<br /><br />';

if(isset($_POST['search'])==false)
{
$dsn='mysql:dbname=test;host=localhost;charset=utf8';
$user='root';
$password='';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql='SELECT code,name,price,santi,meigara,nedan FROM mst_product WHERE 1';
$stmt=$dbh->prepare($sql);
$stmt->execute();

$dbh=null;

  while(true)
  { 
    $rec=$stmt->fetch(PDO::FETCH_ASSOC);
    if($rec==false)
    {
      break;
    }
	print '<a href="shop_product.php?procode='.$rec['code'].'">';
	print $rec['name'].'─';
	print $rec['price'].'円';
	print '</a>';
	print '<br />';
  }
print '<br />';
print '<a href="shop_cartlook.php">カートを見る</a><br />';
}

else{
$keyword = $_POST['keyword'];
$santi=$_POST['santi'];
$meigara=$_POST['meigara'];
$nedan=$_POST['nedan'];

$dsn='mysql:dbname=test;host=localhost;charset=utf8';
$user='root';
$password='';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql='SELECT code,name,price,santi,meigara,nedan FROM mst_product WHERE 1';
$stmt=$dbh->prepare($sql);
$stmt->execute();

$dbh=null;

  if($keyword=='')
   {
    while(true)
    {
      $rec=$stmt->fetch(PDO::FETCH_ASSOC);
      if($rec==false)
      {
        break;
      }
  if((strpos($rec['santi'],$santi)!==false)
  &&(strpos($rec['meigara'],$meigara)!==false)
	&&(strpos($rec['nedan'],$nedan)!==false))
		{
		print '<a href="shop_product.php?procode='.$rec['code'].'">';
		print $rec['name'].'─';
		print $rec['price'].'円';
		print '</a>';
		print '<br />';
		}
    }
  }

  else
  {
    while(true)
    {
     $rec=$stmt->fetch(PDO::FETCH_ASSOC);
      if($rec==false)
      {
       break;
      }
    if((strpos($rec['name'],$keyword)!==false)
    &&(strpos($rec['santi'],$santi)!==false)
    &&(strpos($rec['meigara'],$meigara)!==false)
    &&(strpos($rec['nedan'],$nedan)!==false))
    {
      print '<a href="shop_product.php?procode='.$rec['code'].'">';
      print $rec['name'].'─';
      print $rec['price'].'円';
      print '</a>';
      print '<br />';
     }
    }
  }

print '<br />';
print '<a href="shop_cartlook.php">カートを見る</a><br />';

}
}
catch (Exception $e)
{
	 print 'ただいま障害により大変ご迷惑をお掛けしております。';
	 exit();
}

?>


</body>
</html>