<?php

/**
 * Created by PhpStorm.
 * User: lotus
 * Date: 7/1/17
 * Time: 6:23 PM
 */

class editController implements IController
{
    public function action($params)
    {
        //vd($params);
        if (count( $_POST) > 0) {
            //var_dump($_POST); exit;
            
            $id = $_POST['id'];
            $name = $_POST['imya'];       // Зачем '...'
            $comment = $_POST['comment'];
            $added = $_POST['added'];
            $moderated = $_POST['moder'];

            $cm = new CommentsModel();
            $cm->updateComment($id, $name, $comment, $added, $moderated);


            header('Location:/comments');
        }
        else {
            if (count($params)==0) {
                header('Location:/comments');
                die;
            }

            $id = intval(array_shift($params));//prevrashaet luboi parametr v int
            if($id == 0){
                header('Location:/comments');
                die;
            }
        }
            $cm = new CommentsModel();
            $oneComment = $cm->oneComment($id);
            
            include 'templates/edit.php';
    }
}