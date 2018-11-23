
<?php

class removeController implements IController
{
    public function action($params){
        if (count($params)==0){
            header('Location:/comments');
            die;
        }

        $id=intval(array_shift($params));
        if($id==0){
            header('Location:/comments');
            die;
        }
        $cm = new CommentsModel();
        $cm->removeComment($id);

        header('Location:/comments');
    }
}