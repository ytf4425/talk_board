<?php
/**
 * Created by PhpStorm.
 * User: Tommy Yu'
 * Date: 2019/2/22
 * Time: 12:41
 */
function valid_website($str)
{
    if (strstr($str, 'http://') === false && strstr($str, 'https://') === false) {
        return 1;  ///需要再补上http://
    }
    return 0;
}

function valid_email($str)
{
    return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
}

function filled_out($form_vars)
{
    foreach ($form_vars as $key => $value)
        if ((!isset($key)) || ($value == ''))
            return false;
    return true;
}

function display_comment()
{
    $conn = mysql_conn();
    $result_comment = $conn->query("select * from comment order by time DESC");
    if (!$result_comment)
        echo('Could not execute query');
    /*
    $nickname_list=array();
    $comment_list = array();
    $login_list=array();
    $time_list=array();
     */
    for ($i = 0; $row = $result_comment->fetch_row(); $i++) {
        /*
         var_dump($row);
        $nickname_list[$i]=$
        $comment_list[$i] = $row[0];
         */
        echo "<h3>" . $row[4] . "</h3>";
        //var_dump($row);
        if ($row[1] == '0')
            $ifguest = ' (guest)';
        else $ifguest = '';

        if ($row[2] == '')
            echo "<p> by " . $row[0] . $ifguest . " at " . $row[5] . "</p>";
        else
            echo "<p> by <a href=\"$row[2]\">" . $row[0] . $ifguest . "</a> at " . $row[5] . "</p>";
        echo '<hr />';
    }
    return true;
}

function comment_submit($username, $website, $email, $login, $text)
{
    $conn=mysql_conn();
    $result = $conn->query("insert into comment values ('" . $username . "','" . $login . "','" . $website . "','" . $email . "','" . $text . "',default)");
    if (!$result)
        throw new Exception('Could not execute query');
    return true;
}

function mysql_conn()
{
    $conn = new mysqli("localhost", "phpstudy", "ybGXYCpVE9zPsJCY", "phpstudy");
    if (!$conn)
        throw new Exception("Could not connect with Mysql");
    else
        return $conn;
}

?>