<?php

require('config.php');
require('mysql_conn.php');

$app_version = '0.2.0pre';

$session_login = 'Spoquery-' . $app_unique_id . '-login';

$footer_string = "Proudly powered by <a href=\"http://code.google.com/p/hcc-apps/wiki/Spoquery\">Spoquery</a> $app_version, made in <a href=\"http://www.shiyihcc.com\">HCC</a>.";

$table_score = $table_prefix . 'score';
$table_grade = $table_prefix . 'grade';
$table_match = $table_prefix . 'match';
$table_event = $table_prefix . 'event';

function redirect($addr) {
    echo <<<EOF
<script>
    document.location = "{$addr}";
</script>
EOF;
}

function redirect_with_alert($alert, $addr) {
    echo <<<EOF
<meta charset="utf-8" />
<script>
    alert("{$alert}");
    document.location = "{$addr}";
</script>
EOF;
}

function back($step = 1) {
    echo <<<EOF
<script>
    history.go(-$step);
</script>
EOF;
}

function back_with_alert($alert, $step = 1) {
    echo <<<EOF
<meta charset="utf-8" />
<script>
    alert("{$alert}");
    history.go(-$step);
</script>
EOF;
}

function get_match_name_by_grade_and_event($grade_id, $event_id) {
    $grade_id = (int)$grade_id;
    $event_id = (int)$event_id;

    global $dbc;
    global $table_grade;
    global $table_event;

    $query = "SELECT name FROM $table_grade WHERE id = $grade_id;";
    $result = $dbc->query($query);
    $row = $result->fetch_assoc();
    $match_name = $row['name'];

    $query = "SELECT name FROM $table_event WHERE id = $event_id;";
    $result = $dbc->query($query);
    $row = $result->fetch_assoc();
    $match_name .= $row['name'];

    return $match_name;
}

function get_match_name_by_id($match_id) {
    $match_id = (int)$match_id;

    global $dbc;
    global $table_match;
    global $table_grade;
    global $table_event;

    $query = "SELECT
             $table_grade.name AS grade_name,
             $table_event.name AS event_name
             FROM
             $table_match, $table_grade, $table_event
             WHERE
             $table_match.id = $match_id AND
             $table_match.grade_id = $table_grade.id AND
             $table_match.event_id = $table_event.id;";
    $result = $dbc->query($query);
    $row = $result->fetch_assoc();
    $match_name = $row['grade_name'].$row['event_name'];

    return $match_name;
}

?>
