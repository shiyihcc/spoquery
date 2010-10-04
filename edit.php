<?php
require('inc/common.php');
require('inc/admin_common.php');

$login = is_login();

$score_id = (int)$_REQUEST['id'];
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8" />
    <title>修改成绩 - <?php echo $event_shortname; ?>分数查询系统</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <style>
td input {
    font-size: 0.9em;
    margin: 0;
    border: 0;
    padding: 6px;
}
.match {
    width: 210px;
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
        <p class="small"><a href="http://www.shiyihcc.com">HCC</a> » <a href="index.php">分数查询系统</a> » 修改成绩</p>
        <hr />
        <form action="edit_action.php" method="post">
            <table>
                <tr><th id="match">比赛</th><th id="rank">名次</th><th id="name">姓名</th><th id="class">班级</th><th id="score">成绩</th></tr>
                <?php
                $query = "SELECT id, rank, name, class, score, match_id
                         FROM $table_score
                         WHERE id = $score_id";
                if ($debug)
                    echo "<p class=\"xsmall\">" . $query . "</p>";
                $result = $dbc->query($query);
                $row = $result->fetch_assoc();
                $match = get_match_name_by_id($row['match_id']);
                $score = htmlspecialchars($row['score']);
                echo "<tr><td class=\"match\"><input type=\"text\" class=\"match disable\" value=\"$match\" readonly=\"readonly\" /></td>" .
                     "<td><input type=\"text\" name=\"rank\" class=\"rank\" value=\"{$row['rank']}\" /></td>" .
                     "<td><input type=\"text\" name=\"name\" class=\"name\" value=\"{$row['name']}\" /></td>" .
                     "<td><input type=\"text\" name=\"class\" class=\"class\" value=\"{$row['class']}\" /></td></td>" .
                     "<td><input type=\"text\" name=\"score\" class=\"score\" value=\"$score\" /></td></td></tr>";
                ?>
            </table>
            <p class="align_center"><input type="hidden" name="score_id" value="<?php echo $score_id; ?>" /><input type="submit" value="提交" /></p>
        <form>
        <hr />
        <div class="info align_left"><?php echo $fill_help; ?></div>
        <hr />
        <p class="xsmall">♥ <?php echo $footer_string; ?></p>
    </div>
</body>
</html>
