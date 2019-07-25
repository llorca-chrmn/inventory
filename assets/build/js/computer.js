//   _____ ____  __  __ _____  _    _ _______ ______ _____              _____ _____ ______ _______   ______ _    _ _   _  _____ _______ _____ ____  _   _  _____ 
//  / ____/ __ \|  \/  |  __ \| |  | |__   __|  ____|  __ \      /\    / ____/ ____|  ____|__   __| |  ____| |  | | \ | |/ ____|__   __|_   _/ __ \| \ | |/ ____|
// | |   | |  | | \  / | |__) | |  | |  | |  | |__  | |__) |    /  \  | (___| (___ | |__     | |    | |__  | |  | |  \| | |       | |    | || |  | |  \| | (___  
// | |   | |  | | |\/| |  ___/| |  | |  | |  |  __| |  _  /    / /\ \  \___ \\___ \|  __|    | |    |  __| | |  | | . ` | |       | |    | || |  | | . ` |\___ \ 
// | |___| |__| | |  | | |    | |__| |  | |  | |____| | \ \   / ____ \ ____) |___) | |____   | |    | |    | |__| | |\  | |____   | |   _| || |__| | |\  |____) |
//  \_____\____/|_|  |_|_|     \____/   |_|  |______|_|  \_\ /_/    \_\_____/_____/|______|  |_|    |_|     \____/|_| \_|\_____|  |_|  |_____\____/|_| \_|_____/ 
var method;
var type_CL;
var additionalID;
var autocomplete = [];
var peripheralCount = 1;
var computerItems = [];
var computer_peripherals = [];
var additionalID_Del;

$(document).ready(function(){
    // store the dataTable initialization so that it can be used sa mga functions later on "http://localhost:88/test/assets/viewComputer"
    var table = $('#tbl_computers').DataTable( {
        "ajax": base_url('assets/viewComputer'),
        "columns": [
            {
                "className": 'details-control'
            },
            null,
            {"visible": false},
            {"visible": false},
            {"visible": false},
            null,
            null,
            null,
            null,
            null,
            null,
            {"visible": false},
            {"visible": false},
            {"visible": false},
            {'orderable': false}
          ]
    } );

    $('#tbl_computers tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
        var id = tr.find('td:nth-child(1)').html();

        if ( row.child.isShown() ) {
            row.child.hide();
            tr.removeClass('shown');
        } else {
            $.ajax({
                url: base_url('assets/getAll_Peripherals/') + id,
                type: 'GET',
                dataType: 'JSON',
                success: function(data){
                    $.each(data.additional,function(val,key){
                        row.child(format(row.data(),key[0])).show();
                        tr.addClass('shown');
                    })
                },
                error: function(data){
                    alert(data.status);
                    alert("Error");
                }
            })  
        }
    });

    function format(d, peripheral) {
        var de = new Date();
        var n = de.getMonth();

        return '<table class="table table-bordered table-hover">'+
            '<tr>'+
                '<td><strong>Serial:</strong></td>'+
                '<td>'+d[4]+'</td>'+
                '<td><strong>Row:</strong></td>'+
                '<td>'+d[2]+'</td>'+
                '<td><strong>Hostname:</strong></td>'+
                '<td>'+d[3]+'</td>'+
            '</tr>'+
            '<tr>'+
            '<tr>'+
                '<td><strong>Remarks:</strong></td>'+
                '<td>'+d[12]+'</td>'+
                '<td><strong>Date Added:</strong></td>'+
                '<td>' + moment(de).format('MMMM Do YYYY, h:mm:ss a'); + '</td>'+
            '</tr>'+
            '<tr style="color:black">'+
            '</tr>'+
        '</table>';
    }

    $('[name=row]').on('change',function(){
        
        if($(this).val() != 0){
            $('[name=hostname]').attr('disabled', false);
            $('[name=hostname]').val('R'+$(this).val() + 'S');
        }
    })

    $('[name=row_Lp]').on('change',function(){
        
        if($(this).val() != 0){
            $('[name=hostname_Lp]').attr('disabled', false);
            $('[name=hostname_Lp]').val('R'+$(this).val() + 'S');
        }
    })

    $('[name=hostname]').on('change',function(){
        var flag = 0; 
        var seat = $(this).val();
        var data;
        
        var cnt = 0;
        while(computerItems.length > cnt){
            var ret = split_items(computerItems[cnt]);
            cnt++;

            if(ret[2] == seat){
                flag = 1;
            }
        }
        
        var ret = split(seat);
            if($.isNumeric(ret[1]) && ret[1] != 0 && flag == 0){
                $('[name=serial]').attr('disabled', false);
                $('[name=serial]').val($(this).val()+ "-12345");
            }else{
                alert("Seat is already occupied/ Seat 0 and non integer value is invalid.");
        }

        $.ajax({
            url : base_url('assets/computerlItems'),
            type : "GET",
            dataType: "JSON",
            success : function(data){
                if(data){
                    $.each(data.items,function(val,key){
                        computerItems.push(key[1]+'-'+key[2]+'-'+key[3]+'-'+key[0]);
                    })
                }
            }
        }) 
    })

    $('[name=hostname_Lp]').on('change',function(){
        var flag = 0; 
        var seat = $(this).val();
        var data;
        
        var cnt = 0;
        while(computerItems.length > cnt){
            var ret = split_items(computerItems[cnt]);
            cnt++;

            if(ret[2] == seat){
                flag = 1;
            }
        }
        
        var ret = split(seat);
            if($.isNumeric(ret[1]) && ret[1] != 0 && flag == 0){
                $('[name=serial_Lp]').attr('disabled', false);
                $('[name=serial_Lp]').val($(this).val()+ "-12345");
            }else{
                alert("Seat is already occupied/ Seat 0 and non integer value is invalid.");
        }

        $.ajax({
            url : base_url('assets/computerlItems'),
            type : "GET",
            dataType: "JSON",
            success : function(data){
                if(data){
                    $.each(data.items,function(val,key){
                        computerItems.push(key[1]+'-'+key[2]+'-'+key[3]+'-'+key[0]);
                    })
                }
            }
        }) 
    })

    function split(data){
        var ret = data.split("S");
        return ret;
    }

    function split_items(data){
        var ret = data.split("-");
        return ret;
    }

   $('#frmComputer').on('submit',function(e){ 
        e.preventDefault();
        $(this).find("#frmSubmit").attr('disabled', "disabled");
        var url;
        alert(method);
        if(method == "add") {
            url = base_url('assets/addAsset/'); 
        }else{
            url = base_url('assets/updateAsset/');
        }

         $.ajax({
            url : url,
            type: "POST",
            data: $(this).serialize(),
            dataType: "JSON",
            success: function(data)
            {
                alert(data.status);
                if(data.status){ 
                    $('#modalComputer').modal('hide');
                    table.ajax.reload();
                    window.location = window.location.href;
                }
                $(that).find("#frmSubmit").attr('disabled', false);
            },
            error: function(data){
                alert(data.status);
                alert("Error");
            }
        });    
    });
    
    $('#frmLaptop').on('submit',function(e){ 
        $(this).find("#frmSubmit_laptop").attr('disabled', "disabled");
        url = base_url('assets/addAsset_Laptop/'); 
        $.ajax({
            url : url,
            type: "POST",
            data: $(this).serialize(),
            dataType: "JSON",
            success: function(data)
            {
                alert(data.status);
                $(that).find("#frmSubmit_laptop").attr('disabled', false);
                if(data.status){ 
                    $('#modalComputer').modal('hide');
                    table.ajax.reload();
                    window.location = window.location.href;
                }
            },
            error: function(data){
                alert(data.status);
                alert("Error");
            }
        });    
    });

    $('#frmAdditional').on('submit',function(e){ 
        $(this).find("#frmSubmit_addition").attr('disabled', "disabled");
        url = base_url('assets/addAsset_Additional/') + additionalID;
        $.ajax({
            url : url,
            type: "POST",
            data: $(this).serialize(),
            dataType: "JSON",
            success: function(data)
            {
                alert(data.status);
                $(that).find("#frmSubmit_addition").attr('disabled', false);
                if(data.status){
                    $('#modalAdditional').modal('hide');
                    table.ajax.reload();
                    window.location = window.location.href;
                }
            },
            error: function(data){
                alert(data.status);
                alert("Error");
            }
        });    
    });

    $('#frmAdditional_Del').on('submit',function(e){
        $(this).find("#frmAdditional_Del").attr('disabled', "disabled");
        url = base_url('assets/deleteAsset_Add/');
        if(confirm("Do you really want to delete this peripheral?")){
            $.ajax({
                url : url,
                type: "POST",
                data: $(this).serialize(),
                dataType: "JSON",
                success: function(data)
                {
                    $(that).find("#frmAdditional_Del").attr('disabled', false);
                    if(data.status){
                        $('#modalAdditional_Del').modal('hide');
                        table.ajax.reload();
                        window.location = window.location.href;
                    }
                },
                error: function(data){
                    alert(data.status);
                    alert("Error");
                }
            });  
      }  
    });

    $('#DelAll_ID').on('click',function(){
       $(this).find("#DelAll_ID").attr('disabled', "disabled");
        if(confirm("Do you really want to delete all additional peripherals?")){
            url = base_url('assets/deleteAsset_AllAdd/')+ additionalID_Del;
            $.ajax({
                url : url,
                type: "POST",
                data: $(this).serialize(),
                dataType: "JSON",
                success: function(data)
                {
                    $(that).find("#DelAll_ID").attr('disabled', false);
                    if(data.status){
                        $('#modalAdditional_Del').modal('hide');
                        table.ajax.reload();
                        window.location = window.location.href;
                    }
                },
                error: function(data){
                    alert(data.status);
                    alert("Error");
                }
            });    
            $('[name=additional_Del]').attr('disabled', true);
        }
    })

    $('#viewPeri').on('click',function(){
       
    });

    $('#btnComp').on('click',function(){
        method = "add";
        $('#modalComputer').modal('show');
        $('.modal-title').html('Computers');
        $('#frmComputer')[0].reset();
    })

    $('#btnLaptop').on('click',function(){
        $('#modalLaptop').modal('show');
        $('.modal-title').html('Laptops');
        $('#frmLaptop')[0].reset();
    })

    $('#tbl_computers tbody').on('click', 'td button.btnUpdate',function(){
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        var id = row.data()[0];
        var t = row.data()[1];

        method = "update";
        if(t == "computer"){
            type_CL = "computer";
            $('#modalComputer').modal('show');
            $('.modal-title').html('Update');
            $('#Submit').text('Update');
        }else{
            type_CL = "laptop";
            $('#modalLaptop').modal('show');
            $('.modal-title').html('Update');
            $('#Submit').text('Update');
        }
        $('[name=hostname]').attr('disabled', false);
        $('#id').val(id);

        $.ajax({
            url : base_url('assets/getSpecific/') + id,
            type : "GET",
            dataType: "JSON",
            success : function(data){
                if(data){
                    $.each(data[0],function(key, val){
                        $('[name=' + key +']').val(val);    
                    })
                }
            }
        })
        
    })

    $('#tbl_computers tbody').on('click', 'td button.btnDelete',function(){
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        var id = row.data()[0];
        var type = row.data()[1];

        if( type == "computer"){
            url = base_url('assets/deleteAsset/') + id
        }else{
            url = base_url('assets/deleteAsset_Laptop/') + id
        }

        if(confirm("Do you want to delete this ?")){
            $.ajax({
                url : url,
                type : "POST",
                dataType: "JSON",
                success: function(data){
                    if(data.status){
                        alert('deleted');
                        table.ajax.reload();
                        window.location = window.location.href;
                    }else{
                        alert('not delete');
                    }
                },
                error: function(data){
                    alert(data.status);
                    alert("Error");
                }
            })
        }
    })
    
    $('#tbl_computers tbody').on('click', 'td button.btnAdd',function(){
        $('#modalAdditional').modal('show');
        $('.modal-title').html('Additional Peripheral');
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        additionalID = row.data()[0];
    })

    $('#tbl_computers tbody').on('click', 'td button.btnDelete_additional',function(){
        $('#modalAdditional_Del').modal('show');
        $('.modal-title').html('Additional Peripheral');
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        additionalID_Del = row.data()[0];

        $.ajax({
            url : base_url('assets/getAdditionalPeripherals/') + additionalID_Del,
            type : "POST",
            dataType: "JSON",
            success: function(data){
                $.each(data.items,function(val, key){
                    if(key[2] != "Motherboard"&&key[2] != "Processor"&&key[2] != "RAM"&&key[2] != "Diskdrive"&&key[2] != "Video Card"&&key[2] != "Laptop"){
                        $('[name=additional_Del]').append('<option value ='+key[0]+'>'+key[1]+'['+key[2]+']'+'</option>'); 
                    }
                })
            },
            error: function(data){
                alert(data.items);
                alert(data.status);
                alert("Error");
            }
        })
    })

    $('#modalComputer').modal({
        backdrop: 'static',
        keyboard: false,
        show: false
    })

    $('#modalLaptop').modal({
        backdrop: 'static',
        keyboard: false,
        show: false
    })

    $('#modalAdditional').modal({
        backdrop: 'static',
        keyboard: false,
        show: false
    })

    $('#modalAdditional_Del').modal({
        backdrop: 'static',
        keyboard: false,
        show: false
    })

    $('#btnClose_additional').on('click',function(){
        $("#info_id").empty();
    })

    $('#btnClose_DelADD').on('click',function(){
        $("#add_DelID").empty();
        $('[name=additional_Del]').append('<option hidden value="">'+'Select Peripheral'+'</option>')
    })

    jQuery(window).load(function(){
        $.ajax({
            url: base_url('peripherals/peripheralItems'),
            type: 'GET',
            dataType: 'JSON',
            success: function(data){
                $.each(data.items, function(val, key){
                    autocomplete.push(key[1]+' - '+key[2]+' - '+key[3]+' - '+key[0]);
                   if(key[5] == "spare"){ 
                        switch(key[1]){
                            case "Motherboard" : 
                            case "motherboard" :  $('[name=motherboard]').append('<option value='+key[0]+'>'+key[2]+'</option>'); break;
                            case "Processor"   :
                            case "processor"   :  $('[name=processor]').append('<option value='+key[0]+'>'+key[2]+'</option>'); break;
                            case "RAM"         : 
                            case "ram"         :  $('[name=RAM]').append('<option value='+key[0]+'>'+key[2]+'</option>'); break;
                            case "Diskdrive"   :  $('[name=Diskdrive]').append('<option value='+key[0]+'>'+key[2]+'</option>'); break;
                            case "Video Card"  :  $('[name=videocard]').append('<option value='+key[0]+'>'+key[2]+'</option>'); break;
                            case "Laptop"      :  $('[name=laptop]').append('<option value='+key[0]+'>'+key[2]+'</option>'); break;
                            default :  $('[name=additional]').append('<option value='+key[0]+'>'+key[2]+'['+key[1]+']'+'</option>');
                        }   
                    }
                })
            }
        })
    })
        
   $('#group-more').on('change', 'input.tags',function(){
        cut = autocomplete.indexOf($(this).val());
        autocomplete.splice(cut, 1);
    })

    $( ".tags" ).autocomplete({
        source: autocomplete,
        change: function(event,ui){
            if (ui.item==null){
                $(this).val('');
                $(this).focus();
            }else{
                $(this).attr('readonly', 'true');
            }
        }
    });
})



