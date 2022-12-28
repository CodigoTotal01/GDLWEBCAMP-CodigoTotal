(function () {
	'use strict';
	var regalo = document.getElementById('regalo');

	document.addEventListener('DOMContentLoaded', function () {
		// Mapa
		if (document.getElementById('mapa')) {
			var map = L.map('mapa').setView([-12.065919, -77.036975], 37);

			L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
				attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
			}).addTo(map);
			//!aqui tambien va las cooerdenadas
			L.marker([-12.065919, -77.036975]).addTo(map)
				//!aqui se maneja lo wu e dice el glbo
				.bindPopup('GDLWbCamp 2022 <br> Boletos ya disponibles')
				.openPopup()
				//hover sobre el globolo mostrara
				.bindTooltip("Te esperamos!")
				.openTooltip();

		}
	});

	$(function () {
		// filtro pagado no pagado

		$('#filtros a').on('click', function () {
			$('#filtros a').removeClass('activo');
			$(this).addClass('activo');
			$('.registrados tbody tr').hide();

			if ($(this).attr('id') == 'pagados') {
				$('.registrados tbody tr.pagado').show();
			} else {
				$('.registrados tbody tr.no_pagado').show();
			}

			return false;
		});

		// Lettering
		$('.nombre-sitio').lettering();

		// Agregar clase a Menú
		$("body.conferencia .navegacion-principal a:contains('Conferencia')").addClass("activo")
		$("body.calendario .navegacion-principal a:contains('Calendario')").addClass("activo")
		$("body.invitados .navegacion-principal a:contains('Invitados')").addClass("activo")
		$("body.conferencia .navegacion-principal a:contains('Conferencia')").addClass("activo")

		// Menu fijo

		var windowHeight = $(window).height();
		var barraAltura = $('.barra').innerHeight();
		$(window).scroll(function () {
			var scroll = $(window).scrollTop();
			if (scroll > windowHeight) {
				$('.barra').addClass('fixed');
				$('body').css({ 'margin-top': barraAltura + 'px' });
			} else {
				$('.barra').removeClass('fixed');
				$('body').css({ 'margin-top': '0px' });
			}
		});

		// Menu Responsive

		$('.menu-movil').on('click', function () {
			$('.navegacion-principal').slideToggle();
		});

		// Reaccionar a Resize en la pantalla
		var breakpoint = 768;
		$(window).resize(function () {
			if ($(document).width() >= breakpoint) {
				$('.navegacion-principal').show();
			} else {
				$('.navegacion-principal').hide();
			}
		});

		// Programa de Conferencias
		$('.programa-evento .info-curso:first').show();
		$('.menu-programa a:first').addClass('activo');

		$('.menu-programa a').on('click', function () {
			$('.menu-programa a').removeClass('activo');
			$(this).addClass('activo');
			$('.ocultar').hide();
			var enlace = $(this).attr('href');
			$(enlace).fadeIn(1000);
			return false;
		});

		// Animaciones para los Numeros
		$(".resumen-evento li:nth-child(1) p").animateNumber({ number: 6 }, 1200);
		$(".resumen-evento li:nth-child(2) p").animateNumber({ number: 15 }, 1200);
		$(".resumen-evento li:nth-child(3) p").animateNumber({ number: 4 }, 1200);
		$(".resumen-evento li:nth-child(4) p").animateNumber({ number: 7 }, 1200);

		//Cuenta Regresiva

		$(".cuenta-regresiva ").countdown("2022/12/25 05:00", function (event) {
			$("#dias").html(event.strftime("%D"));
			$("#horas").html(event.strftime("%H"));
			$("#minutos").html(event.strftime("%M"));
			$("#segundos").html(event.strftime("%S"));

		});



		// Colorbox

		$(".invitado-info").colorbox({ inline: true, width: "50%" });

	});
})();
