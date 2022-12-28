$(document).ready(function () {

    $('.sidebar-menu').tree();

    $('#registros').DataTable({
        'paging': true,
        'pageLength': 10,
        'lengthChange': false,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': false,
        'language': {
            paginate: {
                next: "Siguiente",
                previous: "Anterior",
                last: "Último",
                firsr: "Primero"
            },
            info: "Mostrando _START_ a _END_ de _TOTAL_ resultados",

            //cuanod nuestara tabña este vacia podemos traducirla 

            empyTable: "No hay registros",
            infoEmpty: "0 Registros",
            search: "Buscar: "
        }
    });

    //! una manera muy sencilla 


    $("#repetir_password").on("input", function () {
        //.val accede al valor del input, le inpoirta un carajo si es contraseña
        let password_nuevo = $("#password").val();
        //recuerda que this en este caso ahce referencia al elmeneto donde se realizo el evento 
        if ($(this).val() == password_nuevo) {
            $("#resultado_password").text("Las contraseñas coinciden 😎");
            //mas diseños con bustras --> vamo al padre 
            $("#resultado_password").parents(".form-group").addClass("has-success").removeClass("has-error");
            $("input#password").parents(".form-group").addClass("has-success").removeClass("has-error");
            $("#crear_registro").attr("disabled", false);

        } else {
            $("#resultado_password").text("Las contraseñas no coinciden 🤷‍♂️");
            $("#resultado_password").parents(".form-group").addClass("has-error").removeClass("has-success");
            $("input#password").parents(".form-group").addClass("has-error").removeClass("has-success");
            $("#crear_registro").attr("disabled", true);

        }

    });
 
    // nombres previamente modificados  --> po lo genereal se necsitaran importar estas librerias y el llamado del elemento 
    $('#fecha').datepicker({
        autoclose: true
      })

      $('.seleccionar').select2()

      $('.timepicker').timepicker({
        showInputs: false
      })

      $("#icono").iconpicker();

      $.getJSON('servicio-registrados.php', function( data ){
        console.log(data);
        let line = new Morris.Line({
            element: 'grafica-registros',
            resize: true,
            data: data,
            xkey: 'fecha',
            ykeys: ['cantidad'],
            labels: ['Registrados'],
            lineColors: ['#3c8dbc'],
            hideHover: 'auto'
        });
    });
});