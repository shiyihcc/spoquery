<?php
require('inc/common.php');
require('inc/admin_common.php');

check_login();

$id = (int)$_REQUEST['id'];

$query = "DELETE FROM $table_score WHERE id = $id LIMIT 1";
$dbc->query($query);
if ($dbc->affected_rows) {
	back_with_alert('删除成绩成功！');
} else {
	back_with_alert('出现错误，请联系系统管理员！');
}
?>
