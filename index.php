<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Галерея</title>
	<link rel="stylesheet" type="text/css" href="main.css">
	<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="js/animate.js"></script>
	<script type="text/javascript" src="js/form_ajax.js"></script>
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
			<h2 class="form-title form-main-title">Добавить изображение</h2>
			<div class="result"></div>
			<form class="image-form add-image-form" method="post" enctype="multipart/form-data">
				<p class="form-text">Название:</p>
				<input type="text" class="form-input-text" name="title" required><br>
				<p class="form-text">Коментарий:</p>
				<textarea name="coment" class="form-input-text" required></textarea><br>
				<p class="form-text">Изображение:</p>
				<div id='imageloadstatus' style='display:none'><img src="loader.gif" alt="Uploading...."/></div>
				<div id='imageloadbutton'>
					<input type="file" name="photo" id="photoimg" required/>
				</div>
				<input type="submit" class="form-input-submit" value="Добавить">
			</form>
		</div>
	</div>
	<div class="big-content form-content delete-form-content">
		<div class="form-wrap result-msg">
		</div>
	</div>
	<h1 class="page-title">Memories</h1>
	<div class="layout">
		<form class="sort-form" method="post" action="javascript:submit_sort()">
			<label class="label-sort">Сортировать</label>
			<select class="form-input-text form-input-select sort-select" name="sort" onchange="javascript:submit_sort()">
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
		include 'imageview.php';
		?>
	</ul>
	<a class="link add-link" href="javascript:open_form('add')">Добавить изображение</a>
</body>
</html>
