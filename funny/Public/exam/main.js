function init() {
	document.getElementById('inputbox').style.height = window.innerHeight + "px";
}
init();

Selector('.commonbtn-playAgain').style.display = "inline-block";
Selector('.commonbtn-playAgain').innerHTML = "换个性别试试";
if(isWeiXin == 1){
	Selector('.commonbtn-playAgain').style.marginBottom = "15px";
}

function changeContent(){
	if(gender ==  "男"){
		gender = "女";
	}else{
		gender =  "男";
	}
	removeClass(page3, 'active');
	addClass(page2, 'active');
	resultImg.removeAttribute("src");
	
	comPreLoader([imgBg], function(imgObj){
		var cross = drawCanvas(imgObj);
		if(cross){
			comPreLoader([imgBgLocal], function(imgObj){
				drawCanvas(imgObj);
			})
		}
	})
}

var name;
var place;
var gender;
var path;

var nameImg = new Image();


submitBtn.onclick = function() {
	name = document.getElementById('input').value;
	if (!name) {
		alert("姓名不能为空！");
		return true;
	}
	var flag = false;
	for (var i=0; i < name.length; i++) {
		var c = name.charCodeAt(i);
		if ((c >= 0x0001 && c <= 0x007e) || (0xff60<=c && c<=0xff9f)) {
			flag = true;
			break;
		}
	}
	if(flag){
		alert("只能输入中文！");
		return true;
	}
	// 计算name为几个字
	var number = name.length;
	if(number < 2 ){
		alert("请输入正确的名字！");
		return true;
	}
	place = document.getElementById('input2').value;
	if (!place) {
		alert("考场不能为空！");
		return true;
	}

	var dom = document.getElementsByClassName('btnactive');
	if(dom.length > 0){
		gender = dom[0].getAttribute('data');
	}else{
		alert("请选择性别");
		return true;
	}
	path = imgName+"/name/"+name+"/place/"+place;
	showLoading();
	
	nameImg.onload = function(){
		comPreLoader([imgBg], function(imgObj){
			var cross = drawCanvas(imgObj);
			if(cross){
				comPreLoader([imgBgLocal], function(imgObj){
					drawCanvas(imgObj);
				})
			}
		})
	}
	nameImg.src = path;
}
function drawCanvas(imgObj){
	var c=document.createElement('canvas');
	c.width = 800;
	c.height = 1071;
	var ctx=c.getContext("2d");
	ctx.drawImage(imgObj[0], 0, 0);
	ctx.drawImage(nameImg, 0, 0  , 250, 40, 410, 386, 250, 40);
	ctx.drawImage(nameImg, 0, 0  , 250, 40, 410, 386, 250, 40);

	ctx.drawImage(nameImg, 0, 40 , 250, 40, 410, 455, 250, 40);
	ctx.drawImage(nameImg, 0, 40 , 250, 40, 410, 455, 250, 40);

	if(gender ==  "男"){
		ctx.drawImage(nameImg, 0, 80 , 100, 40, 649, 386, 100, 40);
		ctx.drawImage(nameImg, 0, 80 , 100, 40, 649, 386, 100, 40);
	}else{
		ctx.drawImage(nameImg, 100, 80 , 100, 40, 649, 386, 100, 40);
		ctx.drawImage(nameImg, 100, 80 , 100, 40, 649, 386, 100, 40);
	}
	
	try{
		var canvasData = c.toDataURL("image/jpeg", 0.9);
		comCanvasEnd(canvasData);
		return false;
	}catch(e){
		return true;
	}
}

document.getElementById('p1-btn1').addEventListener('click', function(){
	addClass(document.getElementById('p1-btn1'),'btnactive');
	removeClass(document.getElementById('p1-btn2'),'btnactive');
})
document.getElementById('p1-btn2').addEventListener('click', function(){
	addClass(document.getElementById('p1-btn2'),'btnactive');
	removeClass(document.getElementById('p1-btn1'),'btnactive');
})

