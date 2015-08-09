<?php

$host='localhost'; // имя хоста (уточняется у провайдера)
$database='gallery_db'; // имя базы данных, которую вы должны создать
$user='root'; // заданное вами имя пользователя, либо определенное провайдером
$pswd=''; // заданный вами пароль
 
$dbh = mysql_connect($host, $user, $pswd) or die("Не могу соединиться с MySQL.");
mysql_select_db($database) or die("Не могу подключиться к базе.");

if ( $_GET['id'] > 0 && !$_GET['action']) {

	$id = (int)$_GET['id'];
	$query = "SELECT `img` FROM `images` WHERE `id`=".$id;

	$res = mysql_query($query);

	if ( mysql_num_rows( $res ) == 1 ) {
	$image = mysql_fetch_array($res);
	header("Content-type: image/*");
	echo $image['img'];
	}
}

if ( isset( $_GET['id'] ) ) {
	// Здесь $id номер изображения
	$id = (int)$_GET['id'];
	
	if (isset($_GET['action'])) {
		$action = $_GET['action'];
		
		if ($action=='delete') {
			$query = "DELETE FROM `images` WHERE `id`=".$id;
			$res = mysql_query($query);

			echo '<h2 class="form-title">Изображение удалено</h2>';   
		} elseif ($action=='edit') {
			$query = "SELECT * FROM `images` WHERE `id`=".$id;
			$res = mysql_query($query);
			$row = mysql_fetch_array($res);
			 
			echo '
				<h2 class="form-title">Редактировать изображение</h2>  
				<form class="image-form edit-image-form" method="post" enctype="multipart/form-data" action="javascript:submit_edit()">
					<img class="edit-img" src="image.php?id='.$row['id'].'">
					<input type="hidden" name="id" value="'.$row['id'].'">
					<p class="form-text">Название:</p>
					<input type="text" class="form-input-text" name="title" value="'.$row['title'].'" required><br>
					<p class="form-text">Коментарий:</p>
					<textarea class="form-input-text" name="coment" required>'.$row['coment'].'</textarea><br>
					<input type="submit" class="form-input-submit" value="Редактировать">
				</form>';
		}
	}


}

?>