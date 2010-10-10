<?php

### 数据库相关设置 ###

define('DB_USER', 'user');
define('DB_PASWORD', 'password');
define('DB_HOST', 'localhost');
define('DB_NAME', 'sports');

# 表名前缀（可留空）
$table_prefix = '2010_';


### 事件相关设置 ###

# 事件前缀（可留空）
$event_prefix = '北京市十一学校';

# 事件名称
$event_name = '2010年秋季运动会';

# 事件短名称（用于 title 等）
$event_shortname = '2010年秋季运动会';

# 在首页显示的欢迎辞（可留空）
$greet = '<p>欢迎使用运动会分数查询系统！</p>';

# 填写说明
$fill_help = '<p>填写说明：</p><p>1.班级 请只输入一个半角阿拉伯数字，如“11”。建华的班级在前面加上“建华”，如“建华3”。</p><p>2.名次 如有并列的情况，请手工修改名次。</p><p>3.成绩 成绩后面的单位，如“米”、“秒”等不用填写。时间格式统一为使用半角英文单双引号，例如“1\'02"07”、“58"25”。</p><p>4.其他 如遇其他问题，请发邮件至 HCC 支持邮箱（hcc@shiyihcc.com）咨询。</p><p>对您参与成绩填写工作表示感谢！</p>';


### 其他设置 ###

# 管理员密码
$admin_password = 'miao!!!';

# 是否显示调试信息
$debug = FALSE;

# 若在一个服务器上存在多个 Spoquery，请设置此项
$app_unique_id = '1_L0v3_LM7';

?>
