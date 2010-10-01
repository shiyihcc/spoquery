<?php
require('inc/common.php');
require('inc/admin_common.php');

check_login();

$score_id = (int)$_REQUEST['score_id'];

$rank = (int)$_REQUEST['rank'];
$name = escape_data($_REQUEST['name']);
$class = (int)$_REQUEST['class'];
$score = escape_data($_REQUEST['score']);

$query = "UPDATE $table_score SET rank = $rank, name = '$name', class = $class, score = '$score' WHERE id = $score_id LIMIT 1";
$dbc->query($query);
if ($dbc->affected_rows) {
	back_with_alert('编辑成绩成功！', 2);
} else {
	back_with_alert('出现错误，请联系系统管理员！', 2);
}
?>
