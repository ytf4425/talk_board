<?php
/**
 * Created by PhpStorm.
 * User: Tommy Yu'
 * Date: 2019/2/20
 * Time: 11:17
 */
session_start();
require_once 'common_func.php';

if (!isset($_SESSION["uuid"]) /*|| (isset($_SESSION["uuid"]) && $_SESSION["uuid"] == "0")*/) {
    if (!isset($_POST["username"]) && !isset($_POST['password'])) {
        /*$_SESSION["uuid"] = "0";*/
        ?>
        <h1>Log in / Register</h1>
        <p>choose one between username and e-mail when logging in.</p>
        <form action="my.php" method="post">
            <table border="0">
                <tr>
                    <td>Username</td>
                    <td align="center">
                        <input type="text" name="username"/>
                    </td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td align="center">
                        <input type="password" name="password"/>
                    </td>
                </tr>
                <tr>
                    <td>E-mail</td>
                    <td align="center">
                        <input type="text" name="email"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" name="submit" value="Log in">
                        <input type="submit" name="submit" value="Register">
                    </td>
                </tr>
            </table>
        </form>
    <?php }
    elseif ($_POST["submit"]=="Register")
        require_once("reg.php");
    elseif ($_POST["submit"]=="Log in")
        require_once("login.php");
} else                                  ///登陆成功
{
    echo "<p>Hello, " . $_SESSION["uuid"]."</p>";
    //echo '<p><a href="changepw.php">Change my password</a></p>';
    echo "<p>Your e-mail: ".$_SESSION['email']."</p>";
    echo '<p><a href="logout.php">Log out</a></p>';
}

?>