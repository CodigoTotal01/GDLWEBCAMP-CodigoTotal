(function () {
	'use strict';
	var regalo = document.getElementById('regalo');

	document.addEventListener('DOMContentLoaded', function () {
		if (document.getElementById('calcular')) {
			var regalo = document.getElementById('regalo');

			// Campos Datos usuario
			var nombre = document.getElementById('nombre');
			var apellido = document.getElementById('apellido');
			var email = document.getElementById('email');

			// Campos pases
			let pase_dia = document.getElementById("pase_dia");
			let pase_dosdias = document.querySelector("#pase_dosdias");
			let pase_completo = document.querySelector("#pase_completo");

			// mostrar en editar
			var formulario_editar = document.getElementsByClassName('editar-registrado');
			if (formulario_editar.length > 0) {
				if (pase_dia.value || pase_dosdias.value || pase_completo) {
					mostrarDias();
				}
			}

			//Botones y divs
			const calcular = document.querySelector("#calcular");
			const errorDiv = document.querySelector("#error");
			const botonRegistro = document.querySelector("#btnRegistro");

			var lista_productos = document.getElementById('lista-productos');
			var suma = document.getElementById('suma-total');

			// Extras
			const camisas = document.querySelector("#camisa_evento");
			const etiquetas = document.querySelector("#etiquetas");
			//Desabilitamos el boton de registro 
			botonRegistro.disabled = true;

			calcular.addEventListener('click', calcularMontos);

			pase_dia.addEventListener("blur", mostrarDias);
			pase_dosdias.addEventListener("blur", mostrarDias);
			pase_completo.addEventListener("blur", mostrarDias);

			/*arriba*/

			nombre.addEventListener("blur", validarCampos);
			apellido.addEventListener("blur", validarCampos);
			email.addEventListener('blur', validarMail);

			function validarCampos() {
				if (this.value == "") {
					errorDiv.style.display = "block";
					errorDiv.innerHTML = "Este campo es obligatorio";
					this.style.border = "1px solid red";
					errorDiv.style.border = "1px solid red";
					errorDiv.style.lineHeight = "3rem";


				} else {
					errorDiv.style.display = "none";
					this.style.border = "1px solid #9c9c9c";

				}

			}

			function validarMail() {
				if (this.value.indexOf("@") > -1) {
					errorDiv.style.display = "none";
					this.style.border = "1px solid #9c9c9c";

				} else {
					errorDiv.style.display = "block";
					errorDiv.innerHTML = "Debes ingresar un correo valido";
					this.style.border = "1px solid red";
					errorDiv.style.border = "1px solid red";
					errorDiv.style.lineHeight = "3rem";
				}

			}

			function calcularMontos(event) {
				event.preventDefault();
				if (regalo.value === '') {
					alert('Debes elegir un regalo');
					regalo.focus();
				} else {
					var boletosDia = parseInt(pase_dia.value, 10) || 0,
						boletos2Dias = parseInt(pase_dosdias.value, 10) || 0,
						boletoCompleto = parseInt(pase_completo.value, 10) || 0,
						cantCamisas = parseInt(camisas.value, 10) || 0,
						cantEtiquetas = parseInt(etiquetas.value, 10) || 0;

					var totalPagar =
						boletosDia * 30 +
						boletos2Dias * 45 +
						boletoCompleto * 50 +
						cantCamisas * 10 * 0.93 +
						cantEtiquetas * 2;

					var listadoProductos = [];

					if (boletosDia >= 1) {
						listadoProductos.push(boletosDia + ' Pases por día');
					}
					if (boletos2Dias >= 1) {
						listadoProductos.push(boletos2Dias + ' Pases por 2 días');
					}
					if (boletoCompleto >= 1) {
						listadoProductos.push(boletoCompleto + ' Pases Completos');
					}
					if (cantCamisas >= 1) {
						listadoProductos.push(cantCamisas + ' Camisas');
					}
					if (cantEtiquetas >= 1) {
						listadoProductos.push(cantEtiquetas + ' Etiquetas');
					}
					lista_productos.style.display = 'block';
					lista_productos.innerHTML = '';
					for (var i = 0; i < listadoProductos.length; i++) {
						lista_productos.innerHTML += listadoProductos[i] + '<br/>';
					}
					//JavaScript se usa para formatear un número usando notación de punto fijo.
					suma.innerHTML = '$ ' + totalPagar.toFixed(2);
					//cuando acalculemos habilitamos el boton de pagar
					botonRegistro.disabled = false;
					//añadiendo a neustro campo oculto el precio del total,a paypal le gusta ya que los token los tene asi pue 
					document.getElementById("total_pedido").value = totalPagar;

				}
			}

			function mostrarDias() {
				var boletosDia = parseInt(pase_dia.value, 10) || 0,
					boletos2Dias = parseInt(pase_dosdias.value, 10) || 0,
					boletoCompleto = parseInt(pase_completo.value, 10) || 0;

				console.log(boletoCompleto);

				var diasElegidos = [];

				if (boletosDia > 0) {
					diasElegidos.push('viernes');
					console.log(diasElegidos);
				}
				if (boletos2Dias > 0) {
					diasElegidos.push('viernes', 'sabado');
					console.log(diasElegidos);
				}
				if (boletoCompleto > 0) {
					diasElegidos.push('viernes', 'sabado', 'domingo');
					console.log(diasElegidos);
				}
				console.log(diasElegidos.length);

				// muestra los seleccionados
				for (var i = 0; i < diasElegidos.length; i++) {
					document.getElementById(diasElegidos[i]).style.display = 'block';
				}

				// los oculta si vuelven a 0
				if (diasElegidos.length == 0) {
					var todosDias = document.getElementsByClassName('contenido-dia');
					for (var i = 0; i < todosDias.length; i++) {
						todosDias[i].style.display = 'none';
					}
				}
			}
		}
    });
})();
