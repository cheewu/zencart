<?php
/*
*#########################################
* PHPCMS File Manager
* Copyright (c) 2004-2006 phpcms.cn
* Author: Longbill ( http://www.longbill.cn )
* longbill.cn@gmail.com
*#########################################
*/

include_once("info.php");
$welcome="��ӭʹ�� PHPCMS�ļ������� v4.03";			//��½�ɹ������ʾ��Ϣ
$preload = 0;			//�ͻ����Ƿ�����Ԥ���أ����ú󣬿ͻ����ٶȼӿ죬���������������أ�
$jumpfiles="";			//��Ҫ�������ת���ļ�����ʱ����֧�֣�
$max_time_limit=60; 			//ҳ��ִ���ʱ��(��)
$charset="GB2312";			//Ĭ�ϱ���
$imgmax=70;			//ͼƬ������
$cookieexp = 60;			//�ͻ��˼��������ʱ��
$v=403;				//�ڲ��汾��
$version = "4.03";			//�汾
$sitewidth = 760;			//��վ������
$editfiles="|php|php3|asp|txt|jsp|inc|ini|pas|cpp|bas|in|out|htm|html|js|htc|css|c|sql|bat|vbs|cgi|dhtml|shtml|xml|xsl|aspx|tpl|";
				//���ñ༭���༭���ļ�����
$searchfiles = $editfiles;		//�����������ݵ��ļ�����

$language = "simple_chinese.lang.php"; 	//�����ļ�
$host_charset = "GB2312";		//�������ļ�������
?>