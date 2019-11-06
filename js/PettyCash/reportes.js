$(document).ready(function(){
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "PettyCash/getPettyCash",
        success: function(response)
        {
            $('#pettyCashSelect').html(response).fadeIn();
        }
    });
});

function generateReportDetails(pettyCash){
    var idPettyCash = pettyCash.value;
    $.ajax({
        type: "POST",
        url: "PettyCash/generateReport",
        data: {id: idPettyCash},
        success:function(){
            alert("ok");
        },
        error:function(){
            alert("No");
        }
    });
}