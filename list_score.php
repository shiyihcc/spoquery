<?php
require('inc/common.php');
require('inc/admin_common.php');

$login = is_login();

$grade = (int)$_REQUEST['grade'];
$class = (int)$_REQUEST['class'];
$name = escape_data($_REQUEST['name']);
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8" />
    <title>查询成绩 - <?php echo $event_shortname; ?>分数查询系统</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <style>
td {
    padding: 8px 6px;
    font-size: 0.9em;
}
#match {
    width: 210px;
}
#rank {
    width: 50px;
}
#name {
    width: 100px;
}
#class {
    width: 50px;
}
#score {
    width: 120px;
}
#manage {
    width: 90px;
}
    </style>
    <script type="text/javascript">
    function delete_confirm(id) {
        r = confirm("您确认要删除该条成绩吗？这会导致比赛名次出现空缺，请尽量使用修改功能。如果一定要删除，请随后修改相关的名次数据。");
        return r;
    }
    </script>
</head>
<body>
    <div id="wrapper">
        <h1><?php
        if ($event_prefix)
            echo $event_prefix . '<br />';
        echo $event_name;
        ?>分数查询系统</h1>
        <p class="small"><a href="http://www.shiyihcc.com">HCC</a> » <a href="index.php">分数查询系统</a> » 查询成绩</p>
        <hr />
        <table>
            <tr><th id="match">比赛</th><th id="rank">名次</th><th id="name">姓名</th><th id="class">班级</th><th id="score">成绩</th><?php if ($login) echo "<th id=\"manage\">管理</th>" ?></tr>
            <?php
            $query = "SELECT
                     $table_score.id AS id,
                     $table_score.rank AS rank,
                     $table_score.name AS name,
                     $table_score.class AS class,
                     $table_score.score AS score,
                     $table_grade.name AS grade,
                     $table_event.name AS event
                     FROM
                     $table_score, $table_grade, $table_event, $table_match
                     WHERE
                     $table_score.match_id = $table_match.id AND
                     $table_match.grade_id = $table_grade.id AND
                     $table_match.event_id = $table_event.id";
            if ($class)
                $query .= " AND $table_score.class = $class";
            if ($grade)
                $query .= " AND $table_match.grade_id = $grade";
            if ($name && $name != "输入姓名")
                $query .= " AND $table_score.name LIKE '%$name%'";
            $query .= " ORDER BY $table_match.id, $table_score.rank;";

            if ($debug && $login)
                echo "<p class=\"xsmall\">" . $query . "</p>";
            $result = $dbc->query($query);
            while ($row = $result->fetch_assoc()) {
                switch ($row['rank']) {
                case 1:
                    $medal = " class=\"gold\"";
                    break;
                case 2:
                    $medal = " class=\"silver\"";
                    break;
                case 3:
                    $medal = " class=\"bronze\"";
                    break;
                default:
                    $medal = "";
                }
                echo "<tr$medal><td>{$row['grade']}{$row['event']}</td>" .
                     "<td>{$row['rank']}</td>" .
                     "<td>{$row['name']}</td>" .
                     "<td>{$row['class']}</td>";
                if ($row['rank'] == 1)
                    echo "<td><strong>{$row['score']}</strong></td>";
                else
                    echo "<td>{$row['score']}</td>";
                if ($login) {
                    echo "<td><a href=\"edit.php?id={$row['id']}\">修改</a> · <a href=\"delete_action.php?id={$row['id']}\" onclick=\"return delete_confirm();\">删除</a></td>";
                }
                echo "</tr>";
                $i += 1;
            }
            ?>
        </table>
        <hr />
        <p class="xsmall">♥ <?php echo $footer_string; ?></p>
    </div>
</body>
</html>
