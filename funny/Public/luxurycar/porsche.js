var userName = "";
submitBtn.onclick = function() {
	resultImg.style.display = 'none';
	var name = document.getElementById('user-name').value;
	if (!name) {
		alert("姓名不能为空！");
		return true;
	}

	userName = name;
	var path = imgName + name;
	loading.style.display = "block";
	resultImg.removeAttribute("src");
	var gernerator = new orderGenerator(imgBg, path);
	gernerator.getResultImg(function(img) {
		pageHome.style.display = "none";
		pageResult.style.display = "block"

		up2Qiniu(img, qnToken, function(result) {
			var path = qiniupath + result.path;
			var imgTemp = new Image();
			imgTemp.onload = function() {
				loading.style.display = "none";
				btnWrap.style.display = "block";
				resultImg.setAttribute('src', path);
				resultImg.style.display = 'initial';

			}
			imgTemp.src = path;
		})
	})
}

document.getElementsByClassName('return-btn')[0].onclick = function() {
	preId = id;
	pageHome.style.display = "block";
	pageResult.style.display = "none"
	loading.style.display = "block";
	btnWrap.style.display = "none";
}

var orderGenerator = (function() {
	var imgObj = [];
	function orderGenerator(orderPath, namePath) {
		this.imgArr = [ orderPath, namePath ];
		this.finishCnt = 0;
	}
	orderGenerator.prototype.getResultImg = function(callback) {
		var that = this;
		for ( var i in this.imgArr) {
			this.imgLoad(this.imgArr[i], i, function() {
				var img = that.drawCanvas();
				if (img) {
					callback(img);
				}
			});
		}
	}

	orderGenerator.prototype.imgLoad = function(path, index, callback) {
		if (!path)
			return false;
		var self = this;
		var image = new Image();
		image.crossOrigin = "";
		image.onload = function() {
			self.finishCnt++;
			imgObj[index] = image;
			callback();
		};
		image.src = path;
	}

	orderGenerator.prototype.drawCanvas = function() {
		if (this.finishCnt < 2)
			return false;
		var c = document.createElement('canvas');
		c.width = 640;
		c.height = 853;
		var ctx = c.getContext("2d");
		ctx.drawImage(imgObj[0], 0, 0);
		ctx.drawImage(imgObj[1], 350, 750);
		return c.toDataURL();
	}
	return orderGenerator;
}());

// share
shareBtn.onclick = function() {
	console.log('share');
	if (isWeixin) {
		sharetipAni();
	} else {
		var img = document.getElementById('result-img').src;
		shareToplatform(img);
	}
}

function sharetipAni() {
	var dom = document.getElementsByClassName('save-tip')[0];
	addClass(dom, 'bounce-anim')
	setTimeout(removeClass, 3000, dom, 'bounce-anim');
}

function hasClass(obj, cls) {
	return obj.className.match(new RegExp('(\\s|^)' + cls + '(\\s|$)'));
}

function addClass(obj, cls) {
	if (!this.hasClass(obj, cls))
		obj.className += " " + cls;
}
function removeClass(obj, cls) {
	if (hasClass(obj, cls)) {
		var reg = new RegExp('(\\s|^)' + cls + '(\\s|$)');
		obj.className = obj.className.replace(reg, ' ');
	}
}
