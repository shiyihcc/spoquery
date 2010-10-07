<?php
require('inc/common.php');
require('inc/admin_common.php');

check_login();

$id = (int)$_REQUEST['id'];

$query = "DELETE FROM $table_score WHERE id = $id LIMIT 1";
$dbc->query($query);
if ($dbc->affected_rows == 1) {
    $_SESSION['notify'] = '删除成绩成功！';
    $_SESSION['notify_type'] = 'info';
    back();
} else {
    back_with_alert('出现错误，请联系系统管理员！');
}
?>
