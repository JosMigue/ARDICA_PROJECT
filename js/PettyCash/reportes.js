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