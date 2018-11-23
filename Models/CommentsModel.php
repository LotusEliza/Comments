<?php

class CommentsModel
{
    public function __construct()
    {
        
    }
    public function commentsPage($page) {
        global $_config, $gdb;
        $countPerPage = $_config['cpp'];
        $offset = ($page * $countPerPage) - $countPerPage;
        $q = "SELECT * FROM `comments` WHERE `Moderated`= 1 ORDER BY `Added` DESC LIMIT {$countPerPage} OFFSET {$offset}";
        $stmt=$gdb->prepare($q);
        if (!$stmt){
            echo ('Statement error: ' . $gdb->error);
            return [];
        }
        if (!$stmt->execute()){
            echo ('Statement error: ' . $gdb->error);
            return [];
        }
        
//echo $stmt->num_rows();
        $stmt->bind_result($Id, $Name, $Comment, $Added, $Moderated);//Привязка переменных к подготовленному answer
//echo "<table border = 1 width='100%' align='center'>";
        $comments=[];
        while ($stmt->fetch()) {
            $comments[]=[$Id, $Name, $Comment, $Added];
        }
        return $comments;
    }
    
    public function countPages(){
        global $_config, $gdb;
        
        $totalCount = 0;

        $stmt=$gdb->prepare('SELECT COUNT(*) FROM `comments` WHERE `Moderated` = 1');
        if (!$stmt){
            die('Statement error: ' . $gdb->error);
        }
        $stmt->execute();
        $stmt->bind_result($totalCount);
        $stmt->fetch();                       //обязательно?
        $pages = ceil($totalCount/$_config['cpp']);
        return $pages;
    }
    
    public function insertComments($name, $comment, $added){
        global $gdb;
        $q = "INSERT into `comments` (`Name`, `Comment`, `Added`, `Moderated`) VALUES ('{$name}', '{$comment}', '{$added}', 0)";
        $stmt=$gdb->prepare($q);      //podgotovili zapros
        if (!$stmt){
            //die('Statement error: ' . $gdb->error);
            return false;
        }
        return $stmt->execute();             //vupolnili
    }
    public function oneComment($id){
        global $gdb;
        $q = "SELECT * FROM `comments` WHERE `Id`= ? ";
        $stmt = $gdb->prepare($q);
        if (!$stmt) {
            die('Statement error: ' . $gdb->error);
        }
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_object();
        //$stmt->bind_result($Id, $Name, $Comment, $Added, $Moderated);
        //$stmt->fetch();
        
    }
    public function updateComment($id, $name, $comment, $added, $moderated){
        global $gdb;
        $q = "UPDATE `comments` SET `Name`= ?, `Comment`= ?, `Added`=?, `Moderated`=? WHERE `Id`=?"  ;
        $stmt=$gdb->prepare($q);      //podgotovili zapros
        if (!$stmt){
            die('Statement error: ' . $gdb->error);
        }
        $stmt->bind_param('sssii', $name, $comment, $added, $moderated, $id);
        return $stmt->execute();
    }
    public function removeComment($id){
        global $gdb;
        $q = "DELETE FROM `comments` WHERE `Id`=?";
        $stmt=$gdb->prepare($q);
        if (!$stmt){
            die('Statement error: ' . $gdb->error);
        }
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

}