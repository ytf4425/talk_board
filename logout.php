<?php
/**
 * Created by PhpStorm.
 * User: Tommy Yu'
 * Date: 2019/2/21
 * Time: 10:30
 */
session_start();
if (isset($_SESSION["uuid"])) {
    unset($_SESSION['email']);
    unset($_SESSION["uuid"]);
    session_destroy();
    echo '<p>Logged out.</p>';
} else
    echo 'You have NOT logged in. How could you come here?';
echo '<p>Page will be <a href="/index.php">Refreshed</a> in 2s.</p>';
echo '<meta http-equiv="refresh" content="2;url=index.php">';
?>
