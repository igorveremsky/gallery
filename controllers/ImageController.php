<?php
class ImageController extends Controller
{
    function __construct()
    {
        $this->model = new Image();
        $this->view = new View();
    }
    
    function actionView()
    {	
        if (isset($_POST) && $_SERVER["REQUEST_METHOD"] == "POST") 
        {	
        	if (isset($_POST['sort'])) 
        		$sort = stripcslashes(htmlspecialchars($_POST['sort']));
            
            $data = $this->model->view($sort);
            $this->view->generate('imagelist.php', 'msg.php', $data); 
        }
        else
        {
            $data = $this->model->view();
            $this->view->generate('imagelist.php', 'main.php', $data);
        }
    }
    
    function actionDelete($id) 
    {
        $data = $this->model->delete($id);
        $this->view->generate('text.php', 'msg.php', $data);
    }
    
    function actionEdit($id='',$title='',$coment='') 
    {
        if (isset($_POST) && $_SERVER["REQUEST_METHOD"] == "POST") 
        {	
        	if (isset($_POST['id'])) 
        		$id = stripcslashes(htmlspecialchars($_POST['id']));
        	
           	if (isset($_POST['title'])) 
        		$title = stripcslashes(htmlspecialchars($_POST['title']));
        	
        	if (isset($_POST['coment'])) 
        		$coment = stripcslashes(htmlspecialchars($_POST['coment']));

            $data = $this->model->edit($id, $title, $coment);
            $this->view->generate('text.php', 'msg.php', $data);
        }
        else
        {
            $data = $this->model->show_edit($id);
            $this->view->generate('edit_form.php', 'msg.php', $data);
        } 
    }
    
    function actionAdd() 
    {
        if (isset($_POST) && $_SERVER["REQUEST_METHOD"] == "POST") 
        {
           	if (isset($_POST['title'])) 
        		$title = stripcslashes(htmlspecialchars($_POST['title']));
        	
        	if (isset($_POST['coment'])) 
        		$coment = stripcslashes(htmlspecialchars($_POST['coment']));
            
            if (!empty($_FILES['photo']['name']))
                $file = $_FILES['photo'];
                			
            $data = $this->model->add($file, $title, $coment);
            $this->view->generate('text.php', 'msg.php', $data);
        }
        else
        {
            $this->view->generate('add_form.php', 'msg.php');
        } 
    }
    
    function actionGet($id) 
    {
        echo $data = $this->model->get($id);
    }
}
?>