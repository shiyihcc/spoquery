<?php
require('inc/common.php');
require('inc/admin_common.php');

check_login();

$score_id = (int)$_REQUEST['score_id'];

$rank = (int)$_REQUEST['rank'];
$name = escape_data($_REQUEST['name']);
$class = escape_data($_REQUEST['class']);
$score = escape_data(htmlspecialchars_decode($_REQUEST['score']));

$query = "UPDATE $table_score SET rank = $rank, name = '$name', class = '$class', score = '$score' WHERE id = $score_id LIMIT 1";
$dbc->query($query);
if ($dbc->affected_rows) {
    $_SESSION['notify'] = '编辑成绩成功！';
    $_SESSION['notify_type'] = 'info';
    back(2);
} else {
    back_with_alert('您没有修改任何信息，或系统出现错误。', 2);
}
?>
