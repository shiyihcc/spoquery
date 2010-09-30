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
</head>
<body>
	<div id="wrapper">
		<h1><?php
		if ($event_prefix)
			echo $event_prefix . '<br />';
		echo $event_name;
		?>分数查询系统</h1>
		<p class="small"><a href="http://www.shiyihcc.com">HCC</a> » <a href="index.php">分数查询系统</a> » 管理面版</p>
		<hr />
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
					$query = "SELECT * FROM $table_event;";
					$result = $dbc->query($query);
					while ($row = $result->fetch_assoc()) {
						echo "<option value=\"{$row['id']}\">{$row['name']}</option>\n";
					}
					?>
				</select>
			</p>
			<p>
				<label for="count">运动员数</label>
				<input type="text" name="count" id="count" />
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
				echo "<li>{$row['name']} <a href=\"manage_action.php?action=" .
				     ACTION::DEL_GRADE . "&id={$row['id']}\">删除</a></li>\n";
			}
			?>
		</ul>
		<form action="manage_action.php" method="get">
			<p>
				<label for="grade">添加年级</label>
				<input name="grade" id="grade" type="text" />
				<input name="action" type="hidden" value="<?php echo ACTION::ADD_GRADE; ?>" />
				<input type="submit" />
			</p>
		</form>
		<hr />
		<h2>管理项目</h2>
		<ul>
			<?php
			$query = "SELECT * FROM $table_event;";
			$result = $dbc->query($query);
			while ($row = $result->fetch_assoc()) {
				echo "<li>{$row['name']} <a href=\"manage_action.php?action=" .
				     ACTION::DEL_EVENT . "&id={$row['id']}\">删除</a></li>\n";
			}
			?>
		</ul>
		<form action="manage_action.php" method="get">
			<p>
				<label for="event">添加项目</label>
				<input name="event" id="event" type="text" />
				<input name="action" type="hidden" value="<?php echo ACTION::ADD_EVENT; ?>" />
				<input type="submit" />
			</p>
		</form>
		<hr />
		<p>♥ Proudly powered by Spoquery, made in HCC.</p>
  	</div>
</body>
</html>
