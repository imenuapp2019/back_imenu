$(document).ready(function(){
    $('.js-example-basic-multiple').select2({
        placeholder: 'Selecciona uno o varios alergenos',
        width: 'resolve',
        closeOnSelect: false
    });

    //Activar todos los tooltips de la pagina
    $('[data-toggle="tooltip"]').tooltip();
    var modalPlato = $("#pruebamodal");
   // $("[name = menuPlate]");

//Acciones para cada fila de los platos del menu//
   $(".plate").dblclick(function(){
       id = $(this).attr('id');
       console.log(id);
       modalEditPlato(id)

   });

   $("#save").click(save);

    //Accion del boton añadir nueva categoria//
$("[name = newMenu]").click(function(){
    $("#newMenu").modal();
});

//Accion boton editar categoria//
$(".btn-edit").click(function(){
   var id=  $(this).attr("name");
   $("#name_"+id).toggleClass("d-none");
});

//Acciones al dar boton guardar, al editar la categoría//
$(".btn-category").click(function(){
    var id =  $(this).attr("name").substr($(this).attr("name").indexOf("_")+1);
    $("#heading_"+id+" .name_categoria").toggleClass("d-none")
});

//Eliminar la categoria
$(".btn-drop").click(function(){
    var id = $(this).attr('name');
    var name = $("#heading_"+id+" [name = name_menu]").text().trim();

   if(confirm("Vas a eliminar la categoria: "+name+ ",tendras que volver a asignar platos, ¿Conforme?")){
        //funcion ajax
   }
});

//editar plato desde un menu//
$(".edit_plate").click(function(){
    var id = $(this).attr('id').substr($(this).attr('id').indexOf('_')+1);
    var id_menu = $(".card-header").attr('id');
    console.log(id_menu);
    //edit_plate(id,'edit');
});

//quitar plato de menu X//
$(".quit_plate").click(function(){
    var id = $(this).attr('id').substr($(this).attr('id').indexOf('_')+1);

    edit_plate(id,'quit');
});
 $(".addPlate").click(function(){
     $("#asign_plate").modal();
 });

 $(".add_plate").click(function(){
     var id = $(this).attr('id');

 });

$("[name = image_plate]").change(function(){
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    if(fileName == ""){
        $("#image_plate").show();
    }else{
        $("#image_plate").hide();
    }
});

   function postBD(url,data,options = null,callback){
       $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });
       if(options === "formData"){
           $.ajax({
               url: url,
               data: data,
               type: 'post',
               enctype: 'multipart/form-data',
               contentType: false,
               processData: false,
               success: function(response){
                   if(callback != null){
                       callback(response)
                   }
               },
               statusCode:{
                   200: function () {

                   },
                   500: function(){
                       alert("Server Error")
                   }
               }
           })
       }else{
           $.ajax({
               url: url,
               data: data,
               dataType: 'json',
               type: 'post',
               success: function(response){
                   if(callback != null){
                       callback(response)
                   }
               },
               statusCode:{
                   200: function () {

                   },
                   500: function(){
                       alert("Server Error")
                   }
               }
           })
       }

   }
   function getBD(url,data,options = null,callback){
       $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });
       $.ajax({
           url: url,
           data: data,
           dataType: 'json',
           success: function(response){
               alert("exito");
           },
           statusCode:{
               200: function (response) {
                   callback(response);
               },
               500: function(){
                   alert("Server Error")
               }
           }
       })
   }
   function edit_plate(id,action){
       console.log($("#"+id+" .name_plate").text())
       switch (action) {
           case "quit":
               if(confirm("¿Quieres quitar "+$("#"+id+" .name_plate").text().trim()+" de la categoria ")){
                //funcion a
               }
               break;
           case "edit":
               break;
           default:
               console.log("en contstruccion");
               break;
       }
   }

   function modalEditPlato(id){
       $("#plate_id").val(id);
       $("#desc_plate [name = name]").val($("#"+id+" .name_plate").text());
       $("#desc_plate img").attr('src',$("#"+id+" .plate_img").attr("src"));
       $("#desc_plate [name = quantity ]").val($("#"+id+" .pricePlate").text().slice(0,-1));
       $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });
       $.ajax({
           url: 'menus_do/getMenus',
           type: 'post',
           data: {'id':id},
           dataType: 'json',
           success: function(response){
               console.log(response);
               $("#menus").empty();
               for (var value in response){
                   console.log(response[value].name);
                   $("#menus").append("<li class='list-group-item'>" +
                       response[value].name+
                 "<button id=class=\"btn btn-light\"><img src='../images/minus.png'></button></li>")
               };
               getBD('platos_do/alergenos',{plate_id : id},null,function(response){
                   $("#alergenos_list").empty();
                  for(var value in response){
                      $("#alergenos_list").append("<li class='list-group-item'>" +
                          response[value].name+
                          "<button id="+response[value].id+" class=\"btn btn-light\"><img src='../images/minus.png'></button></li>")
                  }
               });

           },
           statusCode:{
               500: function(){
                   alert("Server Error")
               }
           }
       })
       modalPlato.modal();
   }

    /**
     * Guardar cambios del modal editar plato.
     */
   function save(){
       var detallesPlato = new FormData($("#desc_plate")[0]);
       var alergenos = $("#alergenos").select2('val');
       detallesPlato.append('alergenos',alergenos);
       detallesPlato.append('plate_id',$("#plate_id").val());
       detallesPlato.append('menus',$("#menu").select2('val'));
        postBD('platos_do/save',detallesPlato,"formData",function(data){
            //location.reload();
        });
   }

});
