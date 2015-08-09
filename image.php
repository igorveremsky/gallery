<?php
include 'CImage.php';
$image = new Image();

define ("MAX_SIZE","1024"); 

function getExtension($str)
{
	$i = strrpos($str,".");
	if (!$i) { return ""; }
	$l = strlen($str) - $i;
	$ext = substr($str,$i+1,$l);
	return $ext;
}

if (isset($_GET) && $_SERVER['REQUEST_METHOD'] == "GET") {

	if (isset($_GET['id']))	
		$id = stripcslashes(htmlspecialchars($_GET['id']));

	if (isset($_GET['action'])) 
		$action = stripcslashes(htmlspecialchars($_GET['action']));

	if (!$action) {
		echo $image->getImg($id);
	} elseif ($action=='delete') {
		$image->delete($id);
	} elseif ($action=='edit') {
		$image->showEdit($id);
	} elseif ($action=='add') {
		$image->showAdd();
	}

}

if (isset($_POST) && $_SERVER["REQUEST_METHOD"] == "POST") {
	
	if (isset($_POST['sort'])) 
		$sort = stripcslashes(htmlspecialchars($_POST['sort']));
		
	if (isset($_POST['id'])) 
		$id = stripcslashes(htmlspecialchars($_POST['id']));
	
	if (isset($_POST['title'])) 
		$title = stripcslashes(htmlspecialchars($_POST['title']));
	
	if (isset($_POST['coment'])) 
		$coment = stripcslashes(htmlspecialchars($_POST['coment']));


	if (!empty($sort)) {
		$image->showAll($sort);	
	} elseif (!empty($id)) {
		$image->edit($id,$title,$coment);
	} elseif (!empty($_FILES['photo']['name'])) {

		if (strlen($coment) > 200) {
			echo $image->msg('Комментарий не должен превышать 200 символов!', true);
		} else {
			$filename = stripcslashes($_FILES['photo']['name']);
			$size=filesize($_FILES['photo']['tmp_name']);
			$image_tmp_name=file_get_contents($_FILES['photo']['tmp_name']);
			$image_db=mysql_escape_string($image_tmp_name);

			$ext = getExtension($filename);
			$ext = strtolower($ext);

			$valid_formats = array("jpg", "png", "jpeg");

			if(in_array($ext,$valid_formats)) {
				if ($size < (MAX_SIZE*1024)) {

					$image_name=time().$filename;
					$uploaddir = "img/"; 
					
					$newname=$uploaddir.$image_name;
					if (move_uploaded_file($_FILES['photo']['tmp_name'], $newname)) {
						$image->create($image_db,$title,$coment);
					} else {
						echo $image->msg('Не удалось загрузить изображение!', true); 
					}
				} else {
					echo $image->msg('Файл не должен превышать размер 1Мб!', true);
				}

			} else {
				echo $image->msg('Некоректное расширение изображение! Разрешены только jpg, png, jpeg!', true);
			}			
		}


	} else {
		$image->showAll();
	}
	
} 
?>