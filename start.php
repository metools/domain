<?php

if ($handle = opendir('./source/5words')) {
    while (false !== ($file = readdir($handle))) {
        if ($file != '.' && $file != '..') {
            exec('/server/php/bin/php -c /server/php/conf/php.ini ./check.php ' . $file . ' > /dev/null 2>&1 &');
        }
    }
    closedir($handle);
}