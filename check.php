<?php
set_time_limit(0);
ini_set('display_errors', 'on');error_reporting(E_ALL^E_NOTICE^E_WARNING^E_STRICT);

$char = $argv[1];

$checkDomain = array('so', 'me', 'co');

startProcess($char);

function startProcess($char) {
	global $checkDomain;

	$fileSourceHandle = fopen("./source/2words/$char.txt", 'rb');
	while (!feof($fileSourceHandle)) {
		$domain = trim(fgets($fileSourceHandle, 1024));
		if (!$domain) {
			continue;
		}

		foreach ($checkDomain as $key => $value) {
			$fileResultDir = "./result/2words/$value";
			$fileErrorDir = "./error/2words/$value";
			if (!is_dir($fileResultDir)) {
				mkdir($fileResultDir);
			}
			if (!is_dir($fileErrorDir)) {
				mkdir($fileErrorDir);
			}
			$_domain = "$domain.$value";
			if (check($_domain)) {
				file_put_contents("$fileResultDir/$char.txt", $_domain . "\n", FILE_APPEND);
			} else {
				file_put_contents("$fileErrorDir/$char.txt", $_domain . "\n", FILE_APPEND);
			}
		}
	}
	fclose($fileSourceHandle);
}

function check($domain) {
	$url = 'http://www.xinnet.com/domain/check.do?method=check';
	$r = send($url, "domainName=$domain");
	return $r == 'true';
}

function send($url, $data) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
	curl_setopt($ch, CURLOPT_TIMEOUT, 300);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	$r = curl_exec($ch);
	curl_close($ch);
	return $r;
}