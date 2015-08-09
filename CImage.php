<?php

class Image 
{

	public $id;
	public $img;
	public $title;
	public $coment;
	public $time;

	function __construct()
	{
		include 'db.php';
	}

	function create($img,$title,$coment)
	{
	
		$this->img = $img;
		$this->title = $title;
		$this->coment = $coment;
		
		$create_query = "INSERT INTO images (id,img,title,coment,time) VALUES('null','$img','$title','$coment', now())";
		
		if (mysql_query($create_query)) {
			echo $this->msg('Изображение успешно добавлено');
		} else {
			echo $this->msg('Не удалось записать данные в базу данных!', true);
		};

		echo "<img class='preview-img' src='image.php?id={$this->getId($img,$title,$coment)}'>";
	}

	function edit($id,$title,$coment)
	{
		if (mysql_query("UPDATE images SET title='$title', coment='$coment' WHERE id=".$id)) {
			echo $this->msg('Изображение отредактировано');
		} else {
			echo $this->msg('Произошла ошибка при сохранении данных');
		}
	}

	function delete($id)
	{
		
		if(mysql_query("DELETE FROM `images` WHERE `id`=".$id)) {
			echo $this->msg('Изображение удалено');
		} else {
			echo $this->msg('Произошла ошибка при удалении данных');
		}
	}
	
	function showEdit($id)
	{
		$image = $this->selectId($id);
		 
		echo '<h2 class="form-title">Редактировать изображение</h2>  
			<form class="image-form edit-image-form" id="edit-image" method="post" enctype="multipart/form-data" action="javascript:submit_edit()">
				<img class="edit-img" src="image.php?id='.$image['id'].'">
				<input type="hidden" name="id" value="'.$image['id'].'">
				<p class="form-text">Название:</p>
				<input type="text" class="form-input-text" name="title" value="'.$image['title'].'" required><br>
				<p class="form-text">Коментарий:</p>
				<textarea class="form-input-text" name="coment" required>'.$image['coment'].'</textarea><br>
				<input type="submit" class="form-input-submit" value="Редактировать">
			</form>';
	}

	function showAdd()
	{
		echo '<h2 class="form-title form-main-title">Добавить изображение</h2>
			<div class="result"></div>
			<form class="image-form add-image-form" id="add-image" method="post" enctype="multipart/form-data" action="javascript:submit_add()">
				<p class="form-text">Название:</p>
				<input type="text" class="form-input-text" name="title" required><br>
				<p class="form-text">Коментарий:</p>
				<textarea name="coment" class="form-input-text" required></textarea><br>
				<p class="form-text">Изображение:</p>
				<input type="file" name="photo" id="photoimg" required/>
				<input type="submit" class="form-input-submit" value="Добавить" id="sub">
			</form>';
	}

	function showAll($sort='') 
	{
		switch ($sort) {
			case 'size_down':
				$query_sort = 'ORDER BY img desc';
			break;

			case 'size_up':
				$query_sort = 'ORDER BY img asc';
			break;

			case 'date_down':
				$query_sort = 'ORDER BY id desc';
			break;

			case 'date_up':
				$query_sort = 'ORDER BY id asc';
			break;
		}

		$query = "SELECT * FROM images ".$query_sort;
		$res = mysql_query($query);

		while($image = mysql_fetch_array($res)) {
			$layout = $image['id']%3+1;
			echo '
			<li class="img_'.$layout.'">
				<div class="img-content">
					<div class="img img-wrap-'.$image['id'].'" style="background-image: url(image.php?id='.$image['id'].')" onclick="javascript:big_info(this);" data-title="'.$image['title'].'" data-coment="'.$image['coment'].'" data-time="'.$image['time'].'">
						<a class="img-hover" href="javascript:open_big()"></a>
					</div>
				</div>
				<a class="link edit-link" href="javascript:edit_image('.$image['id'].')">Редактировать</a>
				<a class="link delete-link" href="javascript:delete_image('.$image['id'].')">Удалить</a>
			</li>';

		  }
		echo '<div class="clear"></div>';
	}

	private function getId($img,$title,$coment)
	{
		$select_query = "SELECT * FROM `images` WHERE `img`='$img' AND `title`='$title' AND `coment`='$coment'";
		$res = mysql_query($select_query);

		if ( mysql_num_rows( $res ) == 1 ) {
			$row = mysql_fetch_array($res);
			return $row['id'];
		}
	}

	private function selectId($id)
	{
		$query = "SELECT * FROM `images` WHERE `id`=".$id;
		$res = mysql_query($query);
		return mysql_fetch_array($res);
	}

	function getImg($id)
	{
		$query = "SELECT `img` FROM `images` WHERE `id`=".$id;

		$res = mysql_query($query);

		if (mysql_num_rows($res ) == 1) {
			$image = mysql_fetch_array($res);
			header("Content-type: image/*");
			return $image['img'];
		}
	}

	function msg($msg, $err = false)
	{
		if ($err) {
			return '<h2 class="form-title error-text">'.$msg.'</h2>';
		} else {
			return '<h2 class="form-title">'.$msg.'</h2>';
		}

	}
	function getAllInfo()
	{
		return "ID: {$this->id} <br />
		Img: {$this->img} <br />
		Title: {$this->title} <br />
		Coment: {$this->coment} <br />
		Time: {$this->time} <br />";	
	}
}

?>