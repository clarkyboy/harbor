$(function() {

    var start = moment();
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        $('#dates').val(start.format('YYYY-MM-DD') + ' | ' + end.format('YYYY-MM-DD'));
        getTables();
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);


});

function getTables(){
    $('#tbody').html('<tr colspan="6"><img src="../images/waveball.gif" width="200" height="200"></tr>');
    dates = $('#dates').val().split('|');
    $.ajax({
        type: "POST",
        url: "charges_table.php",
        data: {start:dates[0], end:dates[1]},
        success: function (data) {
            $('#tbody').html('')
            $('#tbody').html(data);
        }
    });
}