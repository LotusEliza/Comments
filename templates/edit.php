<?php
include 'templates/header.php';

//global $oneComment;

if ($oneComment->Moderated) {
    $checkedTrue = ' checked';
    $checkedFalse = '';
} else {
    $checkedTrue = '';
    $checkedFalse = ' checked';
}

?>
<form method="POST" action="">
    <input type='hidden' name='id' value='<?=$oneComment->Id;?>'>
    <input type="text" name="imya" value='<?=$oneComment->Name;?>'/><br>
    <textarea name="comment"><?=$oneComment->Comment;?></textarea><br>
    <input type="text" name="added" value='<?=$oneComment->Added;?>'/><br>
    <label><input type="radio" name="moder" value='1'<?=$checkedTrue;?>/> True </label>
    <label><input type="radio" name="moder" value='0'<?=$checkedFalse;?>/> False </label><br>
    <input type='submit'>
</form>