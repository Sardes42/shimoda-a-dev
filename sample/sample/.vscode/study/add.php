<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>XXX</title>
</head>
<body>
レビュー入力<br />
<br />
<form method="post" action="check.php" enctype="multipart/form-data">
名前を入力してください。<br />
<input type="text" name="name" style="width:100px"><br />
評価点を入力してください。<br />
<input type="text" name="score" style="width:30px"><br />
コメントを入力してください。<br />
<textarea name="comment" rows="4" cols="40"></textarea><br />
<br />
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="ＯＫ">
</form>
</body>
</html>