$(document).ready(function(){
    $(".custom-file-input").change(function() {
        var quantity = $(this)[0].files.length
        if (quantity == 1) {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        } else {
            $(this).siblings(".custom-file-label").addClass("selected").html(quantity + " archivos seleccionados");
        }

    });
});
