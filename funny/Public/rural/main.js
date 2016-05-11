function init() {
	document.getElementById('inputbox').style.height = window.innerHeight
			+ "px";
}
init();

var adindex = Math.floor(Math.random() * 6 + 1);
var preLoader = function(sourceArr, callback) {
	this.resourceCnt = sourceArr.length || 0;
	this.loadIndex = 0;
	this.imgObg = [];
	this.callback = callback;
	this.finishCnt = 0;

	this.preLoad = function(path, index) {
		var self = this;
		var img = new Image();
		img.crossOrigin = '';
		img.onload = function() {
			self.imgObg[index] = img;
			self.finishCnt++;
			if (self.self.finishCnt >= self.resourceCnt) {
				self.callback && self.callback(self.imgObg);
			}
		};
		img.src = path;
	}
	this.loadStart = function() {
		var self = this;
		for (var i = 0; i < this.resourceCnt; i++) {
			self.preLoad(sourceArr[self.loadIndex], self.loadIndex);
			self.loadIndex++;
		}
	}
	this.loadStart();
};
submitBtn.onclick = function() {
	var name = document.getElementById('input').value;
	if (!name) {
		alert("姓名不能为空！");
		return true;
	}
	var flag = false;
	for (var i = 0; i < name.length; i++) {
		var c = name.charCodeAt(i);
		if ((c >= 0x0001 && c <= 0x007e) || (0xff60 <= c && c <= 0xff9f)) {
			flag = true;
			break;
		}
	}
	if (flag) {
		alert("只能输入中文！");
		return true;
	}
	// 计算name为几个字
	var number = name.length;
	if (number < 2 || number > 4) {
		alert("请输入正确的名字！");
		return true;
	}

	var imgBg3 = imgPath + number + '-ad' + adindex + '.png';
	var imgBgLocal3 = imgPathLocal + number + '-ad' + adindex + '.png';
	var path = imgName + "/text/" + name + "/number/" + number + "/case/"
			+ adindex;
	adindex++;
	if (adindex > 6) {
		adindex = 1;
	}
	removeClass(page1, 'active');
	addClass(page2, 'active');

	resultImg.removeAttribute("src");
	preLoader([ imgBg1, imgBg2, imgBg3, path ], function(imgObj) {
		var cross = drawCanvas(imgObj);
		if (cross) {
			preLoader([ imgBgLocal1, imgBgLocal2, imgBgLocal3, path ],
					function(imgObj) {
						drawCanvas(imgObj);
					})
		}
	})
}
function drawCanvas(imgObj) {
	var c = document.createElement('canvas');
	c.width = 900;
	c.height = 675;
	var ctx = c.getContext("2d");
	ctx.drawImage(imgObj[0], 0, 0);
	ctx.drawImage(imgObj[2], 0, 0, 400, 140, 85, 140, 760, 266);
	ctx.drawImage(imgObj[3], 0, 0, 400, 140, 85, 140, 760, 266);
	ctx.drawImage(imgObj[1], 0, 0);
	try {
		var canvasData = c.toDataURL("image/jpeg", 0.9);
		canvasEnd(canvasData);
		return false;
	} catch (e) {
		return true;
	}
}
function canvasEnd(img) {
	if (!/data:image\/(png|jpeg)/im.test(img)) {
		showErr();
		return true;
	}
	up2Qiniu(img, qnToken, function(result) {
		if (!result.hasOwnProperty('key')) {
			showErr(result['error'] + "<br>请刷新重试");
			return true;
		}
		var path = qiniupath + result.path;
		var imgTemp = new Image();
		imgTemp.onload = function() {
			removeClass(page2, 'active');
			addClass(page3, 'active');
			resultImg.setAttribute('src', path);
		};
		imgTemp.src = path;
	})
}

function showErr(string) {
	var errString = string || "Sorry!暂不支持canvas相关操作<br>请升级微信版本或在浏览器中打开";
	document.getElementById('loading').style.opacity = "0";
	document.getElementById('loading-text').innerHTML = errString;
}

document.getElementById('btn-back').addEventListener('click', function() {
	removeClass(page3, 'active');
	addClass(page1, 'active');
})

shareBtn.addEventListener('click', function() {
	if (isWeixin) {
		sharetipAni();
	} else {
		var img = document.getElementById('result').src;
		shareToplatform(img);
	}
})
function sharetipAni() {
	var dom = document.getElementById('tips');
	if (!hasClass(dom, 'bounce')) {
		addClass(dom, 'bounce');
		setTimeout(function() {
			removeClass(dom, 'bounce');
		}, 1200);
	}
}

function hasClass(elements, cName) {
	return !!elements.className
			.match(new RegExp("(\\s|^)" + cName + "(\\s|$)"));
};

function addClass(elements, cName) {
	if (!hasClass(elements, cName)) {
		elements.className += " " + cName;
	}
	;
};

function removeClass(elements, cName) {
	if (hasClass(elements, cName)) {
		elements.className = elements.className.replace(new RegExp("(\\s|^)"
				+ cName + "(\\s|$)"), " ");
	}
	;
};
