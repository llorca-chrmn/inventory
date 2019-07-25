var item;
var total;

jQuery(window).load(function(){
    $.ajax({
        url: base_url('Reports/index'),
        type: 'POST',
        dataType: 'JSON',
        success: function(data){
            $("#totalSpare").html(data.spare);
            $("#totalDeployed").html(data.deployed);
            $("#totalDefected").html(data.defected);
        }
    })
})

var location_report = $('#locationReport').DataTable({
    "searching": false,
    "sorting": false,
    "paging": false, 
    "info": false, 
    "dom": 'frtip',
    'ajax': base_url('Reports/countByLocation'),
    'columnDefs': [
        {"width": '5%', 'orderable': false,'targets': 0},
        {"width": '5%', 'orderable': false,'targets': 1},
        {"width": '5%', 'orderable': false,'targets': 2},
        {'width': '5%','orderable': false, 'targets': -1}
    ]
})

var category_report = $('#categoryReport').DataTable({
    "searching": false,
    "sorting": false,
    "paging": false, 
    "info": false, 
    "dom": 'frtip',
    'ajax': base_url('Reports/totalPeripheral'),
    'columnDefs': [
        {"width": '5%', 'orderable': false,'targets': 0},
        {'width': '3%','orderable': false, 'targets': -1}
    ]
})

