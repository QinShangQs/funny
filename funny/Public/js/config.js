
var funnyConfig = {
		up2QiniuUrl: "http://192.168.12.104/funny/funny/index.php/home/api/save?key=",
		uploadPath:"http://192.168.12.104/funny/funny/Uploads/"
}
$.ajaxSetup({
    async: false
});

var isWeixin = navigator.userAgent.toLowerCase().match(/MicroMessenger/i) ? true : false;