<h2 class="form-title form-main-title">Добавить изображение</h2>
<div class="result"></div>
<form class="image-form add-image-form" id="add-image" method="post" enctype="multipart/form-data" action="javascript:submit_add()">
	<p class="form-text">Название:</p>
	<input type="text" class="form-input-text" name="title" required /><br />
	<p class="form-text">Коментарий:</p>
	<textarea name="coment" class="form-input-text" required></textarea><br />
	<p class="form-text">Изображение:</p>
	<input type="file" name="photo" id="photoimg" required />
	<input type="submit" class="form-input-submit" value="Добавить" id="sub" />
</form>