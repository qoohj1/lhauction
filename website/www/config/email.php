<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['protocol']     = 'sendmail';
$config['mailpath']     = '/usr/sbin/sendmail';
$config['charset']      = 'UTF-8';
$config['wordwrap']     = TRUE;
// PHPMailer Config
$config['smtpauth']     = TRUE;
$config['issmtp']       = TRUE;
$config['mailhost']     = 'smtp.163.com';
$config['mailuser']     = 'qoohj1@163.com';
$config['mailpswd']     = 'asd321';
$config['mailport']     = 465;
$config['smtpsecure']   = 'ssl'; // or tls;
$config['mailfrom']     = 'qoohj1@163.com';
$config['mailfromname'] = 'sjz';
$config['wordwrap']     = 0;
$config['maildebug']    = 1;
$config['mailtemp']     = FCPATH.APPPATH.'views/';
$config['error_log']    = 'www/logs/email/';
$config['charset']      = 'utf-8';
$config['encoding']     = 'base64';

// 系统信息接收者
$config['sys_receive']  = array('113182191@qq.com');
