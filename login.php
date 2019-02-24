<?php
@$username = $_POST["username"];
@$pw = $_POST["password"];
@$email = $_POST["email"];
//session_start();
require_once 'common_func.php';

function login($username, $pw, $email)
{
    $conn = mysql_conn();
    $result = $conn->query("select * from user where (username='" . $username . "' OR email='" . $email . "') AND password=sha1('" . $pw . "')");
    if (!$result)
        throw new Exception('Could not execute query');
    elseif ($result->num_rows != 1)
        throw new Exception('Wrong information.');
    else
        $_SESSION['email'] = ($result->fetch_row())[2];
    return true;
}

try {
    if (!filled_out($_POST))
        throw new Exception('Please input necessary information.');
    login($username, $pw, $email);
    $_SESSION["uuid"] = $username;
    echo '<p>Logging in successful</p>';
    echo '<p>Page will be <a href="/index.php">Refreshed</a> in 2s.</p>';
    echo '<meta http-equiv="refresh" content="2;url=index.php">';
} catch (Exception $err) {
    echo "Problem:";
    echo $err->getMessage();
    echo '<a href="/my.php">Come back</a>';
    exit;
}
?>