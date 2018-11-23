<?php

class addController implements IController
{
    function action($params)
    {
        //vd($params);
        if (count( $_POST) > 0) {
            //var_dump($_POST);
            $name = $_POST['imya'];      
            $text = $_POST['comment'];
            $date = date('Y-m-d H:i:s');
            $cm = new CommentsModel();
            $cm->insertComments($name, $text, $date);
            header('Location:/comments');
        }
        else{
            include "templates/add.php";
        }
    }
}
