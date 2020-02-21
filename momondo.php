<?php
// How do we make momondo talk to sas?
// curl
// file_get_contents open a file
// file_get_contents open a URL
$sData = file_get_contents('http://localhost/kea/momondo_v1/sas.php');
//{"status":1,"price":500}
echo $sData;
