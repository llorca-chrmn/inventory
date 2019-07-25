var method = "";
var rowID;

var tbl_users = $('#tbl_users').DataTable({
	"dom": 'frtip',
	'scrollX': true,
	'ajax': base_url('users/viewUsers'),
	'columnDefs': [
		{"width": '5%', 'targets':0},
		{'width': '15%', 'targets': 1},
		{'width': '15%', 'targets': 2},
		{'width': '10%', 'orderable': false, 'targets': 3},
		{'width': '5%', 'orderable': false, 'targets': -1}
	]
})

$('#tbl_users tbody').on('click', 'td a.editType', function(){
	var id = tbl_users.row($(this).closest('tr')).data()[0];
	var usertype = tbl_users.row($(this).closest('tr')).data()[4];
	rowID = id;
	S
	$.ajax({
		url: base_url('users/getRowUser/') + id,
		type: 'GET',
		dataType: 'JSON',
		success: function(data){
			if(data.status){
				$.each(data.row, function(key, val){
					//console.log('Data in index: '+key+' is: '+val);
					//method = 'Update';
					$('#frmEditType').modal('show');
					$('[name='+key+']').val(val);
				})
			}
		},
		error:function(){
			tbl_users.ajax.reload();
		}
	})
})

$('#frmEdit').on('submit', function(e){
	e.preventDefault();
	var that =  this;

	$(this).find("#btnSubmit").attr('disabled', "disabled");

	$.ajax({
		url: base_url('users/editUserType/') + rowID,
		type: 'POST',
		data: $(this).serialize(),
		async: true,
		dataType: 'JSON',
		success: function(data){
			$(that).find("#btnSubmit").attr('disabled', false);
			if(data.status){
				alert('Submitted successfully');
				$('#frmEditType').modal('hide');
				tbl_users.ajax.reload();
			}
		},
		error:function(data){
			alert(data.status);
		}
	})
})

$('#tbl_users tbody').on('click', 'td button.btnDelete', function(){
	id = tbl_users.row($(this).closest('tr')).data()[0];
	
	if(confirm('Do you want to delete this?')){
		$.ajax({
			url: base_url('users/deleteUser/') + id,
			type: 'POST',
			dataType: 'JSON',
			success: function(data){
				if(data.status){
					alert('Item is deleted');
					tbl_users.ajax.reload();
				}
			}
		})
	} else {
		alert('Item is not deleted.');
	}
})

$('#btnSubmitSettings').on('submit', function(e){
	
	e.preventDefault();
	$.ajax({
		url: base_url('users/accountSettings'),
		type: 'POST',
		data: new FormData(this),
			mimeType: "multipart/form-data",
			contentType: false,
			cache: false,
			processData: false,
		dataType: 'JSON',
		success: function(data){
			window.location.href = base_url('Settings');
			alert("Submitted successfully");
		},
		error:function(data){
			alert("Failed to submit");
		}
	})
})
