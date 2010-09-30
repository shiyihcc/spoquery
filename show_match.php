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
			         WHERE match_id = $match_id";
			$result = $dbc->query($query);
			if ($debug && $login)
				echo "<p>" . $query . "</p>";
			while ($row = $result->fetch_assoc()) {
				echo "<tr><td>{$row['rank']}</td>" .
					 "<td>{$row['name']}</td>" .
					 "<td>{$row['class']}</td>" .
					 "<td>{$row['score']}</td>";
				if ($login) {
					echo "<td><a href=\"edit.php?id={$row['id']}\">修改</a> · <a href=\"\" onclick=\"delete_confirm()\">删除</a></td>";
				}
				echo "</tr>";
			}
			?>
		</table>
		<hr />
		<p>♥ Proudly powered by Spoquery, made in HCC.</p>
  	</div>
</body>
</html>
