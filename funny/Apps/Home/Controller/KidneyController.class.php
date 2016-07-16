<?php
namespace Home\Controller;
use Think\Controller;

use Org\Net\Http;
use Think\Image;
class KidneyController extends BaseController {
	static $localPath = "./Uploads/funny/kidney/";
    public function index(){
    	parent::setWxConfig('我的性格标签', "kidney/1.png", '就是这么任性，赶快生成我的标签！');
        $this->display ();
    }
    
    public function builderText($name, $birthday){
    	$local = static::getResultImage($name, $birthday);
    	$water = "./Public/kidney/erweima.png";
    	$saveName = static::$localPath."water-".time().".png";
    	$image = new \Think\Image();
    	$image->open($local);
    	$image->water($water,\Think\Image::IMAGE_WATER_SOUTHWEST,100)->save($saveName);
    	//echo $saveName;
    	echo str_replace('./', __ROOT__ .'/', $saveName) ;
    }
    
    private static function getResultImage($name, $birthday){
    	
    	if (! file_exists ( $local )) {
    		mkdir ( $local, 0777, true );
    	}
    	$remoteUrl['ImageURL'] =  'http://xg.dkrgh.cn/build.php?name='.urlencode($name).'&birthday='.$birthday;
    	$local = static::$localPath. "k-".time().'.jpg';
    	
    	Http::curlDownload($remoteUrl['ImageURL'], $local);
    	return $local;
    }
}