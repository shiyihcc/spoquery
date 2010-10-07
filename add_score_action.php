<?php
require('inc/common.php');
require('inc/admin_common.php');

check_login();

$grade_id = (int)$_REQUEST['grade_id'];
$event_id = (int)$_REQUEST['event_id'];
$count = (int)$_REQUEST['count'];

$match_id = NULL;

# Check if the match is already added.
$query = "SELECT id FROM $table_match WHERE grade_id = $grade_id AND event_id = $event_id;";
$result = $dbc->query($query);
if ($row = $result->fetch_assoc()) {
    # Get match
    $match_id = $row['id'];
}
else {
    # Add match
    $query = "INSERT INTO $table_match VALUES(NULL, $grade_id, $event_id);";
    $dbc->query($query);
    if ($dbc->affected_rows != 1) {
        redirect_with_alert('出现错误，请联系系统管理员！', 'manage.php');
    }
    $match_id = $dbc->insert_id;
}

# Add scores
for ($i = 1; $i <= $count; $i++) {
    $rank = (int)$_REQUEST['rank' . $i];
    $name = escape_data($_REQUEST['name' . $i]);
    $class = escape_data($_REQUEST['class' . $i]);
    $score = escape_data($_REQUEST['score' . $i]);

    $query = "INSERT INTO $table_score(name, match_id, class, rank, score) VALUES('$name', $match_id, '$class', $rank, '$score');";
    $dbc->query($query);
    if ($dbc->affected_rows != 1) {
        redirect_with_alert('出现错误，请联系系统管理员！', 'manage.php');
    }
}

$_SESSION['notify'] = '恭喜，添加成绩成功！';
$_SESSION['notify_type'] = 'info';
redirect('manage.php');
?>
