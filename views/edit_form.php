<?php
foreach ($data as $image) 
{
    echo'<h2 class="form-title">Редактировать изображение</h2>  
			<form class="image-form edit-image-form" id="edit-image" method="post" enctype="multipart/form-data" action="javascript:submit_edit()">
				<img class="edit-img" src="/image/get/'.$image['id'].'">
				<input type="hidden" name="id" value="'.$image['id'].'">
				<p class="form-text">Название:</p>
				<input type="text" class="form-input-text" name="title" value="'.$image['title'].'" required><br>
				<p class="form-text">Коментарий:</p>
				<textarea class="form-input-text" name="coment" required>'.$image['coment'].'</textarea><br>
				<input type="submit" class="form-input-submit" value="Редактировать">
			</form>';
}
?>