<?php
require('inc/common.php');
require('inc/admin_common.php');

$login = is_login();

$event_id = (int)$_REQUEST['event_id'];
$grade_id = (int)$_REQUEST['grade_id'];
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8" />
    <title>选择比赛 - <?php echo $event_shortname; ?>分数查询系统</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <style>
ul {
    margin-left: 28px;
}
    </style>
    <script type="text/javascript">
    function delete_confirm(action, id) {
        r = confirm("您确认要删除这个比赛吗？该比赛的所有成绩也将删除。");
        return r;
    }
    </script>
</head>
<body>
    <?php
    if ($_SESSION['notify']) {
        echo "<div class=\"notify\"><p class=\"info\">{$_SESSION['notify']}</p></div>";
        $_SESSION['notify'] = '';
    }
    ?>
    <div id="wrapper">
        <h1><?php
        if ($event_prefix)
            echo $event_prefix . '<br />';
        echo $event_name;
        ?>分数查询系统</h1>
        <p class="small"><a href="http://www.shiyihcc.com">HCC</a> » <a href="index.php">分数查询系统</a> » 选择比赛</p>
        <hr />
        <ul>
            <?php
            $query = "SELECT
                     $table_match.id AS id,
                     $table_grade.name AS grade,
                     $table_event.name AS event
                     FROM
                     $table_match, $table_grade, $table_event
                     WHERE
                     $table_match.grade_id = $table_grade.id AND
                     $table_match.event_id = $table_event.id";
            if ($event_id)
                $query .= " AND $table_match.event_id = $event_id";
            if ($grade_id)
                $query .= " AND $table_match.grade_id = $grade_id";
            $query .= " ORDER BY $table_grade.name, $table_event.name";
            if ($debug && $login)
                echo "<p class=\"xsmall\">" . $query . "</p>";
            $result = $dbc->query($query);
            while ($row = $result->fetch_assoc()) {
                echo "<li>";
                if ($login) {
                    echo "<a href=\"javascript:alert('对不起，该功能暂不可用...')\" onclick=\"return delete_confirm();\" title=\"删除\">[x]</a> ";
                }
                echo "<a href=\"show_match.php?id={$row['id']}\">{$row['grade']}{$row['event']}</a></li>";
            }
            ?>
        </ul>
        <hr />
        <p class="xsmall">♥ <?php echo $footer_string; ?></p>
    </div>
</body>
</html>
