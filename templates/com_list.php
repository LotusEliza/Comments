<?php include 'templates/header.php'; ?>
<table border = 1 width='100%' align='center'>
    <?php foreach ($comments as $comment) {
        list($Id, $Name, $Comment, $Added) = $comment;
        ?>
    <tr> <td>
            <table border = 1 width='50%'>
                <tr>
                    <td><?=$Added;?></td>
                    <td><a href='edit/<?=$Id;?>'>Edit</a> | <a href='remove/<?=$Id;?>'>Remove</a></td>
                </tr>
                <tr>
                    <td><?=$Name;?></td>
                    <td><?=$Comment;?></td>
                </tr>
            </table>
            </td> </tr>
    <?php }?>
    </table>
<?php for( $i = 1; $i<=$pages; $i++){
echo "<a href=\"/comments/?page={$i}\">{$i}</a> | ";
}

include 'templates/footer.php';
?>
