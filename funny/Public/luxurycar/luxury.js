//variables
var id;
var preId = '0';
var mySwiper;
var imgBg;
var cars = [ '保时捷', '法拉利', '兰博基尼', '宝马', '奔驰', '宾利', '路虎', '阿斯顿', '玛莎拉蒂' ];
// change style in pc
var ua = navigator.userAgent.toLowerCase();
$('body').ready(function() {
	if (!/mobile/.test(ua)) {
		// in PC
		$('.swiper-container').css('width', '640px');
		$('.return-btn').css({
			marginLeft : '60px',
			lineHeight : '40px',
			height : '40px',
			fontSize : '30px'
		});
		$('.share-btn').css({
			marginRight : '60px',
			height : '60px'
		});
	}
	$('body').show();
	// swiper
	mySwiper = new Swiper('.swiper-container', {
		direction : 'vertical',
		noSwiping : true
	});
});

// choose car
$('.icons img').click(
		function() {
			id = this.src.slice(-5, -4);
			if (id === '1') {
				$('.btn').css('background', '#FFB400');
				$('#share-btn').attr('src', res_path + 'button1.png');
			} else {
				$('.btn').css('background', '#FFF023');
				$('#share-btn').attr('src', res_path + 'button.png');
			}

			$('.page').css('background-image',
					'url(' + res_path + 'bg' + id + '.jpg?v=1.01)');
			$('.title-img img').attr('src', res_path + 'title' + id + '.png');
			imgBg = res_path + "imgBg" + id + ".jpg?v=1.2";
			mySwiper.slideTo(1);
		});

// reselsect
$('#reselect-btn').click(function() {
	$('#user-name').val('');
	mySwiper.slideTo(0);
});