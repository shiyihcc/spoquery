<?php

require('inc/common.php');
require('inc/admin_common.php');

if ($_REQUEST['password'] == $admin_password) {
	$_SESSION['login'] = TRUE;
	redirect_with_alert('登录成功！', 'index.php');
}
else {
	redirect_with_alert('密码输错了...', 'index.php');
}

?>
