<?php
return array (
		'DEFAULT_MODULE' => 'Home', // 默认模块
		//'URL_MODEL' => 2, // URL模式
		'MODULE_ALLOW_LIST' => array('Home','Article'),
		
		'IMAGE_PATH' => './Uploads/funny/',
		'IMAGE_SIZE_LIMIT' => 500,//显示image_path路径文件夹大小，单位M
		'WX_APPID' => 'wx1a6d72cb63c2e01b',//微信APPID
		'WX_SECRET'=> '15fa82877812dfbcf1543e4c40cf97e3',//微信SECRET
		'A_SIET_DOMAIN' => 'http://192.168.2.103/funny/funny/',//A（主）站点地址
		'B_SITE_URI'=> 'http://192.168.2.103:888/funny/funny/index.php/home/'//B站点的地址
);