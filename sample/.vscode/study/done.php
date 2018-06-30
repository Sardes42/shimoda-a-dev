<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>XXX</title>
</head>
<body>
<?php

try
{

require_once('../common/common.php');

$post=sanitize($_POST);
$pro_name=$post['name'];
$pro_score=$post['score'];
$pro_comment=$post['comment'];

$dsn='mysql:dbname=study;host=localhost;charset=utf8';
$user='root';
$password='';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql='INSERT INTO review(name,score,comment) VALUES (?,?,?)';
$stmt=$dbh->prepare($sql);
$data[]=$pro_name;
$data[]=$pro_score;
$data[]=$pro_comment;
$stmt->execute($data);

$dbh=null;

print $pro_name;
print 'を追加しました。<br />';

}
catch(Exception$e)
{
	print'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>

<a href="index.php">戻る</a>
</body>
</html>