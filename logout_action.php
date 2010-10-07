<?php

require('inc/common.php');
require('inc/admin_common.php');

$_SESSION[$session_login] = FALSE;
$_SESSION = array();

$_SESSION['notify'] = '登出成功！';
$_SESSION['notify_type'] = 'info';
redirect('index.php');

?>
