<?php
class View
{
    function generate($content_view, $template_view='main.php', $data = null)
    {
        include 'views/'.$template_view;
    }
}
?>