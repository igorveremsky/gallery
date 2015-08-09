<?php
class Image extends Model
{
    function view($sort='')
    {	
		switch ($sort) 
        {
			case 'size_down':
				$query_sort = 'ORDER BY size desc';
			break;

			case 'size_up':
				$query_sort = 'ORDER BY size asc';
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
        $images = array();
        
		while($image = mysql_fetch_array($res)) 
        {
            array_push($images, $image);
        }
  
        return $images;
    }
    
    public function delete($id)
    {	
		if(mysql_query("DELETE FROM `images` WHERE `id`=".$id)) {
			return 'Изображение удалено';
		} 
        else 
        {
			return 'Произошла ошибка при удалении данных';
		}
    }
    
    public function show_edit($id)
    {	
		$query = "SELECT * FROM `images` WHERE `id`=".$id;
		$res = mysql_query($query);
		return array(mysql_fetch_array($res));
    }

    public function edit($id, $title, $coment)
    {	
        if (mysql_query("UPDATE images SET title='$title', coment='$coment' WHERE id=".$id)) 
        {
			return 'Изображение отредактировано';
		} 
        else 
        {
			return 'Произошла ошибка при сохранении данных';
		}
    }
        
    public function add($file,$title,$coment)
    {	
		if (strlen($coment) > 200) 
        {
			return 'Комментарий не должен превышать 200 символов!';
		} 
        else 
        {  
			$filename = stripcslashes($file['name']);
			$size=filesize($file['tmp_name']);
			$image_tmp_name=file_get_contents($file['tmp_name']);
			$image_db=mysql_escape_string($image_tmp_name);

			$ext = $this->getExtension($filename);
			$ext = strtolower($ext);

			$valid_formats = array("jpg", "png", "jpeg");
            
			if(in_array($ext,$valid_formats)) 
            {
				if ($size < (1024*1024)) 
                {
                    $image_name=time().$filename;
					$uploaddir = "img/"; 
					
					$newname=$uploaddir.$image_name;
					
                    if (move_uploaded_file($file['tmp_name'], $newname)) 
                    {
						return $this->create($image_db,$size,$title,$coment);
					} 
                    else 
                    {
						return 'Не удалось загрузить изображение!'; 
					}
				} 
                else
                {
					return 'Файл не должен превышать размер 1Мб!';
				}
			} 
            else 
            {
				return 'Некоректное расширение изображение! Разрешены только jpg, png, jpeg!';
			}			
        }
    }
    function get($id)
    {
		$query = "SELECT `img` FROM `images` WHERE `id`=".$id;
		$res = mysql_query($query);

		if (mysql_num_rows($res) == 1) 
        {
			$image = mysql_fetch_array($res);
			header("Content-type: image/*");
			return $image['img'];
		}
    }
    
    private function getExtension($str)
    {
    	$i = strrpos($str,".");
    	if (!$i) { return ""; }
    	$l = strlen($str) - $i;
    	$ext = substr($str,$i+1,$l);
    	return $ext;
    }
    
    private function create($img,$size,$title,$coment) 
    {
		$create_query = "INSERT INTO images (id,img,size,title,coment,time) VALUES('null','$img','$size','$title','$coment', now())";
		
		if (mysql_query($create_query)) 
        {
			return "<h2 class='form-title'>Изображение успешно добавлено</h2>
            <img class='preview-img' src='image/get/{$this->getId($img,$title,$coment)}'>";
            
		} 
        else 
        {
			return 'Не удалось записать данные в базу данных!';
		};
    }
    
	private function getId($img,$title,$coment)
	{
		$select_query = "SELECT * FROM `images` WHERE `img`='$img' AND `title`='$title' AND `coment`='$coment'";
		$res = mysql_query($select_query);

		if ( mysql_num_rows( $res ) == 1 ) 
        {
			$row = mysql_fetch_array($res);
			return $row['id'];
		}
	}
}
?>