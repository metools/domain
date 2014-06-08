<?php

$arr = '0123456789abcdefghijklmnopqrstuvwxyz';
for ($i = 0; $i < 36; $i++) {
	if (is_numeric($arr[$i])) {
		continue; //这里可以不要数字开头的
	}
	exec("cat source/words | grep ^{$arr[$i]} > source/5words/{$arr[$i]}.txt");
}

