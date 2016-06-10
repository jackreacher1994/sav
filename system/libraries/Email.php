<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 $config['useragent']        = 'CodeIgniter';
$config['protocol']         = 'smtp';        
 $config['mailpath']         = '';
 $config['smtp_crypto']      = 'ssl';
$config['smtp_host']        = 'smtp.gmail.com';
$config['smtp_user']        = 'noreply@ved.com.vn';
$config['smtp_pass']        = 'kqkolqlhaoaqdell';
$config['smtp_port']        = 465;
$config['smtp_timeout']     = 5;
$config['wordwrap']         = TRUE;
$config['wrapchars']        = 76;
$config['mailtype']         = 'html';
$config['charset']          = 'utf-8';
$config['validate']         = FALSE;
$config['priority']         = 3;
$config['crlf']             = '\\r\
';
$config['newline']          = '\\r\
';
$config['bcc_batch_mode']   = FALSE;
$config['bcc_batch_size']   = 200;

/* End of file email.php */
/* Location: ./application/config/email.php */
?>