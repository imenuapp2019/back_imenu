$("document").ready(function(){
    //Activar todos los tooltips de la pagina
    $('[data-toggle="tooltip"]').tooltip();

//Acciones para cada fila de los platos del menu//
   $(".plate").dblclick(function(){
      console.log($(this).attr('id'));
   });

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

   function postBD(url,data,options = null){
       $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });
       $.ajax({
           url: url,
           data: data,
           dataType: json,
           success: function(response){
               alert("exito");
           },
           statusCode:{
               200: function () {
                   alert("200 exito");
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

});
