<?php
/**
1）merchant_private_key，商户私钥;merchant_public_key,商户公钥；商户需要按照《密钥对获取工具说明》操作并获取商户私钥，商户公钥。
2）demo提供的merchant_private_key、merchant_public_key是测试商户号1111110166的商户私钥和商户公钥，请商家自行获取并且替换；
3）使用商户私钥加密时需要调用到openssl_sign函数,需要在php_ini文件里打开php_openssl插件
4）php的商户私钥在格式上要求换行，如下所示；
*/
		$merchant_private_key='-----BEGIN PRIVATE KEY-----
MIICdgIBADANBgkqhkiG9w0BAQEFAASCAmAwggJcAgEAAoGBALeLoBSrzEgn40Xqh
IuGec3ElxESBHCk7Ni4OMfhQ4mHiRpkNX2IV9Ra65Rn1EOBMc5MPUvg1kaMnL+nBJ
W390WzwMs7eFrISUS8Dh53zRetWBYJvExeTFtaaB9tKpTzPVNxaAj3AX8IQoUHv0I
UuBwsPO3ufBNnpS4LSBG7FjFvAgMBAAECgYEAqHpc1bygxjb+8oWDZwNoOQ3UURIF
y1RIJ+JqFGdc9BfaLMSBKRqG7GEMz2vDNreXfTMULNtUNOwLUgzAM6HrMZxzkHrak
DgwtFS+lZhfLh3fRss7TN/VKDUErOAt2NmhxvbRIXttYZRE3SuIXKQutpQDJx07MD
qzj3G1Em1AkEkCQQDk9fTz2iHF6G5I2TnaFJbBK2wOnxbGJzpA3tf7ddycDrczJgw
wuuoYMqlWgb6ttCikWSt0T4IzDK4oo4LH5x7zAkEAzTimvDToD8Zm+Xb4srkENbD8
pY5lxDCNDI/HGRPBJcBcF8DZB6mbpEX3I4ql97+xjvjXTnJ85gXATe5aXgGalQJAK
9A5MJS0U8fXms8et/Gqq4pgoielVwPYrOM312HFdoOGYR5NxOFvvHOtXeV0FI9eG5
0IqLgyRQyPIy2u8Av1KwJARdOfz+wEhdGRGhKj/lO7nfUxkbdI4x9N7tdA/
ERfdNPlweNJNTU9kwCHXZ2AaTLdXHNI9xU3cCDG1P1j3BaZnQJAKyFN8ir9DisdBk7W/
O4xhIS+Q8ywpTcsH+KKXzv7P01sjT7S3Gd9BXWAsZ0roWvN2O+mpa15eTfcKQ4fdTchhA==
-----END PRIVATE KEY-----';

	//merchant_public_key,商户公钥，按照说明文档上传此密钥到多的宝商家后台，位置为"支付设置"->"公钥管理"->"设置商户公钥"，代码中不使用到此变量
	//demo提供的merchant_public_key已经上传到测试商家号后台
	$merchant_public_key = '-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCZ0elraW8BGvZZc55KHCIIA5sT
YylJf4XlBaJzUEjDb+KEIu90vdQKMlgPbBsvyIUemB1Udx4wBwkZ2+AB/di9rLiO
W3qY3wtI5eGN/75meexvzADtnThjgkzofsi2lpd6sgX/y1e+3d/UZcUiYlhjPt2M
SLYtGFycZ4bHVLO/xwIDAQAB
-----END PUBLIC KEY-----';
	
/**
1)ddbill_public_key，多的宝公钥，每个商家对应一个固定的多的宝公钥（不是使用工具生成的密钥merchant_public_key，不要混淆），
即为多的宝商家后台"公钥管理"->"多的宝公钥"里的绿色字符串内容,复制出来之后调成4行（换行位置任意，前面三行对齐），
并加上注释"-----BEGIN PUBLIC KEY-----"和"-----END PUBLIC KEY-----"
2)demo提供的ddbill_public_key是测试商户号1111110166的智付公钥，请自行复制对应商户号的智付公钥进行调整和替换。
3）使用多的宝公钥验证时需要调用openssl_verify函数进行验证,需要在php_ini文件里打开php_openssl插件
*/
	$ddbill_public_key = '-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDMKS1ZT/2KyVRUnRKg0GvReZpV6ZSRJk4/9y0X5L7KHaAevY1Wsp/
rVSVYkpi+wSnYBQfheQ0vyWB90uxB4xPyWgC5JISbv1+iQ44fwnJC1HlZvj0w/Zuk9NN2b/ACREDylpe4Rf/T/
teWTWxOa5BZv10Um9pWV8YnqlPEnkPThQIDAQAB
-----END PUBLIC KEY-----';





	



?>
