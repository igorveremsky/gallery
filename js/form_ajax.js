$(document).ready(function() {
	view_images('');
});

function submit_add() {

	var formdata = new FormData($('#add-image')[0]);

	$.ajax({
		url: 'image.php',
		type: 'post',
		data: formdata,
		processData: false,
		contentType: false,
		success: function(data) {
			$('.result').show();
			$('.result').html(data);
			view_images('');
			if (!$('.result').find('h2').hasClass('error-text')) {
				$('.form-main-title').hide();
				$('.add-image-form').hide();
				setTimeout(function() {
					hide_big();
				}, 1000);
			};
			setTimeout(function() {
				$('.form-main-title').show();
				$('.add-image-form').show();
				$('.result').hide();
			}, 2000);
		},
		error:  function(xhr, str){
		    alert('Возникла ошибка: ' + xhr.responseCode);
		}
	});
}


function submit_sort () {
	sort = $('.sort-form').serialize();
	view_images(sort);
}

function view_images (sort) {

	$.ajax({
		url: 'image.php',
		type: 'post',
		data: sort,
		success: function(data) {
			$('.gallery').html(data);
		},
		error:  function(xhr, str){
		    alert('Возникла ошибка: ' + xhr.responseCode);
		}
	}); 

}


function submit_edit () {
	data = $('.edit-image-form').serialize();

	$.ajax({
		url: 'image.php',
		type: 'post',
		data: data,
		success: function(data) {
			$('.result-msg').html(data);
			resize_form();
			view_images('');
			setTimeout(function() {
				hide_big();
			}, 2000);
		},
		error:  function(xhr, str){
		    alert('Возникла ошибка: ' + xhr.responseCode);
		}
	}); 

}

function add_image () {

	$.ajax({
		url: 'image.php',
		type: 'get',
		data: '&action=add',
		success: function(data) {
			$('.result-msg').html(data);
			open_form();
		},
		error:  function(xhr, str){
		    alert('Возникла ошибка: ' + xhr.responseCode);
		}
	}); 
}

function delete_image (id) {

	$.ajax({
		url: 'image.php',
		type: 'get',
		data: 'id='+id+'&action=delete',
		success: function(data) {
			$.when(view_images('')).done(function  () {
				$('.result-msg').html(data);
				open_form();
			});
			setTimeout(function() {
				hide_big();
			}, 2000);
		},
		error:  function(xhr, str){
		    alert('Возникла ошибка: ' + xhr.responseCode);
		}
	}); 
}

function edit_image (id) {

	$.ajax({
		url: 'image.php',
		type: 'get',
		data: 'id='+id+'&action=edit',
		success: function(data) {
			view_images('');
			$('.result-msg').html(data);
			open_form();
		},
		error:  function(xhr, str){
		    alert('Возникла ошибка: ' + xhr.responseCode);
		}
	}); 
}