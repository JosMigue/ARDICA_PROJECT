function numberInputCheck(){
    var fecha = new Date();
    var ano = fecha.getFullYear();
    var inputText = $("#numberPettyCash").val()+'-'+ano;
    var numberRegex = /^[0-9]*-[0-9]{4}$/;
    if(numberRegex.test(inputText)){
        $("#numberMessage").hide('fast');
        document.getElementById("submit_petty_cash").outerHTML='<button class="btn btn-success" type="submit" id="submit_petty_cash">Registrar</button>'
    }else{
        $("#numberMessage").show('fast');
        document.getElementById("submit_petty_cash").outerHTML='<button class="btn btn-success" type="button" id="submit_petty_cash">Registrar</button>'
    }
}