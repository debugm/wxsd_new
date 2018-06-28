<?php

 $xml = file_get_contents('php://input');


file_put_contents("./log.txt",date('Y-m-d H:i:s').$xml.PHP_EOL,FILE_APPEND);

?>
