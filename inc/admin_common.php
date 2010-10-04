<?php

# Enums
$ADD_EVENT = 11;
$EDIT_EVENT = 12;
$DEL_EVENT = 13;
$ADD_GRADE = 21;
$EDIT_GRADE = 22;
$DEL_GRADE = 23;
$DEL_SCORE = 33;
$DEL_MATCH = 43;

session_start();

function check_login()
{
    global $session_login;
        if (!$_SESSION[$session_login]) {
                redirect_with_alert('呃，貌似你没有登录...', '/');
                exit();
        }
}

function is_login()
{
    global $session_login;
        return $_SESSION[$session_login];
}

?>
