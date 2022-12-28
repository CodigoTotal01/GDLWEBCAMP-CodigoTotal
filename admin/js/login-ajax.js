$("#login-admin").on("submit", function (e) {
    e.preventDefault();
    let datos = $(this).serializeArray();
    $.ajax({
        type: $(this).attr("method"),
        data: datos,
        url: $(this).attr("action"),
        dataType: "json",

        success: function (data) {
            console.log(data);
            const { respuesta, usuario } = data;

            if (respuesta == "exitoso") {

                Swal(
                    'Se a registrado correctamente!',
                    `${usuario} hola denuevo 😘`,
                    'success'
                )

                setTimeout(() => {
                    //redireccion js 
                    window.location.href = "admin-area.php";
                }, 2000);
            } else {
                swal({
                    type: 'error',
                    title: `Uusuario o password incorrecto`,
                    text: 'Intentalo nuevamente!'
                });
            }
        }
    });

});