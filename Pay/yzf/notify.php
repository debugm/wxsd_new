<?php

file_put_contents('./yzf.log.txt',date('Y-m-d H:i:s').json_encode($_GET).PHP_EOL,FILE_APPEND);

?>
