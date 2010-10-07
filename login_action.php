<?php

require('inc/common.php');
require('inc/admin_common.php');

if ($_REQUEST['password'] == $admin_password) {
    $_SESSION[$session_login] = TRUE;
    $_SESSION['notify'] = '登录成功！';
    $_SESSION['notify_type'] = 'info';
    redirect('index.php');
}
else {
    $_SESSION['notify'] = '密码输错了...';
    $_SESSION['notify_type'] = 'warn';
    redirect('index.php');
}

?>
