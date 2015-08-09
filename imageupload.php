<?php
include('db.php');

define ("MAX_SIZE","1024"); 

function getExtension($str)
{
	$i = strrpos($str,".");
	if (!$i) { return ""; }
	$l = strlen($str) - $i;
	$ext = substr($str,$i+1,$l);
	return $ext;
}

$valid_formats = array("jpg", "png", "jpeg");

if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
	$title = stripcslashes(htmlspecialchars($_POST['title']));
	$coment = stripcslashes(htmlspecialchars($_POST['coment']));
	$uploaddir = "img/"; 

	if (strlen($coment) > 200) {
		echo '<h2 class="form-title error-text">Комментарий не должен превышать 200 символов!</h2>';
	}	

	if (!empty($_FILES['photo']['name'])) {

		$filename = stripcslashes($_FILES['photo']['name']);
		$size=filesize($_FILES['photo']['tmp_name']);
		$image=file_get_contents($_FILES['photo']['tmp_name']);
		$image_db=mysql_escape_string($image);

		$ext = getExtension($filename);
		$ext = strtolower($ext);

		if(in_array($ext,$valid_formats)) {
			if ($size < (MAX_SIZE*1024)) {

				$image_name=time().$filename;

				$newname=$uploaddir.$image_name;
				if (move_uploaded_file($_FILES['photo']['tmp_name'], $newname)) {
					
					mysql_query("INSERT INTO images (id,img,title,coment,time) VALUES('null','$image_db','$title','$coment', now())");
					echo '<h2 class="form-title">Изображение успешно добавлено</h2>
					<img class="preview-img" src='.$uploaddir.$image_name.'>';
				} else {
					echo '<h2 class="form-title error-text">Не удалось загрузить изображение!</h2>'; 
				}
			} else {
				echo '<h2 class="form-title error-text">Файл не должен превышать размер 1Мб!</h2>';
			}

		} else {
			echo '<h2 class="form-title error-text">Некоректное расширение изображение! Разрешены только jpg, png, jpeg!</h2>';
		}

	} else {
		echo '<h2 class="form-title error-text">Вы не загрузили изображение!</h2>';
	}
}
?>