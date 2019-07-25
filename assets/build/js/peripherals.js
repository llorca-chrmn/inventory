var submitMethod = "";
var method = "";
var rowID;
var brand;

// MISC MISC MISC MISC
$('#frmInfo').on('click',function(){
    submitMethod = "Add";
    $('#frm')[0].reset();
    $('#frmPeripheralInfo').modal('show');

    //brand = $('[name="brand"]').val();
})

// $('[name="brand"]').on('change', function(){
//     //alert(brand);
//     $(this).val(brand);
// })

// sa javascript first sa footer nimo tingale
// mag instantiate og variable
// //var age;
// then inig load sa page
// //jQuery(window).load(function(){
//     // age = $('#age').val();
// //})
// i store ang value sa imong age sa variable nga gi instantiate
// nya inig change or inspect element i jquery sad,
// // $('#age').on('change', function(){
//     //$(this).val(age);
// //})

$('#btnfrmAdd').on('click', function(){
    $('#frmAdd')[0].reset();
    $('#frmPeripheral').modal('show');

        $('input').removeClass('parsley-error')
            .next().html('');
    
        $('input').removeClass('parsley-error')
            .next().next().html('');
})

$('input').on('keydown',function(){
	$(this).removeClass('parsley-error')
		.next().html('');
})

$('input').on('keydown',function(){
	$(this).removeClass('parsley-error')
		.next().next().html('');
})
var items = [];

jQuery(window).load(function(){

    //alert('sadsd');
    $.ajax({
        url: base_url('peripherals/PeripheralAsset'),
        type: 'POST',
        dataType: 'JSON',
        success: function(data){
            //alert(data.items);
            var i = 0;
            $.each(data.itemsList, function(val, key){
                //console.log(key + " " + val);
                $('[name=peripheral_id]').append('<option value="'+data.id[i]+'">'+key +'</option>');
                i++;
            })
            
        }
    })
})
//////////////////////
// MISC MISC MISC MISC

$('#frm').on('submit', function(e){
    e.preventDefault();
    var that =  this;

    $(this).find("#btnSubmit").attr('disabled', "disabled");
    if(submitMethod == "Add"){
        link = base_url('peripherals/insertPeripheralInfo');
    }else{
        link = base_url('peripherals/updatePeripheralInfo/') + rowID;
    }

    $.ajax({
        url: link,
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'JSON',
        success: function(data){
            $(that).find("#btnSubmit").attr('disabled', false);
            if(data.status){
                $('#frmPeripheralInfo').modal('hide');
                alert("Item submitted successfully");
                tbl_peripherals.ajax.reload();
            }else{
                $.each(data.errors, function(key, val){
                    alert(key + val);
                    $('[name='+key+']').addClass('parsley-error').next().html(val);
                })
            }
        },
        error: function(data){
            alert(data.status);
        }
    })
})

var tbl_peripherals = $('#tbl_peripherals').DataTable({
        "dom": 'frtip',
        'data': $(this).serialize(),
        'scrollX': true,
        'ajax': base_url('peripherals/viewPeripherals'),
        'columnDefs': [
            {'targets':[1,2,3,4,5],
            'render': function (data, type, full, meta) {
                return "<div class='text-wrap width'>" + data + "</div>";
                },
            },
            {"min-width": '5%', 'targets':0},
            {'targets': 7,
            'render': function (data,type,row) {
                return "<div class='text-wrap width'>" + 'PHP '+ data + "</div>";
                },
            },
            {'targets': 6,
            'render': function (data, type, full, meta) {
                return "<div class='text-wrap remarks-wrap'>" + data + "</div>";
                },
            },
            {'min-width': '20%','orderable': false, 'targets': -1,
            'render': function(data){
                return '<div class="action-wrap"><button class="btn btn-round btn-info btn-xs btnUpdateP '+ (data == "spare" ? 'active' : 'hide') +'"><span class="fa fa-pencil"></span></button><button class="btn btn-round btn-danger btn-xs btnDeleteP '+ (data == "deployed" ? 'hide' : 'active') +'"><span class="fa fa-trash"></span></button></div>';
                }
            },
            {'min-width': '5%','orderable': false, 'targets': 8,
            'render': function(data){
                return ''+ (data == "deployed" ? '<label class="switch"> <span class="slide round"><span class="deployed">deployed</span></span></label>' : '<label class="switch"><input type="checkbox" class="switch" id="switch" name="switch" '+ (data == "spare" ? 'checked' : '') +'><span class="slider round"><span class="' + (data == "spare" ? 'on' : 'off') + '">' + (data == 'spare' ? 'spare' : 'defected') + '</span></span></label>' ) +''
                }
            }
        ],
    })

var tb2_peripherals = $('#tb2_peripherals').DataTable({
        "dom": 'frtip',
        'scrollX': true,
        'ajax': base_url('peripherals/viewPeripheralsCategory'),
        'columnDefs': [
            {"width": '5%', 'targets':0},
            {'width': '15%', 'targets': 1},
            {'width': '15%', 'targets': 2},
            {'width': '15%', 'targets': 3},
            {'width': '15%', 'targets': 4},
            {'width': '15%', 'targets': 5},
            {'width': '5%','orderable': false, 'targets': -1},
        ]
    })

$('#frmAdd').on('submit', function(e){
    e.preventDefault();
    var that =  this;

    $(this).find("#btnSubmit").attr('disabled', "disabled");
    if(method == "Update"){
        link = base_url('peripherals/updatePeripheral/') + rowID;
    }else{
        link = base_url('peripherals/insertPeripheral');
    }

    $.ajax({
        url: link,
        type: 'POST',
        data: $(this).serialize(),
        async: true,
        dataType: 'JSON',
        success: function(data){
            $(that).find("#btnSubmit").attr('disabled', false);
            if(data.status){
                alert('Category submitted successfully');
                $('#frmPeripheral').modal('hide');
                tb2_peripherals.ajax.reload();
            }else{
                $.each(data.errors, function(key, val){
                    //console.log(key + " " + val);
                    $('[name='+key+']').addClass('parsley-error').next().next().html(val);
                })
            }
        }
    })
})

$('#tbl_peripherals tbody').on('click', 'td button.btnUpdateP', function(){
    var id = tbl_peripherals.row($(this).closest('tr')).data()[0];
    var asset = tbl_peripherals.row($(this).closest('tr')).data()[1];
    rowID = id;
    
    $.ajax({
        url: base_url('peripherals/getRow/') + id,
        type: 'GET',
        dataType: 'JSON',
        success: function(data){
            if(data.status){
                $.each(data.row, function(key, val){
                    //console.log( 'Data in index: '+key+' is: '+val );
                    submitMethod = 'Update';
                    $('#frmPeripheralInfo').modal('show');
                    $('[name='+key+']').val(val);
                })
            }
        }
    })
})

$('#tb2_peripherals tbody').on('click', 'td button.btnUpdateP', function(){
    var id = tb2_peripherals.row($(this).closest('tr')).data()[0];
    var asset = tb2_peripherals.row($(this).closest('tr')).data()[1];
    rowID = id;
    
    $.ajax({
        url: base_url('peripherals/getRowCategory/') + id,
        type: 'GET',
        dataType: 'JSON',
        success: function(data){
            if(data.status){
                $.each(data.row, function(key, val){
                    //alert(key + " " + val);
                    method = 'Update';
                    $('#frmPeripheral').modal('show');
                    $('[name='+key+']').val(val);
                })
            }
        },
        error:function(){
            tb2_peripherals.ajax.reload();
        }
    })
})

$('#tbl_peripherals tbody').on('click', 'td button.btnDeleteP', function(){
    id = tbl_peripherals.row($(this).closest('tr')).data()[0];
    
    if(confirm('Do you want to delete this?')){
        $.ajax({
            url: base_url('peripherals/deletePeripheral/') + id,
            type: 'POST',
            dataType: 'JSON',
            success: function(data){
                if(data.status){
                    alert('Item is deleted');
                    tbl_peripherals.ajax.reload();
                }else{
                    alert('Item cannot be deleted');
                }
            }
        })
    } else {
        alert('Item is not deleted.');
    }

})

$('#tb2_peripherals tbody').on('click', 'td button.btnDeleteP', function(){
    id = tb2_peripherals.row($(this).closest('tr')).data()[0];
    
    if(confirm('Do you want to delete this?')){
        $.ajax({
            url: base_url('peripherals/deletePeripheralCategory/') + id,
            type: 'POST',
            dataType: 'JSON',
            success: function(data){
                if(data.status){
                    alert('Peripheral category is deleted');
                    tb2_peripherals.ajax.reload();
                }else{
                    alert('Peripheral category cannot be deleted.\nPlease undeploy the peripheral item/s.');
                }
            }
        })
    } else {
        alert('Peripheral category is not deleted.');
    }

})

$('#tbl_peripherals tbody').on('change', 'td input.switch', function () {
    id = tbl_peripherals.row($(this).closest('tr')).data()[0];
    rowID = id;

    if(confirm('Do you want to change this?')){
        $.ajax({
            url: base_url('peripherals/spareOrDefective/') + id,
            type: 'GET',
            dataType: 'JSON',
            success: function(data){
                if(data.status){
                    tbl_peripherals.ajax.reload();
                }else{
                    alert("Invalid");
                }
            },
            error: function(data){
                alert(data);
            }
        })
    }else{
        alert("No changes were made.");
        tbl_peripherals.ajax.reload();
    }
});