<?php
require('inc/common.php');
require('inc/admin_common.php');

$login = is_login();

$match_id = (int)$_REQUEST['id'];
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8" />
    <title>查看比赛 - <?php echo $event_shortname; ?>分数查询系统</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <style>
td {
    padding: 6px;
    font-size: 0.9em;
}
#rank {
    width: 60px;
}
#name {
    width: 120px;
}
#class {
    width: 60px;
}
#score {
    width: 140px;
}
#manage {
    width: 100px;
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
        <p class="small"><a href="http://www.shiyihcc.com">HCC</a> » <a href="index.php">分数查询系统</a> » 查看比赛</p>
        <hr />
        <h2><?php echo get_match_name_by_id($match_id); ?></h2>
        <table>
            <tr><th id="rank">名次</th><th id="name">姓名</th><th id="class">班级</th><th id="score">成绩</th><?php if ($login) echo "<th id=\"manage\">管理</th>" ?></tr>
            <?php
            $query = "SELECT id, rank, name, class, score
                     FROM $table_score
                     WHERE match_id = $match_id
                     ORDER BY rank;";
            $result = $dbc->query($query);
            if ($debug && $login)
                echo "<p class=\"xsmall\">" . $query . "</p>";
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
                echo "<tr$medal><td>{$row['rank']}</td>" .
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
            }
            ?>
        </table>
        <hr />
        <p class="xsmall">♥ <?php echo $footer_string; ?></p>
    </div>
</body>
</html>
