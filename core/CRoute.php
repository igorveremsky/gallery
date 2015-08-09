<?php
class Route
{
    static function start()
    {
        $controller_name = 'Image';
        $action_name = 'view';
        
        $routes = explode('/', $_SERVER['REQUEST_URI']);

        if ( !empty($routes[1]) )
        {	
            $controller_name = $routes[1];
        }
        
        if ( !empty($routes[2]) )
        {
            $action_name = $routes[2];
        }

        if ( !empty($routes[3]) )
        {
            $id = $routes[3];
        }
        
        $first_model = mb_substr($controller_name,0,1, 'UTF-8');//первая буква
        $last_model = mb_substr($controller_name,1);//все кроме первой буквы
        $first_model = mb_strtoupper($first_model, 'UTF-8');
        $last_model = mb_strtolower($last_model, 'UTF-8');
        $model_name = $first_model.$last_model;

        $controller_name = $model_name.'Controller';

        $first_action = mb_substr($action_name,0,1, 'UTF-8');//первая буква
        $last_action = mb_substr($action_name,1);//все кроме первой буквы
        $first_action = mb_strtoupper($first_action, 'UTF-8');
        $last_action = mb_strtolower($last_action, 'UTF-8');
        $action_name = $first_action.$last_action;
        $action_name = 'action'.$action_name;

        $model_file = $model_name.'.php';
        $model_path = "models/".$model_file;
        if(file_exists($model_path))
        {
            include "models/".$model_file;
        }
        
        if ($controller_name == '404Controller') 
        {
            $controller_name = 'ErrorController';
            $action_name = 'actionError';
        }
        
        $controller_file = $controller_name.'.php';
        $controller_path = "controllers/".$controller_file;
        
        if(file_exists($controller_path))
        {
            include "controllers/".$controller_file;
        }
        else
        {
            Route::ErrorPage404();
        }
        
        $controller = new $controller_name;
        $action = $action_name;
        
        if(method_exists($controller, $action))
        {
            if (!empty($id)) 
            {
                $controller->$action($id);
            } 
            else
            {
                $controller->$action();   
            }
        }
        else
        {
            Route::ErrorPage404();
        }
    }
    
    function ErrorPage404()
    {   
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('Location:'.$host.'404');
    }
}
?>