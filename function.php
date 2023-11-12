<?php 
 
function rupiah($angka){
	
	$hasil_rupiah = number_format($angka,2,',','.');
	return $hasil_rupiah;
 
}

function getIpAddress()  
{  
  $ipAddress = '';  
  if (! empty($_SERVER['HTTP_CLIENT_IP'])) {  
	// to get shared ISP IP address  
	$ipAddress = $_SERVER['HTTP_CLIENT_IP'];  
  } else if (! empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
	// check for IPs passing through proxy servers  
	// check if multiple IP addresses are set and take the first one  
	$ipAddressList = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);  
	foreach ($ipAddressList as $ip) {  
	  if (! empty($ip)) {  
		// if you prefer, you can check for valid IP address here  
		$ipAddress = $ip;  
		break;  
	  }  
	}  
  } else if (! empty($_SERVER['HTTP_X_FORWARDED'])) {  
	$ipAddress = $_SERVER['HTTP_X_FORWARDED'];  
  } else if (! empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])) {  
	$ipAddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];  
  } else if (! empty($_SERVER['HTTP_FORWARDED_FOR'])) {  
	$ipAddress = $_SERVER['HTTP_FORWARDED_FOR'];  
  } else if (! empty($_SERVER['HTTP_FORWARDED'])) {  
	$ipAddress = $_SERVER['HTTP_FORWARDED'];  
  } else if (! empty($_SERVER['REMOTE_ADDR'])) {  
	$ipAddress = $_SERVER['REMOTE_ADDR'];  
  }  
  return $ipAddress;  
}  
return getIpAddress();  

function pilter ($inputan) {

    $asli =
        array(
            'SELECT',
			'LIMIT',
            'JOIN',
            'UNION',
            'FROM',
            'OR ',
            '1=1',
            'TABLE',
            'DROP',
            'ORDER',
            'BY ', 
            'database',
            'user',
            'hostname',
            'tmpdir',
            'datadir',
            'basedir',
            'information',
            'schema',
            'session_user',
            'session',
            'group',
            'concat',
            'coloum',
            'password',
            '0x',
            '<script>',
            '</script>',
            'script',
            'function',
            'window',
            'iframe',
            'document',
            'header',
            'location',
            'cookie',
            '<html>',
            '</html>',
            '<',
            '>',
            '[',
            ']',
            '(',
            ')',
            '|',
            '~',
            '^',
            '-',
            ':',
            ';',
            '!',
            '*',
            '=',
            '--',
            '+',
            '`',
            '%',
            ',',
            '.',
            '#',
            '%23',
            '%20',
            '@@',
            '()',
            '_',
            '{',
            '}',
			'/'
        );
            
      
$diganti = array(
    '',
	'',
	'',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    ''
       );
    
    return strtolower(addslashes(str_ireplace($asli, $diganti, $inputan)));  

};