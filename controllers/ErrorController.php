<?php
class ErrorController extends Controller
{
    function __construct()
    {
        $this->view = new View();
    }
    
    function actionError()
    {	
        $this->view->generate('404.php','msg.php'); 
    }
}
?>