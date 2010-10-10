<?php
require('inc/common.php');
require('inc/admin_common.php');

check_login();
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8" />
    <title>管理面版 - <?php echo $event_shortname; ?>分数查询系统</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <style>
#column1 {
    width: 300px;
    margin-left: 40px;
}
#column2 {
    width: 300px;
    margin-left: 60px;
}
    </style>
    <script type="text/javascript">
    function delete_confirm(action, id) {
        r = confirm("您确认要删除这一项吗？");
        return r;
    }
    </script>
</head>
<body>
    <?php
    if ($_SESSION['notify']) {
        echo "<div class=\"notify\"><p class=\"{$_SESSION['notify_type']}\">{$_SESSION['notify']}</p></div>";
        $_SESSION['notify'] = '';
    }
    ?>
    <div id="wrapper">
        <h1><?php
        if ($event_prefix)
            echo $event_prefix . '<br />';
        echo $event_name;
        ?>分数查询系统</h1>
        <p class="small"><a href="http://www.shiyihcc.com">HCC</a> » <a href="./">分数查询系统</a> » 管理面版</p>
        <hr />
        <div class="column" id="column1">
            <h2>添加比赛成绩</h2>
            <form action="add_score.php" method="get">
                <p>
                    <select name="grade">
                        <?php
                        $query = "SELECT * FROM $table_grade;";
                        $result = $dbc->query($query);
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value=\"{$row['id']}\">{$row['name']}</option>\n";
                        }
                        ?>
                    </select>
                    <select name="event">
                        <?php
                        $query = "SELECT * FROM $table_event ORDER BY name;";
                        $result = $dbc->query($query);
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value=\"{$row['id']}\">{$row['name']}</option>\n";
                        }
                        ?>
                    </select>
                </p>
                <p>
                    <label for="count">运动员数</label>
                    <input type="text" class="input" name="count" id="count" />
                    <input type="submit" value="添加" />
                </p>
            </form>
            <hr />
            <h2>管理年级</h2>
            <ul>
                <?php
                $query = "SELECT * FROM $table_grade;";
                $result = $dbc->query($query);
                while ($row = $result->fetch_assoc()) {
                    echo "<li><a href=\"manage_action.php?action=$DEL_GRADE&id={$row['id']}\" onclick=\"return delete_confirm();\" title=\"删除\">[x]</a> {$row['name']}</li>\n";
                }
                ?>
            </ul>
            <form action="manage_action.php" method="get">
                <p>
                    <label for="grade">添加年级</label>
                    <input name="grade" class="input" id="grade" type="text" />
                    <input name="action" type="hidden" value="<?php echo $ADD_GRADE; ?>" />
                    <input type="submit" />
                </p>
            </form>
        </div>
        <div class="column" id="column2">
            <h2>管理项目</h2>
            <ul>
                <?php
                $query = "SELECT * FROM $table_event ORDER BY name;";
                $result = $dbc->query($query);
                while ($row = $result->fetch_assoc()) {
                    echo "<li><a href=\"manage_action.php?action=$DEL_EVENT&id={$row['id']}\" onclick=\"return delete_confirm();\" title=\"删除\">[x]</a> {$row['name']}</li>\n";
                }
                ?>
            </ul>
            <form action="manage_action.php" method="get">
                <p>
                    <label for="event">添加项目</label>
                    <input name="event" class="input" id="event" type="text" />
                    <input name="action" type="hidden" value="<?php echo $ADD_EVENT; ?>" />
                    <input type="submit" />
                </p>
            </form>
        </div>
        <hr />
        <p class="xsmall">♥ <?php echo $footer_string; ?></p>
    </div>
</body>
</html>
