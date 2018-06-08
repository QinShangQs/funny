<?php
return array (
		'WX_APPID' => 'wx1a6d72cb63c2e01b', // 微信APPID
		'WX_SECRET' => '15fa82877812dfbcf1543e4c40cf97e3', // 微信SECRET
		 //A域名地址
		
		'A_DOMAIN_URL' => 'http://a.funny.tunnel.qydev.com/index.php/article/jump?to=',
		'B_DOMAIN_URI' => "http://b.funny.tunnel.qydev.com/index.php/",
		 //返回事件跳转地址列表
		'BACK_URLS' => array(
			'http://www.baidu.com',
			'http://www.taobao.com',
			'http://www.jd.com'
		),
		//底部banner调整地址
		'BANNER_URL' => 'http://z.cn',
		
		'URL_ROUTER_ON' => true,
		'URL_ROUTE_RULES'=>array(
			'video/:vid' => 'video/index',
		),
		
		'VIDEOS' => array(
			'b0565ov23h8' => array(
				'vid' => 'b0565ov23h8',
				'preview' => 'http://shp.qpic.cn/qqvideo_ori/0/b0565ov23h8_496_280/0',
				'title' => '高中生被殴打退校🌂,4年后的校聚会,全场被吓傻...'
			),
			'h0670wv1gdo' => array(
				'vid' => 'h0670wv1gdo',
				'preview' => 'http://puui.qpic.cn/vpic/0/h0670wv1gdo_160_90_3.jpg/0',
				'title' => '美女董事长在酒店吃饭被讹50万 一怒之下调来'
			),
			'd0530w1ar19' => array(
				'vid' => 'd0530w1ar19',
				'preview' => 'http://shp.qpic.cn/qqvideo_ori/0/d0530w1ar19_496_280/0',
				'title' => '社会大哥被打，老婆惨遭摧残，大哥一怒之下将所有混混......'
			),
			't0674vlfawu' => array(
				'vid' => 't0674vlfawu',
				'preview' => 'http://shp.qpic.cn/qqvideo_ori/0/l063073qdvn_496_280/0',
				'title' => '富家子弟放弃少爷身份去打工，爱上女老板'
			),
			'i06147oenrh' => array(
				'vid' => 'i06147oenrh',
				'preview' => 'http://shp.qpic.cn/qqvideo_ori/0/i06147oenrh_496_280/0',
				'title' => '富豪跟女秘书去喝酒，其老公得知赶来，一怒之下将男子......'
			),
			'b0654n2c6km' => array(
				'vid' => 'b0654n2c6km',
				'preview' => 'http://shp.qpic.cn/qqvideo_ori/0/b0654n2c6km_496_280/0',
				'title' => '小伙骑单车去买奔驰遭遇拜金前女友被嘲笑穷装B，结果拿钱砸哭前女友......'
			),
		)
)
;
/*
return array (
		'WX_APPID' => 'wxa1aeb7b640231617', // 微信APPID
		'WX_SECRET' => '2899a0b817dc17e63825fa5c5ada1cdb', // 微信SECRET
		//A域名地址
		'A_DOMAIN_URL' => 'http://a.58laoxiang.com/article/jump?to=',
		//'A_DOMAIN_URL' => 'http://pmm.people.com.cn/c?d=people&i=z1862,803482,12609&fr=groupmessage&u=',
		'B_DOMAIN_URI' => "http://b.58laoxiang.com/",
		//返回事件跳转地址列表
		'BACK_URLS' => array(
				'http://www.baidu.com',
				'http://www.taobao.com',
				'http://www.jd.com'
		),
		//底部banner调整地址
		'BANNER_URL' => 'http://z.cn',
		'URL_ROUTER_ON' => true,
		'URL_ROUTE_RULES'=>array(
			'video/:vid' => 'video/index',
		),
		
		'VIDEOS' => array(
		)
)
;
*/