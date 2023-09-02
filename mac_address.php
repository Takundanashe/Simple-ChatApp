
<?php
  
// PHP code to get the MAC address of Server
$MAC = exec('getmac');
  
// Storing 'getmac' value in $MAC
$MAC = strtok($MAC, ' ');
  
// Updating $MAC value using strtok function, 
// strtok is used to split the string into tokens
// split character of strtok is defined as a space
// because getmac returns transport name after
// MAC address   
echo "$MAC";
?>