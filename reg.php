<?php
@$username = $_POST["username"];
@$pw = $_POST["password"];
@$email = $_POST["email"];
//session_start();


function register($username, $pw, $email)
{
    $conn = mysql_conn();
    $result = $conn->query("select * from user where username='" . $username . "'");
    if (!$result)
        throw new Exception('Could not execute query');
    elseif ($result->num_rows > 0)
        throw new Exception('That username is taken.');
    $result = $conn->query("insert into user values ('" . $username . "',sha1('" . $pw . "'),'" . $email . "')");
    if (!$result)
        throw new Exception('Could not register for you.');
    return true;
}

try {
    if (!filled_out($_POST))
        throw new Exception("Please input necessary information.");
    if (!valid_email($email))
        throw new Exception("Invalid E-mail address.");
    if (strlen($pw) < 6 || strlen($pw) > 16)
        throw new Exception("Your password must be between 6 and 16 characters.");

    register("$username", "$pw", "$email");
    $_SESSION["uuid"] = $username;
    $_SESSION["email"] = $email;
    echo "Registration successful";
    echo '<p>Page will be <a href="/index.php">Refreshed</a> in 2s.</p>';
    echo '<meta http-equiv="refresh" content="2;url=index.php">';
} catch (Exception $err) {
    echo "Problem:";
    echo $err->getMessage();
    echo '<a href="/my.php">Come back</a>';
    exit;
}
?>