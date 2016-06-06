/* common function */
var isIphone = navigator.userAgent.toLowerCase().match(/iphone/i) ? true : false;
function hasClass(elements, cName) {
	return !!elements.className.match(new RegExp("(\\s|^)" + cName + "(\\s|$)"));
};
function addClass(elements, cName) {
	if (!hasClass(elements, cName)) {
		elements.className += " " + cName;
	};
};
function removeClass(elements, cName) {
	if (hasClass(elements, cName)) {
		elements.className = elements.className.replace(new RegExp("(\\s|^)" + cName + "(\\s|$)"), " ");
	};
};
function toogleClass(elements, cName) {
	if(hasClass(elements, cName)){
		removeClass(elements, cName);
	}else{
		addClass(elements, cName);
	}
}
function Selector(selector){
	var tmp = selector.slice(1);
	if(selector.charAt(0)==='.'){
		return document.getElementsByClassName(tmp)[0];
	}else{
		return document.getElementById(tmp);
	}
}
function ajaxGet(url,callback){
	var xmlHttp = new XMLHttpRequest();
	xmlHttp.open("GET",url,true);
	xmlHttp.onreadystatechange= function(){
		if (xmlHttp.readyState==4 && xmlHttp.status==200){
			// var d= xmlHttp.responseText;
			//$result = JSON.parse(d);
			callback&&callback(xmlHttp.responseText);
		}
	}
	xmlHttp.send();
}
function ajaxPost(url, data, callback, error){
	var postData = data;
	var xhr = new XMLHttpRequest();
	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	if(typeof(postData) === 'object'){
		postData = (function(obj){ // 转成post需要的字符串.
			var str = "";
			for(var prop in obj){
				str += prop + "=" + obj[prop] + "&"
			}
			return str;
		})(postData);
	}
	xhr.onreadystatechange = function(){
		var XMLHttpReq = xhr;
		if (XMLHttpReq.readyState == 4) {
			if (XMLHttpReq.status == 200) {
				var text = XMLHttpReq.responseText;
				callback&&callback( text);
			}else{
				xhr.abort();
				error&&error(XMLHttpReq.status);
			}
		}
	};
	xhr.send(postData);
}


function playAgain(){
	removeClass(page3,'active');
	removeClass(page2,'active');
	addClass(page1,'active');
	document.getElementById('funny-menu-openbtn').style.display = "block";
	document.getElementById('funny-menu-btnbox6').style.display = "none";
	Selector('#inputbox').style.overflow = "visible";
}

function showLoading(){
	removeClass(page1, 'active');
	addClass(page2, 'active');
	resultImg.removeAttribute("src");
	document.getElementById('funny-menu-btnbox6').style.display = "block";
	document.getElementById('funny-menu-openbtn').style.display = "none";
}

shareBtn.addEventListener('click', function(){
	var img = document.getElementById('result').src;
	if (/data:image\/(png|jpeg)/im.test(img)) {
		up2Qiniu(img , qnToken,  function(result){
			if(!result.hasOwnProperty('key')){
				comShowErr(result['error'] + "<br>请刷新重试");
				return true;
			}
			img = qiniupath+ result.key;
			if(isQzone){
				shareToQzone(img);
			}else{
				shareToWeibo(img);
			}
		})
	}else{		
		if(isQzone){
			shareToQzone(img);
		}else{
			shareToWeibo(img);
		}
	}
	
})

function changeshareimg(src){
	shareConfig.pic = shareConfig.pics = src;
}

var comPreLoader = function(sourceArr, callback){
	this.resourceCnt = sourceArr.length || 0;
	this.loadIndex = 0;
	this.imgObg = [];
	this.callback = callback;
	this.finishCnt = 0;

	this.preLoad = function(path, index){
		var self = this;
		var img = new Image();
		img.crossOrigin = '';
		img.onload = function(){
			self.imgObg[index] = img ;
			self.finishCnt ++;
			if(self.self.finishCnt >= self.resourceCnt){
				self.callback&&self.callback(self.imgObg);
			}
		};
		img.src = path;
	}
	this.loadStart = function(){
		var self = this;
		for(var i=0; i<this.resourceCnt; i++){
			self.preLoad(sourceArr[self.loadIndex],self.loadIndex);
			self.loadIndex++;
		}
	}
	this.loadStart();
};

var comCanvasEnd = function(img){
	if (!/data:image\/(png|jpeg)/im.test(img)) {
		comShowErr();
		return true;
	}
	if(isIphone){
		removeClass(page2, 'active');
		addClass(page3, 'active');
		resultImg.setAttribute('src', img);

		return true;
	}
	up2Qiniu(img,qnToken,  function(result){
		if(!result.hasOwnProperty('key')){
			comShowErr(result['error'] + "<br>请刷新重试");
			return true;
		}
		var path = qiniupath+ result.path;
		var imgTemp = new Image();
		imgTemp.onload = function(){
			removeClass(page2, 'active');
			addClass(page3, 'active');
			resultImg.setAttribute('src', path);
			changeshareimg(path);
		};
		imgTemp.src = path;
	})
};

var comShowErr = function(string){
	var errString = string || "Sorry!暂不支持canvas相关操作<br>请升级微信版本或在浏览器中打开";
	document.getElementById('loading').style.opacity = "0";
	document.getElementById('loading-text').innerHTML =  errString;
}