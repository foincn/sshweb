<?php
/*
	*���ܣ������ʻ��й���Ϣ������·��
	*�汾��2.0
	*���ڣ�2008-08-01
	'˵����
	'���´���ֻ�Ƿ����̻����ԣ��ṩ���������룬�̻����Ը����Լ���վ����Ҫ�����ռ����ĵ���д,����һ��Ҫʹ�øô��롣
	'�ô������ѧϰ���о�֧�����ӿ�ʹ�ã�ֻ���ṩһ���ο���
*/

//////////ҳ�湦��˵��////////////
//��ҳ�������ò��ᱻ�����䶯����Ϣ��
//����partner��security_code��seller_emailͨ����վ��̨����������̬��ȡ��
//////////////////////////////////

$partner        = "2088002473321794";       //�������ID
$security_code  = "nwxjivs0mednwbni1g9shcdmo3m1p4kd";       //��ȫ������
$seller_email   = "kecker.d2@gmail.com";       //����֧�����ʻ�
$_input_charset = "GBK";  //�ַ������ʽ  Ŀǰ֧�� GBK �� utf-8
$sign_type      = "MD5";    //���ܷ�ʽ  ϵͳĬ��(��Ҫ�޸�)
$transport      = "http";  //����ģʽ,����Ը����Լ��ķ������Ƿ�֧��ssl���ʶ�ѡ��http�Լ�https����ģʽ
$notify_url     = "http://www.fan-qiang.com/sshweb/alipay/notify_url.php"; //���׹����з�����֪ͨ��ҳ�� Ҫ�� http://��ʽ������·��
$return_url     = "http://www.fan-qiang.com/sshweb/alipay/return_url.php"; //��������ת��ҳ�� Ҫ�� http://��ʽ������·��
$show_url       = "http://www.fan-qiang.com/"        //����վ��Ʒ��չʾ��ַ

/** ��ʾ����λ�ȡ��ȫУ����ͺ���ID
1.���� www.alipay.com��Ȼ���½�����ʻ�($seller_email).
2.���̼ҷ���.��������������Կ���
*/
?>