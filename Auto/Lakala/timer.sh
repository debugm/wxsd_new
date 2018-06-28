#! /bin/bash  
  
step=3 #间隔的秒数，不能大于60  
  
for (( i = 0; i < 60; i=(i+step) )); do  
    $(php '/home/wwwroot/wxsd.com/Auto/Lakala/handle.php')  
    sleep $step  
done  
  
exit 0  
