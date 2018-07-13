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
<title>商品検索</title>
</head>
<body>
<?php
require_once('../common/common.php');
?>




<?php

try
{

require_once('../common/common.php');

print '商品ランキング<br /><br />';

if(isset($_POST['search'])==false)
{
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

$sql='SELECT code,name,price,santi,meigara,nedan FROM mst_product WHERE 1';
$stmt=$dbh->prepare($sql);
$stmt->execute();

$sql='SELECT code,name,price,gazou FROM mst_product WHERE 1';
$stmt1=$dbh->prepare($sql);
$stmt1->execute();

$p_code=array();
$p_name=array();
$p_price=array();
$p_gazou=array();
$p_sum=array();

while(true)
{
 $rec=$stmt1->fetch(PDO::FETCH_ASSOC);
 if($rec==false)
 {
    break;
 }
 $p_code[]=$rec['code'];
 $p_name[]=$rec['name'];
 $p_price[]=$rec['price'];
 $p_sum[]=0;
 $p_gazou[]=$rec['gazou'];
}
$pro_num=count($p_code);

//注文データ
$sql='SELECT code,code_product,quantity FROM dat_sales_product WHERE 1';
$stmt2=$dbh->prepare($sql);
$stmt2->execute();

$s_code=array();
$s_pro_code=array();
$s_quantity=array();

while(true)
{
 $rec1=$stmt2->fetch(PDO::FETCH_ASSOC);
 if($rec1==false)
 {
	break;
 }
 $s_code[]=$rec1['code'];
 $s_pro_code[]=$rec1['code_product'];
 $s_quantity[]=$rec1['quantity'];
}
$sales_num=count($s_code);

$dbh=null;

//集計
for ($i = 0; $i < $sales_num; $i++){
	for ($j = 0; $j < $pro_num; $j++){
		if($s_pro_code[$i] == $p_code[$j]){
			$p_sum[$j] = $p_sum[$j] + $s_quantity[$i];
		}
	}
}

//ソート
$array01 = $p_sum;
arsort($array01);
//print_r($array01);
?>
<table>
<tr>
<td>
  <?php
  $value=0;
	$value1=0;
	$value2=0;
  for ($i = 0; $i < 3; $i++){?>
  <table border="0">
  <tr><td>
  <?php
	//ポインタ取得
	$key=key($array01);
	if($i==0){
	$value=current($array01);
	}elseif($i==1){
	$value1=current($array01);
  }else{
  $value2=current($array01);
  }
	//ポインタを進める（次のデータ表示のための準備）
	next($array01);
	$j=$i+1;
		//表示
		print '<a href="shop_product.php?procode='.$p_code[$key].'">';
    print '<br />';
    if($p_gazou[$key]=='')
    {
	    $disp_gazou='';
    }
    else
    {
	    $disp_gazou='<img src="../product/gazou/'.$p_gazou[$key].'">';
    }

         print $disp_gazou.'</a><br />'; ?></tr><td>
         <tr><td><?php print $p_name[$key].'';?></tr><td>
         <tr><td><?php print '人気No.';
         if($j==1){
         print_r($j);}elseif($value==$value1&&$j==2){
         print '1';}elseif($value==$value2&&$j==3){
         print '1';}elseif($value1==$value2){
         print '2';}else{
         print_r($j);}
         print '！';?></tr><td>
         <tr><td><?php if($value1==0&&$value2==0){
         print $value;}elseif($value2==0){
         print $value1;}else{print $value2;}?></tr><td>
         </td>
        </table> 
        <td>
        
        <?php  
}?>
        </td>
        </tr>
        </table>
<br /><br /> 

<?php
 //TABLEの横幅（ピクセル）
define('TABLE_WIDTH', 600);
//2次元配列
$Items = array(
array(),
array(),
array(),
array(),
array(),
array());

//商品一覧
?>

<form method="post" action="shop_list.php">
産地<?php pulldown_santi(); ?>&nbsp;
 銘柄<?php pulldown_meigara(); ?>&nbsp;
 値段<?php pulldown_nedan(); ?><br/>
<input type="hidden" name="search" value="search"/><br />
検索キーワードを入力
<br/>
<input type="search" name="keyword" value=""><br/>
<br/>
<input type="submit" value="組み合わせ検索">
</form>

<?php
print '商品一覧';
print '<br/>';
print '<br/>';
while(true)
{
	$rec2=$stmt->fetch(PDO::FETCH_ASSOC);
	if($rec2==false)
	{
		break;
	}
	print '<a href="shop_product.php?procode='.$rec2['code'].'">';
	print $rec2['name'].'---';
	print $rec2['price'].'円';
	print '</a>';
	print '<br />';
}
print '<br/>';
print '<a href="shop_cartlook.php">カートを見る</a><br />';
}

else{
$keyword = $_POST['keyword'];
$santi=$_POST['santi'];
$meigara=$_POST['meigara'];
$nedan=$_POST['nedan'];

require_once('../common/common.php');

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
$sql='SELECT code,name,price,santi,meigara,nedan FROM mst_product WHERE 1';
$stmt=$dbh->prepare($sql);
$stmt->execute();

$dbh=null;

$_x=0;

  if($keyword=='')
   {
require_once('../common/common.php');
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

$sql='SELECT code,name,price,santi,meigara,nedan FROM mst_product WHERE 1';
$stmt=$dbh->prepare($sql);
$stmt->execute();

$sql='SELECT code,name,price,gazou FROM mst_product WHERE 1';
$stmt1=$dbh->prepare($sql);
$stmt1->execute();

$p_code=array();
$p_name=array();
$p_price=array();
$p_gazou=array();
$p_sum=array();

while(true)
{
 $rec=$stmt1->fetch(PDO::FETCH_ASSOC);
 if($rec==false)
 {
    break;
 }
 $p_code[]=$rec['code'];
 $p_name[]=$rec['name'];
 $p_price[]=$rec['price'];
 $p_sum[]=0;
 $p_gazou[]=$rec['gazou'];
}
$pro_num=count($p_code);

//注文データ
$sql='SELECT code,code_product,quantity FROM dat_sales_product WHERE 1';
$stmt2=$dbh->prepare($sql);
$stmt2->execute();

$s_code=array();
$s_pro_code=array();
$s_quantity=array();

while(true)
{
 $rec1=$stmt2->fetch(PDO::FETCH_ASSOC);
 if($rec1==false)
 {
	break;
 }
 $s_code[]=$rec1['code'];
 $s_pro_code[]=$rec1['code_product'];
 $s_quantity[]=$rec1['quantity'];
}
$sales_num=count($s_code);

$dbh=null;

//集計
for ($i = 0; $i < $sales_num; $i++){
	for ($j = 0; $j < $pro_num; $j++){
		if($s_pro_code[$i] == $p_code[$j]){
			$p_sum[$j] = $p_sum[$j] + $s_quantity[$i];
		}
	}
}

//ソート
$array01 = $p_sum;
arsort($array01);
//print_r($array01);
?>
<table>
<tr>
<td>
  <?php
  $value=0;
	$value1=0;
	$value2=0;
  for ($i = 0; $i < 3; $i++){?>
  <table border="0">
  <tr><td>
  <?php
	//ポインタ取得
	$key=key($array01);
	if($i==0){
	$value=current($array01);
	}elseif($i==1){
	$value1=current($array01);
  }else{
  $value2=current($array01);
  }
	//ポインタを進める（次のデータ表示のための準備）
	next($array01);
	$j=$i+1;
		//表示
		print '<a href="shop_product.php?procode='.$p_code[$key].'">';
    print '<br />';
    if($p_gazou[$key]=='')
    {
	    $disp_gazou='';
    }
    else
    {
	    $disp_gazou='<img src="../product/gazou/'.$p_gazou[$key].'">';
    }

         print $disp_gazou.'</a><br />'; ?></tr><td>
         <tr><td><?php print $p_name[$key].'';?></tr><td>
         <tr><td><?php print '人気No.';
         if($j==1){
         print_r($j);}elseif($value==$value1&&$j==2){
         print '1';}elseif($value==$value2&&$j==3){
         print '1';}elseif($value1==$value2){
         print '2';}else{
         print_r($j);}
         print '！';?></tr><td>
         <tr><td><?php if($value1==0&&$value2==0){
         print $value;}elseif($value2==0){
         print $value1;}else{print $value2;}?></tr><td>
         </td>
        </table> 
        <td>
        
        <?php  
}?>
        </td>
        </tr>
        </table>
<br /><br /> 

<?php
 //TABLEの横幅（ピクセル）
define('TABLE_WIDTH', 600);
//2次元配列
$Items = array(
array(),
array(),
array(),
array(),
array(),
array());
?>
<form method="post" action="shop_list.php">
産地<?php pulldown_santi(); ?>&nbsp;
 銘柄<?php pulldown_meigara(); ?>&nbsp;
 値段<?php pulldown_nedan(); ?><br/>
<input type="hidden" name="search" value="search"/><br />
検索キーワードを入力
<br/>
<input type="search" name="keyword" value=""><br/>
<br/>
<input type="submit" value="組み合わせ検索">
</form>
<?php
print '商品一覧';
print '<br/>';
print '<br/>';
    while(true)
    {
      $rec=$stmt->fetch(PDO::FETCH_ASSOC);
      if($rec==false)
      {
      if($_x==0){
				print '該当の商品はありません';	
			}
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
		$_x=1;
		}
    }
  }

  else
  {

require_once('../common/common.php');

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

$sql='SELECT code,name,price,santi,meigara,nedan FROM mst_product WHERE 1';
$stmt=$dbh->prepare($sql);
$stmt->execute();

$sql='SELECT code,name,price,gazou FROM mst_product WHERE 1';
$stmt1=$dbh->prepare($sql);
$stmt1->execute();

$p_code=array();
$p_name=array();
$p_price=array();
$p_gazou=array();
$p_sum=array();

while(true)
{
 $rec=$stmt1->fetch(PDO::FETCH_ASSOC);
 if($rec==false)
 {
    break;
 }
 $p_code[]=$rec['code'];
 $p_name[]=$rec['name'];
 $p_price[]=$rec['price'];
 $p_sum[]=0;
 $p_gazou[]=$rec['gazou'];
}
$pro_num=count($p_code);

//注文データ
$sql='SELECT code,code_product,quantity FROM dat_sales_product WHERE 1';
$stmt2=$dbh->prepare($sql);
$stmt2->execute();

$s_code=array();
$s_pro_code=array();
$s_quantity=array();

while(true)
{
 $rec1=$stmt2->fetch(PDO::FETCH_ASSOC);
 if($rec1==false)
 {
	break;
 }
 $s_code[]=$rec1['code'];
 $s_pro_code[]=$rec1['code_product'];
 $s_quantity[]=$rec1['quantity'];
}
$sales_num=count($s_code);

$dbh=null;

//集計
for ($i = 0; $i < $sales_num; $i++){
	for ($j = 0; $j < $pro_num; $j++){
		if($s_pro_code[$i] == $p_code[$j]){
			$p_sum[$j] = $p_sum[$j] + $s_quantity[$i];
		}
	}
}

//ソート
$array01 = $p_sum;
arsort($array01);
//print_r($array01);
?>
<table>
<tr>
<td>
  <?php
  $value=0;
	$value1=0;
	$value2=0;
  for ($i = 0; $i < 3; $i++){?>
  <table border="0">
  <tr><td>
  <?php
	//ポインタ取得
	$key=key($array01);
	if($i==0){
	$value=current($array01);
	}elseif($i==1){
	$value1=current($array01);
  }else{
  $value2=current($array01);
  }
	//ポインタを進める（次のデータ表示のための準備）
	next($array01);
	$j=$i+1;
		//表示
		print '<a href="shop_product.php?procode='.$p_code[$key].'">';
    print '<br />';
    if($p_gazou[$key]=='')
    {
	    $disp_gazou='';
    }
    else
    {
	    $disp_gazou='<img src="../product/gazou/'.$p_gazou[$key].'">';
    }

         print $disp_gazou.'</a><br />'; ?></tr><td>
         <tr><td><?php print $p_name[$key].'';?></tr><td>
         <tr><td><?php print '人気No.';
         if($j==1){
         print_r($j);}elseif($value==$value1&&$j==2){
         print '1';}elseif($value==$value2&&$j==3){
         print '1';}elseif($value1==$value2){
         print '2';}else{
         print_r($j);}
         print '！';?></tr><td>
         <tr><td><?php if($value1==0&&$value2==0){
         print $value;}elseif($value2==0){
         print $value1;}else{print $value2;}?></tr><td>
         </td>
        </table> 
        <td>
        
        <?php  
}?>
        </td>
        </tr>
        </table>
<br /><br /> 

<?php
 //TABLEの横幅（ピクセル）
define('TABLE_WIDTH', 600);
//2次元配列
$Items = array(
array(),
array(),
array(),
array(),
array(),
array());
?>
<form method="post" action="shop_list.php">
産地<?php pulldown_santi(); ?>&nbsp;
 銘柄<?php pulldown_meigara(); ?>&nbsp;
 値段<?php pulldown_nedan(); ?><br/>
<input type="hidden" name="search" value="search"/><br />
検索キーワードを入力
<br/>
<input type="search" name="keyword" value=""><br/>
<br/>
<input type="submit" value="組み合わせ検索">
</form>
<?php
print '商品一覧';
print '<br/>';
print '<br/>';
    while(true)
    {
     $rec=$stmt->fetch(PDO::FETCH_ASSOC);
      if($rec==false)
      {
		if($_x==0){
			print '該当の商品はありません';			
		}
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
      $_x=1;
     }
    }
  }

print '<br />';
print '<a href="shop_cartlook.php">カートを見る</a><br />';

}
}
catch (Exception $e)
{
   echo '接続できませんでした 理由: ' . h($e->getMessage());
	 exit();
}

?>


</body>
</html>