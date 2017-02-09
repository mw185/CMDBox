<?php

session_start();

include 'connection.php';
if(isset($errorMessage)) {
    echo $errorMessage;

if(!array_key_exists('dummy', $_SESSION)) {
    $_SESSION['dummy'] = true;

    /**
     * Testdaten in Session speichern
     */
    $_SESSION['userID'] = 32;
}


if(array_key_exists('submit', $_POST)) {

    $db = new MySQL();

    $sql = 'SELECT pwd FROM tabelle WHERE id = %s';
    $sql = sprintf($sql, $_SESSION['userID']);

    $db->query($sql);
    $obj = $db->fetchObject();
    $pwd = $obj->pwd;

    if($pwd == $_POST['old'] && $_POST['new1'] == $_POST['new2']) {

        $sql = "UPDATE tabelle SET pwd = '%' WHERE id = %s";
        $sql = sprintf($sql, $_POST['new1'], $_SESSION['userID']);
        $db->query($sql);
    }

}
else {
    printf('<form action="%s" method="post"> 
                    <input type="text" name="old" value="Absenden" />

                    <input type="text" name="new1" value="Absenden" />

                    <input type="text" name="new2" value="Absenden" />

                    <input type="submit" name="submit" value="Absenden" />

                </form>',
        $_SERVER['PHP_SELF']);
}

?>