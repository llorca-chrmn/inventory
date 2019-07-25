var rowID;

var tbl_viewLogs = $('#tbl_viewLogs').DataTable({
    "dom": 'frtip',
    'scrollX': true,
    'ajax': base_url('Log/viewLog'),
    'columnDefs': [
        {'visible': false, "width": '15%', 'targets': 0},
        {'visible': false, "width": '15%', 'targets': 1},
        {'visible': false, "width": '15%', 'targets': 2},
        {'width': '15%', 'targets': 3},
        {'width': '15%', 'targets': 4},
        {'width': '15%', 'targets': 5},
        {'width': '5%','orderable': false, 'targets': -1},
    ]
})

$('#tbl_viewLogs tbody').on('click', 'td button.btnViewLog', function(){
    var id = tbl_viewLogs.row($(this).closest('tr')).data()[0];
    var comp_id = tbl_viewLogs.row($(this).closest('tr')).data()[1];
    var peripheral_id = tbl_viewLogs.row($(this).closest('tr')).data()[2];
    rowID = id;

    $('#frmViewLogs').modal('show');
    $('#tb2_viewLogs').DataTable({
        "dom": 'frtip',
        'scrollX': true,
        'ajax': base_url('Log/getAllRec/') + peripheral_id,
        'columnDefs': [
            {'visible': false, 'width': '20%','orderable': false, 'targets': 0},
            {'width': '10%','orderable': false, 'targets': 1},
            {'width': '20%','orderable': false, 'targets': -1},
        ]
    })
})

$('#btnCloseRec').on('click',function(){
    window.location.href = base_url('Logs');
})