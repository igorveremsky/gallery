<?php
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

$strSQL = "SELECT * FROM images"." ".$strSQL_sort;
$rs = mysql_query($strSQL);

while($row = mysql_fetch_array($rs)) {
	$layout = $row['id']%3+1;
	echo '
	<li class="img_'.$layout.'">
		<div class="img-content">
			<div class="img img-wrap-'.$row['id'].'" style="background-image: url(image.php?id='.$row['id'].')" onclick="javascript:big_info(this);" data-title="'.$row['title'].'" data-coment="'.$row['coment'].'" data-time="'.$row['time'].'">
				<a class="img-hover" href="javascript:open_big()"></a>
			</div>
		</div>
		<a class="link edit-link" href="javascript:edit_image('.$row['id'].')">Редактировать</a>
		<a class="link delete-link" href="javascript:delete_image('.$row['id'].')">Удалить</a>
	</li>';

  }
echo '<div class="clear"></div>';
?>