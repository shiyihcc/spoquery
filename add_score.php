<?php
require('inc/common.php');
require('inc/admin_common.php');

check_login();

$count = (int)$_REQUEST['count'];
$grade_id = (int)$_REQUEST['grade'];
$event_id = (int)$_REQUEST['event'];
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8" />
    <title>添加成绩 - <?php echo $event_shortname; ?>分数查询系统</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <style>
td input {
    font-size: 0.9em;
    margin: 0;
    border: 0;
    border-bottom: 1px solid #46ABE4;;
    padding: 6px;
}
.rank {
    width: 40px;
}
.name {
    width: 120px;;
}
.class {
    width: 80px;
}
.score {
    width: 180px;
}
    </style>
</head>
<body>
    <div id="wrapper">
        <h1><?php
        if ($event_prefix)
            echo $event_prefix . '<br />';
        echo $event_name;
        ?>分数查询系统</h1>
        <p class="small"><a href="http://www.shiyihcc.com">HCC</a> » <a href="index.php">分数查询系统</a> » 添加成绩</p>
        <hr />
        <h2><?php echo get_match_name_by_grade_and_event($grade_id, $event_id); ?></h2>
        <?php
        $query = "SELECT id FROM $table_match WHERE grade_id = $grade_id AND event_id = $event_id;";
        $result = $dbc->query($query);
        if ($result->num_rows) {
            echo "<p class=\"warn\">注意：数据库中已存在该比赛的数据，请仔细检查后再添加。</p>";
        }
        ?>
        <form action="add_score_action.php" method="post">
            <table>
                <tr><th id="rank">名次</th><th id="name">姓名</th><th id="class">班级</th><th id="score">成绩</th></tr>
                <?php
                for ($i = 1; $i <= $count; $i++)
                    echo "<tr><td><input type=\"text\" name=\"rank$i\" class=\"rank\" value=\"$i\" /></td>" .
                         "<td><input type=\"text\" name=\"name$i\" class=\"name\" /></td>" .
                         "<td><input type=\"text\" name=\"class$i\" class=\"class\" /></td>" .
                         "<td><input type=\"text\" name=\"score$i\" class=\"score\" /></td></tr>";
                ?>
            </table>
            <p class="align_center">
                <input type="hidden" name="grade_id" value="<?php echo $grade_id; ?>" />
                <input type="hidden" name="event_id" value="<?php echo $event_id; ?>" />
                <input type="hidden" name="count" value="<?php echo $count; ?>" />
                <input type="submit" value="提交" />
            </p>
        </form>
        <hr />
        <div class="info align_left"><?php echo $fill_help; ?></div>
        <hr />
        <p class="xsmall">♥ <?php echo $footer_string; ?></p>
    </div>
</body>
</html>
