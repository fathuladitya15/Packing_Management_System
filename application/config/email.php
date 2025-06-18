<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');  

/* 
| ------------------------------------------------------------------- 
| EMAIL CONFIG 
| ------------------------------------------------------------------- 
| Konfigurasi email keluar melalui mail server
| */  
$config=array();
$config['charset'] = 'utf-8';
$config['useragent'] = 'Codeigniter';
$config['protocol']= "smtp";
$config['mailtype']= "html";
$config['smtp_host']= "mail.tev.co.id";//pengaturan smtp
$config['smtp_port']= "587";
$config['smtp_timeout']= "400";
$config['smtp_user']= "info@tev.co.id"; // isi dengan email kamu
$config['smtp_pass']= "info2017"; // isi dengan password kamu
$config['crlf']="\r\n"; 
$config['newline']="\r\n"; 
$config['wordwrap'] = TRUE;
/* End of file email.php */ 
/* Location: ./system/application/config/email.php */
