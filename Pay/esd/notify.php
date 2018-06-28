<?php

	
	$p = file_get_contents("php://input");
	file_put_contents("./log.txt",date('Y-m-d H:i:s').$p."\n",FILE_APPEND);
	
	echo "success";
 	       


?>
