$(document).ready(function () {
    $('.js-example-basic-multiple').select2({
        placeholder: 'Selecciona uno o varios alergenos',
        width: 'resolve',
        closeOnSelect: false
    });

    //Activar todos los tooltips de la pagina
    $('[data-toggle="tooltip"]').tooltip();
    var modalPlato = $("#pruebamodal");

//Acciones para cada fila de los platos del menu//
    $(".plate").dblclick(function () {
        id = $(this).attr('id');
        console.log(id);
        modalEditPlato(id)

    });

    $("#save").click(save);

    //Accion del boton añadir nueva categoria//
    $("[name = newMenu]").click(function () {
        $("#newMenu").modal();
    });

//Añadir nuevo menu//
    $("[name = saveMenu]").click(function () {
        postBD('menu_do/newMenu', {
            'nameMenu': $("[name = cat_name]").val(),
            "restaurante_id": $('#restaurant_id').val()
        }, null, function (data) {
           location.reload();
        });
    });

//Accion boton editar categoria//
    $(".btn-edit").click(function () {
        var id = $(this).attr("name");
        $("#name_" + id).toggleClass("d-none");
    });

//Acciones al dar boton guardar, al editar la categoría//
    $(".btn-category").click(function () {
        var id = $(this).attr("name").substr($(this).attr("name").indexOf("_") + 1);
        var name = $("[name = cat_name_" + id + "]").val();
        console.log(name);
        postBD('menus_do/editmenu', {id: id, name: name}, null, function (response) {
            if (response === 'ok') {
                $("[name = name_menu_" + id + "]").text(name);
                $("#heading_" + id + " .name_categoria").toggleClass("d-none");
            } else {
                $("[name = cat_name_" + id + "]").placeholder("Guardado incorrecto");
                $("[name = cat_name_" + id + "]").focus();
            }
        })

    });

//Eliminar la categoria
    $(".btn-drop").click(function () {
        var id = $(this).attr('name');
        var name = $("#heading_" + id + " [name = name_menu]").text().trim();

        if (confirm("Vas a eliminar la categoria: " + name + ",tendras que volver a asignar platos, ¿Conforme?")) {
            postBD('menus_do/dropMenu', {id: id}, null, function (response) {
                if (response == 'ok') {
                    $(".card #" + id).remove();
                }
            });
        }
    });

//editar plato desde un menu//
    $(".edit_plate").click(function () {
        var id = $(this).attr('id').substr($(this).attr('id').indexOf('_') + 1);
        var id_menu = $(".card-header").attr('id');
        edit_plate(id,'edit');
    });

//quitar plato de menu X//
    $(".quit_plate").click(function () {
        //
        var id = $(this).attr('id').substr($(this).attr('id').indexOf('_') + 1);
        edit_plate(id, 'quit');

    });

//Open modal add plate//
    $(".addPlate").click(function () {
        var id_menu = $(this).attr('name').substr($(this).attr('name').indexOf('_' + 1));
        $("#add_plate_menu_id").val(id_menu);
        $("#asign_plate").modal();
    });

    //ADD BUTTON IN MODAL VIEW ADDPLATE//
    $(".add_plate").click(function () {
        var id = $(this).attr('id');
        var menu_id = $("#add_plate_menu_id").val();
        console.log("id del plato " + id);
        postBD('menus_do/add_plate_tomenu', {plate_id: id, menu_id: menu_id}, null, function (response) {
            if (response === 'ok') {
                location.reload();
            }
        })

    });


    $("[name = image_plate]").change(function () {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        if (fileName == "") {
            $("#image_plate").show();
        } else {
            $("#image_plate").hide();
        }
    });

    function edit_plate(id, action) {
        switch (action) {
            case "quit":
                console.log(id);
                if (confirm("¿Quieres quitar el plato de la categoria? ")) {
                    postBD('menus_do/dropPlateToMenu', {id: id}, null, function (response) {
                        if (response === 'ok') {
                            $("[name = mp_" + id + "]").remove();
                        }
                    })
                }
                break;
            case "edit":
                modalEditPlato(id);
                break;
            default:
                console.log("Selección no valida");
                break;
        }
    }

    function getAlergenos(id) {
        $.ajax({
            url: 'menus_do/getMenus',
            type: 'post',
            data: {'id': id},
            dataType: 'json',
            success: function (response) {
                console.log(response);
                $("#menus").empty();
                for (var value in response) {
                    console.log(response[value].name);
                    $("#menus").append("<li id='menu_" + response[value].id_menu_plato + "' class='list-group-item'>" +
                        response[value].name +
                        "<button id='" + response[value].id_menu_plato + "' class='drop_menu'><img src='../images/minus.png'></button></li>")
                }
                // UNASING MENUS TO DISH
                $(".drop_menu").click(function () {
                    var id_menu_plato = $(this).attr('id');
                    postBD('menus_do/dropPlateToMenu', {id: id_menu_plato}, null, function (response) {
                        if (response === 'ok') {
                            $("#menu_" + id_menu_plato).remove();
                        }
                    })
                });

                getBD('platos_do/alergenos', {plate_id: id}, null, function (response) {
                    $("#alergenos_list").empty();
                    for (var value in response) {
                        $("#alergenos_list").append("<li id='alergen_" + response[value].id + "' class='list-group-item'>" +
                            response[value].name +
                            "<button id='" + response[value].id + "' class=\"btn-drop-alergen btn btn-light\"><img src='../images/minus.png'></button></li>")
                    }

                    //Unasign alergen from dish
                    $(".btn-drop-alergen").click(function () {
                        var id_alergen = $(this).attr('id');
                        postBD('platos_do/dropAlergen', {id: id_alergen}, null, function (response) {
                            if (response === 'ok') {
                                $("#alergen_" + id_alergen).remove();
                            }
                        })
                    });

                });


            },
            statusCode: {
                500: function () {
                    alert("Server Error")
                }
            }
        })
    }

    function modalEditPlato(id) {
        $("#plate_id").val(id);
        $("#desc_plate [name = name]").val($("#" + id + " .name_plate").text());
        $("#desc_plate img").attr('src', $("#" + id + " .plate_img").attr("src"));
        $("#desc_plate [name = quantity ]").val($("#" + id + " .pricePlate").text().slice(0, -1));
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        getAlergenos(id);
        modalPlato.modal();
    }

    /**
     * Guardar cambios del modal editar plato.
     */
    function save() {
        var detallesPlato = new FormData($("#desc_plate")[0]);
        var alergenos = $("#alergenos").select2('val');
        detallesPlato.append('alergenos', alergenos);
        detallesPlato.append('plate_id', $("#plate_id").val());
        detallesPlato.append('menus', $("#menu").select2('val'));
        postBD('platos_do/save', detallesPlato, "formData", function (data) {
            if (data === 'ok') {
                modalPlato.modal('toggle');
                //location.reload();
            }
        });
    }

});


function postBD(url, data, options = null, callback) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    if (options === "formData") {
        $.ajax({
            url: url,
            data: data,
            type: 'post',
            enctype: 'multipart/form-data',
            contentType: false,
            processData: false,
            success: function (response) {
                if (callback != null) {
                    callback(response)
                }
            },
            statusCode: {
                200: function () {

                },
                500: function () {
                    alert("Server Error")
                }
            }
        })
    } else {
        $.ajax({
            url: url,
            data: data,
            dataType: 'json',
            type: 'post',
            success: function (response) {
                if (callback != null) {
                    callback(response)
                }
            },
            statusCode: {
                200: function () {

                },
                500: function () {
                    alert("Server Error")
                }
            }
        })
    }

}

function getBD(url, data, options = null, callback) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: url,
        data: data,
        dataType: 'json',
        success: function (response) {
        },
        statusCode: {
            200: function (response) {
                callback(response);
            },
            500: function () {
                alert("Server Error")
            }
        }
    })
}
