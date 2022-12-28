//cuando cargue el documento 
$(document).ready(function () {

    //! Crear administrador 
    //on -> eventos  
    $("#guardar-registro").on("submit", function (e) { //! Seleccionamos formulario
        e.preventDefault();
        //obtener datos this refiere a lo que hiso que se ejecute -> enn este caso elformulario
        //! este iterara sobre los input y extraera los datos   como objetos los datos tanto el nombre y el value 
        let datos = $(this).serializeArray();


        //* ajax en jquery
        // attr sirve para seleccionar atributos html
        $.ajax({
            type: $(this).attr("method"), //como mandan
            data: datos, // que mandamos...
            url: $(this).attr("action"), // donde lo mandamos
            dataType: "json",  // como receviremos la respyesta 
            //respuesta que se nos va aretornar -> no olvides enviar los datos
            success: function (data) {
                console.log(data);
                const {respuesta} = data;

                if (respuesta == "exito") {
                    Swal(
                        'Se a registrado correctamente!',
                        `Se guardo correctamente`,
                        'success'
                    )
                } else {

                    swal({
                        type: 'error',
                        title: `Error inesperado 😥`,
                        text: 'Recarga la pagina y vuelve a relizar la acción!'
                    });


                }


            }
        });



    });




    //? se ejecuta cuando halla un archivo -> para invitados en este caso 
    $("#guardar-registro-archivo").on("submit", function (e) { 
        e.preventDefault();
        //ceradra un neuvo form data una llave y valor a cada uno de los campos 
        let datos = new FormData(this);

        $.ajax({
            type: $(this).attr("method"), //como mandan
            data: datos, // que mandamos...
            url: $(this).attr("action"), // donde lo mandamos
            dataType: "json",
            contentType: false,
            processData: false,
            async: true,
            cache: false,
            success: function (data) {
                console.log(data);
                const {respuesta} = data;

                if (respuesta == "exito") {
                    Swal(
                        'Se a registrado correctamente!',
                        `Se guardo correctamente`,
                        'success'
                    )
                } else {

                    swal({
                        type: 'error',
                        title: `Error inesperado 😥`,
                        text: 'Recarga la pagina y vuelve a relizar la acción!'
                    });


                }


            }
        });



    });
    //! Login administrador -> datos extrasidos literalemente sobre el formulario
   
    //todo: corregir
    //!Borrar un registro (admin) mas inteligente 
    $(".borrar-registro").on("click", function (e) {
        e.preventDefault();
        //obtenemos el id y el tipo de accion 
        let id = $(this).attr("data-id");
        let tipo = $(this).attr("data-tipo");
        //no importa que no halal dormulario
        let eliminar = false;
        Swal({
            title: "Estas seguro(a) 🤔?",
            text: "Se eliminara de manera permanente ",
            icon: 'warning',
            showCancelButton: false,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, eliminar",
            cancelButtonText: "cancelar"
        }).then(() => {
            $.ajax({
                type: "POST",
                data: {
                    "id": id,
                    "registro": "eliminar"
                },
                url: "modelo-" + tipo + ".php",
                // dataType: "json",  //!Literal por esta mierda no se lee le json
                success: function (data) {
                    console.log(data);
                    let respuesta = JSON.parse(data);
                    if (respuesta.respuesta == "exito") {
                        Swal(
                            'Eliminado!',
                            'Registro Eliminado',
                            'success'
                        )
                        let eliminarUsuario = '[data-id="' + respuesta.id_eliminado + '"]';
                        $(eliminarUsuario).parents("tr").remove();
                    } else {
                        swal({
                            type: 'error',
                            title: `No se pudo eliminar el registro`,
                            text: 'Reinicia la pagina o cumunicate con atencion al cliente'
                        });
                    }
                }
            });
        });
    });

});