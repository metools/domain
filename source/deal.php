<?php

$arr = '0123456789abcdefghigklmnopqrstuvwxyz';
for ($i = 0; $i < 36; $i++) {
	$first = strtoupper($arr[$i]);
	exec("cat words | grep ^{$first} > 2words/{$first}.txt");
}

