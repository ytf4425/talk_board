<h1>Talk Board</h1>

<?php
session_start();
require_once 'common_func.php';

if (!isset($_SESSION["uuid"]) /*|| (isset($_SESSION["uuid"]) && $_SESSION["uuid"] == "0")*/) {
    /*$_SESSION["uuid"] = "0";*/

    echo '<p>You are GUEST</p>';
    echo '<p><a href="my.php">Log in / Register</a></p>';
    //如果有提交评论


    if (isset($_POST['comment']) || isset($_POST['nickname']) || isset($_POST['email']) || isset($_POST['website'])) {
        try {
            @$comment = $_POST['comment'];
            @$nickname = $_POST['nickname'];
            @$email = $_POST['email'];
            @$website = $_POST['website'];
            if ($comment && $nickname && $email)
                if (valid_email($email)) {
                    if ($website != '')
                        if (valid_website($website) == 1)
                            $website = "http://" . $website;
                    comment_submit($nickname, $website, $email, FALSE, $comment);
                    echo "<p>Congratulations, comment successful!</p>";
                } else
                    throw new Exception('Invalid E-mail address.');
            else
                throw new Exception('Please input necessary information.');
        } catch (Exception $err) {
            echo "Problem:";
            echo $err->getMessage();
            //exit;
        }
    }

    //评论框开始
    ?>
    <p>Use &lt;br&gt; to start a new line.</p>
    <form name="talkform" action="index.php" method='post'>
        <textarea cols="40" rows="5" name="comment">Talk as you want!</textarea>
        <table border="0">
            <tr>
                <td>Nickname</td>
                <td align="center">
                    <input type="text" name="nickname"/>
                </td>
            </tr>
            <tr>
                <td>E-mail</td>
                <td align="center">
                    <input type="text" name="email"/>
                </td>
            </tr>
            <tr>
                <td>Website(optional)</td>
                <td align="center">
                    <input type="text" name="website"/>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" name="submit" value="Go">
                </td>
            </tr>
        </table>
    </form>
    <?php
    //评论框结束
} else {
    echo "Hello, " . $_SESSION["uuid"];

    //如果有提交评论

    if (isset($_POST['comment'])) {
        try {
            @$comment = $_POST['comment'];
            @$nickname = $_SESSION['uuid'];
            @$email = $_SESSION["email"];
            if ($comment) {
                comment_submit($nickname, '', $email, TRUE, $comment);
                echo "<p>Congratulations, comment successful!</p>";
            } else
                throw new Exception('Please input your comment.');
        } catch (Exception $err) {
            echo "Problem:";
            echo $err->getMessage();
            //exit;
        }
    }

    //评论框开始
    ?>
    <p>Use &lt;br&gt; to start a new line.</p>
    <p><a href="my.php">My account</a></p>
    <p><a href="logout.php">Log out</a></p>
    <form name="talkform" action="index.php" method='post'>
        <textarea cols="40" rows="5" name="comment">Talk as you want!</textarea>
        <table border="0">
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" name="submit" value="Go">
                </td>
            </tr>
        </table>
    </form>
    <?php
    //评论框结束
}

///展示评论框
display_comment();
?>