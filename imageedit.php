<?php
include('db.php');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Редактирование изображение</title>
  <link rel="stylesheet" type="text/css" href="main.css">
</head>
<?php
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
	
	$id = stripcslashes(htmlspecialchars($_POST['id']));
	$title = stripcslashes(htmlspecialchars($_POST['title']));
	$coment = stripcslashes(htmlspecialchars($_POST['coment']));

	if (mysql_query("UPDATE images SET title='$title', coment='$coment' WHERE id=".$id)) {
		echo '
		<h2 class="form-title">Изображение отредактировано</h2>
		<a class="link go-link" href="javascript:history.back()">Вернутся к редактированию</a>
		<a class="link go-link" href="/">Перейти на главную</a>';
	} else {
		echo '
		<h2 class="form-title error-text">Произошла ошибка при сохранении данных</h2>
		<a class="link go-link" href="javascript:history.back()">Вернутся к редактированию</a>
		<a class="link go-link" href="/">Перейти на главную</a>';
	}


}
?>