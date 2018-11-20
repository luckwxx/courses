<?php

// 数据库配置
define('DB_NAME', 'courses');
define('DB_USER', 'courses');
define('DB_PASSWORD', 'courses');
define('DB_HOST', '127.0.0.1');


$configDB['host'] = DB_HOST;
$configDB['username'] = DB_USER;
$configDB['password'] = DB_PASSWORD;
$configDB['dbname'] = DB_NAME;
$config['db'] = $configDB;

// 默认控制器和操作名
$config['defaultController'] = 'Item';
$config['defaultAction'] = 'index';

return $config;

