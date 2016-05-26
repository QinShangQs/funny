<?php
return array (
		// '配置项'=>'配置值'
		'DB_TYPE' => 'mysql', // 数据库类型
		'DB_HOST' => '127.0.0.1', // 服务器地址
		'DB_NAME' => 'funny', // 数据库名
		'DB_USER' => 'root', // 用户名
		'DB_PWD' => 'root', // 密码
		'DB_PORT' => 3306, // 端口
		'DB_PREFIX' => 'ff_', // 数据库表前缀
		
		'DEFAULT_MODULE' => 'Home', // 默认模块
		                            // 'URL_MODEL' => 2, // URL模式
		'MODULE_ALLOW_LIST' => array (
				'Home',
				'Article',
				'Sxzj1ovr' 
		),
		
		'IMAGE_PATH' => './Uploads/funny/',
		'IMAGE_SIZE_LIMIT' => 500, // 显示image_path路径文件夹大小，单位M
		'WX_APPID' => 'wx1a6d72cb63c2e01b', // 微信APPID
		'WX_SECRET' => '15fa82877812dfbcf1543e4c40cf97e3', // 微信SECRET
		'A_SIET_DOMAIN' => 'http://192.168.2.103/funny/funny/', // A（主）站点地址
		'B_SITE_URI' => 'http://192.168.2.103:888/funny/funny/index.php/',// B站点的地址
		'B_SITE_URI_TIMEOUT' => 3,//B站点地址控制器首页失效时间，单位秒
		'B_SITE_URI_SECOND_TIMEOUT' => 60,//B站点地址控制器非首页失效时间，单位秒
// 		'A_SIET_DOMAIN' => 'http://192.168.12.119/funny/funny/',//A（主）站点地址
// 		'B_SITE_URI'=> 'http://192.168.12.119:9999/index.php/'//B站点的地址

// 		'A_SIET_DOMAIN' => 'http://show.zmypy.com/funny/', // A（主）站点地址
// 		'B_SITE_URI' => 'http://show.zdypy.com/funny/index.php/',// B站点的地址
) 
                                                                 
;