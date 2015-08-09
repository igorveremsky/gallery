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
	<div class="big-content form-content">
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
		</form>
	</div>
	<ul class="gallery">
	</ul>
	<a class="link add-link" href="javascript:add_image()">Добавить изображение</a>
</body>
</html>
