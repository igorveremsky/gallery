$(document).ready(function(){
	$('.add-image-form').submit(function  (e) {
		
		e.preventDefault();

		$.ajax({
			url: 'imageupload.php',
			type: 'post',
			data: new FormData(this),
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
	})

});

function submit_sort () {
	data = $('.sort-form').serialize();
	view_images(data);
}

function view_images (data) {

	$.ajax({
		url: 'imageview.php',
		type: 'post',
		data: data,
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
		url: 'imageedit.php',
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
	
function delete_image (id) {

	$.ajax({
		url: 'image.php',
		type: 'get',
		data: 'id='+id+'&action=delete',
		success: function(data) {
			$.when(view_images('')).done(function  () {
				$('.result-msg').html(data);
				open_form('delete');
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
			open_form('delete');
		},
		error:  function(xhr, str){
		    alert('Возникла ошибка: ' + xhr.responseCode);
		}
	}); 
}