<?php

require('inc/common.php');
require('inc/admin_common.php');

$_SESSION = array();
session_destroy();
setcookie('PHPSESSID', '', time()-300, '/', '', 0);
redirect_with_alert('登出成功！', 'index.php');

?>
