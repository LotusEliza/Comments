

<?php

class indexController implements IController
{

    public function action($params)
    {
        $page = isset($_GET['page']) ? $_GET['page'] : 1;//чего единица -first page

        $cm = new CommentsModel(); //comments model
        $comments = $cm->commentsPage($page);

        $pages = $cm->countPages();
        
        include "templates/com_list.php";

    }
}