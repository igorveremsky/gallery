<?php
session_start();
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST['sort'])) {
		$sort = stripcslashes(htmlspecialchars($_POST['sort']));
		$strSQL_sort = '';

		switch ($sort) {
			case 'size_down':
				$strSQL_sort = 'ORDER BY img desc';
			break;

			case 'size_up':
				$strSQL_sort = 'ORDER BY img asc';
			break;

			case 'date_down':
				$strSQL_sort = 'ORDER BY id desc';
			break;

			case 'date_up':
				$strSQL_sort = 'ORDER BY id asc';
			break;
		}
	}
} 

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Галерея</title>
	<link rel="stylesheet" type="text/css" href="main.css">
	<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="js/animate.js"></script>
</head>
<body>
	<div class="big-img-bg"></div>
	<div class="big-content big-img-content">
		<table class="big-img-wrap" cellpadding="0" cellspacing="0">
			<tr>
				<td class="table-cell">
					<div class="arrow left"></div>
				</td>
				<td>
					<img class="big-img" src="">
				</td>
				<td>
					<div class="arrow right"></div>
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<h2 class="img-title"></h2>
					<p class="img-coment"></p>
					<p class="img-time"></p>
				</td>
			</tr>
		</table>
	</div>
	<div class="big-content form-content add-form-content">
		<div class="form-wrap">
			<h2 class="form-title">Добавить изображение</h2>
			<form class="image-form add-image-form" method="post" enctype="multipart/form-data" action='imageupload.php'>
				<p class="form-text">Название:</p>
				<input type="text" class="form-input-text" name="title" required><br>
				<p class="form-text">Коментарий:</p>
				<textarea name="coment" class="form-input-text" required></textarea><br>
				<p class="form-text">Изображение:</p>
				<div id='imageloadstatus' style='display:none'><img src="loader.gif" alt="Uploading...."/></div>
				<div id='imageloadbutton'>
					<input type="file" name="photos[]" id="photoimg" required/>
				</div>
				<input type="submit" class="form-input-submit" value="Добавить">
			</form>
		</div>
	</div>
	<h1 class="page-title">Memories</h1>
	<div class="layout">
		<form class="sort-form" method="post">
			<label class="label-sort">Сортировать</label>
			<select class="form-input-text form-input-select sort-select" name="sort" onchange="this.form.submit()" selected="<?php echo $_POST['sort']; ?>">
				<option value="0">выбрать</option>
				<option value="size_down">самые большие</option>
				<option value="size_up">самые маленькие</option>
				<option value="date_down">самые новые</option>
				<option value="date_up">самые старые</option>
			</select>
			<script type="text/javascript">
				$(".sort-select [value='<?php echo $sort; ?>']").attr('selected','selected');
			</script>
		</form>
	</div>
	<ul class="gallery">
		<?php
		$strSQL = "SELECT * FROM images"." ".$strSQL_sort;
		$rs = mysql_query($strSQL);
		
		while($row = mysql_fetch_array($rs)) {
			echo '
			<li class="img_'.rand(1,3).'">
				<div class="img-content">
					<div class="img img-wrap-'.$row['id'].'" style="background-image: url(image.php?id='.$row['id'].')" 
					data-title="'.$row['title'].'" data-coment="'.$row['coment'].'" data-time="'.$row['time'].'">
						<a class="img-hover" href="javascript:open_big()"></a>
					</div>
				</div>
				<a class="link edit-link" href="image.php?id='.$row['id'].'&action=edit">Редактировать</a>
				<a class="link delete-link" href="image.php?id='.$row['id'].'&action=delete">Удалить</a>
			</li>';

		  }

		?>
		<div class="clear"></div>
	</ul>
	<a class="link add-link" href="javascript:open_form('add')">Добавить изображение</a>
</body>
</html>
