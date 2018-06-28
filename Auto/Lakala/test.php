
<?php

$amt = "3,000.00";
$amt = str_replace(',', '', $amt);
$amt = floatval($amt);
echo $amt;

?>
