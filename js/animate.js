slideInt=1;

var images = [];
var titles = [];
var coments = [];
var times = [];
var current = 0;

$(document).ready(function() {

	$('.big-img-bg').click(function () {
		hide_big();
	});

	$('.right').click(function () {
		current = current+1;
		if (current == images.length) {
			current=0;
		};
		show_slide(images,titles,coments,times,current);
	})

	$('.left').click(function () {
		current = current-1;
		if (current == -1) {
			current = images.length-1;
		};
		show_slide(images,titles,coments,times,current);
	})
	
});

function big_info (block) {
	images = [];
	titles = [];
	coments = [];
	times = [];
	current = 0;

	length = $('.gallery').find('li').length;

	if (length==1) {
		$('.right').hide();
		$('.left').hide();
	} else {
		$('.right').show();
		$('.left').show();
	}

	if (images.length != length) {
		for (var i = 0; i < length; i++) {
			img = $('.gallery').find('li').eq(i)
				.find('.img').css('background-image');
			title = $('.gallery').find('li').eq(i)
				.find('.img').attr('data-title');
			coment = $('.gallery').find('li').eq(i)
				.find('.img').attr('data-coment');
			time = $('.gallery').find('li').eq(i)
				.find('.img').attr('data-time');
			
			img = img.replace('url(','');
			img = img.replace(')','');
            
			images.push(img);
			titles.push(title);
			coments.push(coment);
			times.push(time);

		};
	}

	current = $(block).parent().parent('li').index();
	show_slide(images,titles,coments,times,current);

}

function hide_big() {
	$('.big-img-bg').fadeOut(500);
	$('.big-content').fadeOut(1000);
}

function open_big() {
	$('.big-img-content').fadeIn(1000);
	$('.big-img-bg').fadeIn(500);
	resize_big();
}

function open_form() {
	$('.form-content').fadeIn(1000);
	$('.big-img-bg').fadeIn(500);
	resize_form();
}

function resize_big () {
	var big_w = $('.big-img-wrap').css('width');
	var big_h = $('.big-img-wrap').css('height');
	var	scroll = $(window).scrollTop();

	$('.big-img-wrap').css('margin-top', scroll);
	$('.big-img-content').css('width', big_w);
	$('.big-img-content').css('height', big_h);
}

function resize_form () {
	big_w = $('.form-wrap').css('width');
	big_h = $('.result-msg').css('height');
	var	scroll = $(window).scrollTop();

	$('.form-wrap').css('margin-top', scroll);
	$('.form-content').css('width', big_w);
	$('.form-content').css('height', big_h);
}


function show_slide (images,titles,coments,times,from) {
	img = images[from];
	title = titles[from];
	coment = coments[from];
	time = times[from];

	$('.big-img').attr('src',img);
	$('.img-title').html(title);
	$('.img-coment').html(coment);
	$('.img-time').html(time);
	resize_big();
}