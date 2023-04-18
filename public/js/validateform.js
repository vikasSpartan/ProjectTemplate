function validateRegister(){
    $("span.error").remove();
    var eCnt = 0;
    var inputFirstName = $("#inputFirstName").val();
    var inputLastName = $("#inputLastName").val();
    var inputEmail = $("#inputEmail").val();
    var inputPhone = $("#inputPhone").val();
    var inputPassword = $("#inputPassword").val();
    var inputPasswordConfirm = $("#inputPasswordConfirm").val();

    if(inputFirstName == ""){
        $("#inputFirstName").parent().append('<span class="error">Fill this field</span>');
        eCnt++;
    }
    if(inputLastName == ""){
        $("#inputLastName").parent().append('<span class="error">Fill this field</span>');
        eCnt++;
    }
    if(inputEmail == ""){
        $("#inputEmail").parent().append('<span class="error">Fill this field</span>');
        eCnt++;
    }
    if(inputPhone == ""){
        $("#inputPhone").parent().append('<span class="error">Fill this field</span>');
        eCnt++;
    }
    else if(isNaN(inputPhone)){
        $("#inputPhone").parent().append('<span class="error">Enter a valid phone number hh</span>');
        eCnt++;
    }else if(inputPhone.length != 10){
        $("#inputPhone").parent().append('<span class="error">Enter a valid phone number</span>');
        eCnt++;
    }
    if(inputPassword == ""){
        $("#inputPassword").parent().append('<span class="error">Fill this field</span>');
        eCnt++;
    }
    if(inputPasswordConfirm == ""){
        $("#inputPasswordConfirm").parent().append('<span class="error">Fill this field</span>');
        eCnt++;
    }
    if(inputPassword != "" && inputPasswordConfirm != "" && inputPassword != inputPasswordConfirm){
        $("#inputPasswordConfirm").parent().append("<span class='error'>Passwords doesn't match</span>");
        eCnt++;
    }

    if(eCnt>0){
        return false;
    }else{
        return true;
    }

}

function validateLogin(){
    $("span.error").remove();
    var eCnt = 0;

    var inputEmail = $("#inputEmail").val();
    var inputPassword = $("#inputPassword").val();

    if(inputEmail == ""){
        $("#inputEmail").parent().append('<span class="error">Fill this field</span>');
        eCnt++;
    }
    if(inputPassword == ""){
        $("#inputPassword").parent().append('<span class="error">Fill this field</span>');
        eCnt++;
    }
    if(eCnt>0){
        return false;
    }else{
        return true;
    }

}
