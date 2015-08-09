<?php
foreach ($data as $image) 
{
    $layout = $image['id']%3+1;
    echo '
    <li class="img_'.$layout.'">
    	<div class="img-content">
    		<div class="img img-wrap-'.$image['id'].'" style="background-image: url(image/get/'.$image['id'].')" onclick="javascript:big_info(this);" data-title="'.$image['title'].'" data-coment="'.$image['coment'].'" data-time="'.$image['time'].'">
    			<a class="img-hover" href="javascript:open_big()"></a>
    		</div>
    	</div>
    	<a class="link edit-link" href="javascript:edit_image('.$image['id'].')">Редактировать</a>
    	<a class="link delete-link" href="javascript:delete_image('.$image['id'].')">Удалить</a>
    </li>';
} 
echo '<div class="clear"></div>';
?>