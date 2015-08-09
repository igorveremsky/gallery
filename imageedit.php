<?php
include('db.php');

if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
	
	$id = stripcslashes(htmlspecialchars($_POST['id']));
	$title = stripcslashes(htmlspecialchars($_POST['title']));
	$coment = stripcslashes(htmlspecialchars($_POST['coment']));

	if (mysql_query("UPDATE images SET title='$title', coment='$coment' WHERE id=".$id)) {
		echo '
		<h2 class="form-title">Изображение отредактировано</h2>';
	} else {
		echo '
		<h2 class="form-title error-text">Произошла ошибка при сохранении данных</h2>';
	}


}
?>