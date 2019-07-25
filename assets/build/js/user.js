var method = "";
var rowID;

$(document).ready(function(){
	$('input').on('keyup click',function(){
		$(this).removeClass('has-error')
			.prev().html('');	
})
	
	$('#frmRegister').on('submit',function(e){		
		e.preventDefault();
		$.ajax({
			url: base_url('users/register'),
			type: 'POST',
			data: $(this).serialize(),
			dataType: "JSON",
			success: function(data){
				if(data.status){
					alert('Succesfully Registered');
					setTimeout(function(){
						window.location.href = base_url(),2000
					})
				}else{
					//console.log(data);
					$.each(data.errors, function(key, val){
						//console.log(key + " " + val);
						$('[name='+key+']').addClass('has-error').prev().html(val);
					})
				}
			}
		})
	})

	$('#frmLogin').on('submit', function(e){
		e.preventDefault();
		$.ajax({
			url: base_url('users/authenticate'),
			type: 'POST',
			data: $(this).serialize(),
			dataType: 'JSON',
			beforeSend: function(){
				NProgress.start();
			},
			success: function(data){
				if(data.status){
					NProgress.done();
					//alert('ok');
					if(data.first_log){
						//REDIRECT IF FIRSTIME LOGIN
						window.location.href = base_url('firstLog');
					}else if(data.status == "NOT FOUND"){
						$('[name=username]').addClass('has-error').prev().html(data.message);
					}else{
						//alert(data.age);
						$('input').removeClass('has-error').prev().html('');
						window.location.href = base_url('Reports');
					}
				}else{
					$.each(data.errors, function(key, val){
						$('[name='+key+']').addClass('has-error').prev().html(val);
					})
				}
			}
		})
	})

	// difference between "serialize" and "FormData" functions is that "serialize" cant get file details
	// so we use formData ind. :)stead. :)
	$('#frmFirstlog').on('submit', function(e){
		e.preventDefault();
		$.ajax({
			url: base_url('users/first_log'),
			type: 'POST',
			data: new FormData(this),
				mimeType: "multipart/form-data",
				contentType: false,
				cache: false,
				processData: false,
			dataType: 'JSON',
			success: function(data){
				if(data.status){
					$.ajax({
						url: base_url('users/update_first/') + data.last_id,
						type: 'POST',
						dataType: 'JSON',
						success: function(){
							window.location.href = base_url('Reports');
							alert('Successfully Updated');
						}
					})
				}else{
					// alert('error');
					$.each(data.errors, function(key, val){
						// alert(key +' ' +val);
						$('[name='+key+']').addClass('has-error')
							.prev().html(val);
					})
					if(data.image_error){
						$('[name=profile_pic]').addClass('has-error')
							.prev().html(data.image_error);
					}
				}
			}
		})
	})
})