多进程检查域名是否可以注册。

例：查找5字母的.com可注册域名（启动260个进程同时跑）

1. 创建必要目录：
	mkdir source （存域名源文件）
	mkdir result （存未被注册的域名）
	mkdir error （存被注册了的域名）

2. 生成source文件，即按字母数字有序全排列
	1）修改source目录下的create.c，稍微看看就知道如何生成了，例子是字母数字的5位全排列
	2）编译：gcc -o create create.c
	3）生成words文件：./create > source/words
	4）如果不要包含数字的可以如此处理：
		cat words | grep -v '[0-9]' > words_az
		mv words_az words
	5）建立目录：mkdir 5words
	6）按字母数字开头分割到5words文件夹，执行：php deal.php
	7）因为5字母的数据很多，分成26个文件，每个文件也有456976个，所以这里为了多开进程（程序会按照source/5words目录
	   里的文件数起进程，多少个文件就会起多少个进程，加快检查速度），这里再将每个文件分成10个小文件（这样会启动260个进程）
	   执行：
	   		cd source/5words
	   		for file in `ls`;do split -a 1 -l 45698 $file $file;done; （处理A.txt文件，将其按每行45698生成10个前缀为A.txt的文件）
	   		rm -rf *.txt （删除原文件）

3. 在error和result里建立5words文件夹：
	mkdir error/5words （存被注册了的域名）
	mkdir result/5words （存未被注册的域名）

4. 启动脚本：
	php start.php

5. 监控：
	ps aux | grep check.php | wc -l （检查当前运行的进程数）
	tail -f result/5words/com/* （查看生成的未注册域名）
	tail -f error/5words/com/* （查看生成的已注册域名）
