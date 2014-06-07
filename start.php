<?php

$arr = '0123456789abcdefghigklmnopqrstuvwxyz';
for ($i = 0; $i < 36; $i++) {
	$first = strtoupper($arr[$i]);
	exec('/server/php/bin/php -c /server/php/conf/php.ini ./check.php ' . $first . ' > /dev/null 2>&1 &');
}