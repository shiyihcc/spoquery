<?php

class ACTION
{
    const ADD_EVENT = 11;
    const EDIT_EVENT = 12;
    const DEL_EVENT = 13;
    const ADD_GRADE = 21;
    const EDIT_GRADE = 22;
    const DEL_GRADE = 23;
    
    const DEL_SCORE = 33;
    const DEL_MATCH = 43;
}

session_start();

function check_login()
{
	if (!$_SESSION['login']) {
		redirect_with_alert('呃，貌似你没有登录...', '/');
		exit();
	}
}

function is_login()
{
	if ($_SESSION['login']) {
		return TRUE;
	}
	else {
		return FALSE;
	}
}

?>
