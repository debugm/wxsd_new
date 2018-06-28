<?php
return array(
    'LOAD_EXT_CONFIG' => 'website,db,tags,route,disable,version',
	'MODULE_ALLOW_LIST'   => array('Home','User','Admin','Install','Weixin','Pay'),
    'DEFAULT_MODULE' => 'Home',
    'URL_MODEL' => 2, 
    'URL_PATHINFO_DEPR' => '_', 
    'TMPL_TEMPLATE_SUFFIX' => '.tpl',
    'URL_HTML_SUFFIX' => 'html',
    'APP_FILE_CASE' => true,
    'TOKEN_ON'      =>    true,
    'TMPL_L_DELIM' => '<{',
    'TMPL_R_DELIM' => '}>'
);
?>