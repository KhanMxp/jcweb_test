<?php
return array(
	//'配置项'=>'配置值'
    'DEFAULT_MODULE'	=> 'Home',
    'MODULE_ALLOW_LIST'	=> array('Home','Admin','Yan','Sheng'),
    'APP_SUB_DOMAIN_DEPLOY'   =>    TRUE,
    'APP_SUB_DOMAIN_RULES'    =>    array(
        'www.supermat.com.cn' => array('Home/'),
        'www.supersenray.com.cn'   => array('Sheng/'),
        'www.nirio.com.cn'   => array('Yan/'),
    )
);