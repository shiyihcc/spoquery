<?php
require('inc/common.php');
require('inc/admin_common.php');

check_login();

$action = (int)$_REQUEST['action'];

switch ($action)
{
case ACTION::ADD_EVENT:
	$event = escape_data($_REQUEST['event']);
	$query = "INSERT INTO $table_event VALUES(NULL, '$event');";
	$dbc->query($query);
	if ($dbc->affected_rows) {
		redirect_with_alert('添加项目成功！', 'manage.php');
	} else {
		redirect_with_alert('出现错误，请联系系统管理员！', 'manage.php');
	}
	break;

case ACTION::DEL_EVENT:
	# TODO: check related match
/*	$id = (int)$_REQUEST['id'];
	$query = "DELETE FROM $table_event WHERE ID = $id LIMIT 1;";
	$dbc->query($query);
	if ($dbc->affected_rows) {
		redirect_with_alert('删除项目成功！', 'manage.php');
	} else {
		redirect_with_alert('出现错误，请联系系统管理员！', 'manage.php');
	}*/
	break;

case ACTION::ADD_GRADE:
	$grade = escape_data($_REQUEST['grade']);
	$query = "INSERT INTO $table_grade VALUES(NULL, '$grade');";
	$dbc->query($query);
	if ($dbc->affected_rows) {
		redirect_with_alert('添加年级成功！', 'manage.php');
	} else {
		redirect_with_alert('出现错误，请联系系统管理员！', 'manage.php');
	}
	break;

case ACTION::DEL_GRADE:
	# TODO: check related match
/*	$id = (int)$_REQUEST['id'];
	$query = "DELETE FROM $table_grade WHERE ID = $id LIMIT 1;";
	$dbc->query($query);
	if ($dbc->affected_rows) {
		redirect_with_alert('删除年级成功！', 'manage.php');
	} else {
		redirect_with_alert('出现错误，请联系系统管理员！', 'manage.php');
	}*/
	break;

default:
	redirect_with_alert('呃，你没有选择功能...', 'manage.php');
}
?>
