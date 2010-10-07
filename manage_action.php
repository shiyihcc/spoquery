<?php
require('inc/common.php');
require('inc/admin_common.php');

check_login();

$action = (int)$_REQUEST['action'];

switch ($action)
{
case $ADD_EVENT:
    $event = escape_data($_REQUEST['event']);
    $query = "INSERT INTO $table_event VALUES(NULL, '$event');";
    $dbc->query($query);
    if ($dbc->affected_rows) {
        $_SESSION['notify'] = '添加项目成功！';
        $_SESSION['notify_type'] = 'info';
        redirect('manage.php');
    } else {
        redirect_with_alert('出现错误，请联系系统管理员！', 'manage.php');
    }
    break;

case $DEL_EVENT:
    $id = (int)$_REQUEST['id'];
    $query = "SELECT id FROM $table_match WHERE event_id = $id;";
    $result = $dbc->query($query);
    if ($result->num_rows)
        redirect_with_alert('还存在该项目的比赛，无法删除。请先删除相关的比赛。', 'manage.php');
    else {
        $query = "DELETE FROM $table_event WHERE id = $id LIMIT 1;";
        $dbc->query($query);
        if ($dbc->affected_rows) {
            $_SESSION['notify'] = '删除项目成功！';
            $_SESSION['notify_type'] = 'info';
            redirect('manage.php');
        } else {
            redirect_with_alert('出现错误，请联系系统管理员！', 'manage.php');
        }
    }
    break;

case $ADD_GRADE:
    $grade = escape_data($_REQUEST['grade']);
    $query = "INSERT INTO $table_grade VALUES(NULL, '$grade');";
    $dbc->query($query);
    if ($dbc->affected_rows) {
        $_SESSION['notify'] = '添加年级成功！';
        $_SESSION['notify_type'] = 'info';
        redirect('manage.php');
    } else {
        redirect_with_alert('出现错误，请联系系统管理员！', 'manage.php');
    }
    break;

case $DEL_GRADE:
    $id = (int)$_REQUEST['id'];
    $query = "SELECT id FROM $table_match WHERE grade_id = $id;";
    $result = $dbc->query($query);
    if ($result->num_rows)
        redirect_with_alert('还存在该年级的比赛，无法删除。请先删除相关的比赛。', 'manage.php');
    else {
        $id = (int)$_REQUEST['id'];
        $query = "DELETE FROM $table_grade WHERE id = $id LIMIT 1;";
        $dbc->query($query);
        if ($dbc->affected_rows) {
            $_SESSION['notify'] = '删除年级成功！';
            $_SESSION['notify_type'] = 'info';
            redirect('manage.php');
        } else {
                redirect_with_alert('出现错误，请联系系统管理员！', 'manage.php');
        }
    }
    break;

default:
    redirect_with_alert('呃，你没有选择功能...', 'manage.php');
}
?>
