$(document).ready(function(){
    $(".custom-file-input").change(function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    $(".coordenadas").focusout(function() {
        var nepe = $(this).val();
        var reg = new RegExp("^-?([1-8]?[1-9]|[1-9]0)\.{1}\d{1,6}");
        if (reg.exec(nepe)) {
            console.log("entra")
        }else{
            console.log("nop")
        }
        console.log(nepe)
    });

    $("#pn").focusout(function() {
        var phone_number = $(this).val();
        if (phone_number.match("/^[0-9-()+]{3,20}/")) {
            alert("una polla msdoinafivnapfnvoàdfbnvpnadvnadfopbnvpad")
        }else{
            alert("matame")
        }
    });
});
//    /[-+]?([0-9]*\.[0-9]+|[0-9]+)/
//
