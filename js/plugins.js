// Avoid `console`
//git ignore sirve par que vcuando se meta un archivo de base de datos sirve para decirle que archivos queremos colocar en git o no , 404 cuando una pagina no existe redirige, browser config servia para subir imagenes aclpicacion progresiva que cool navegar sin internatra  errors in browsers that lack a console, robot para las arañas de gogle le decimos que puede hacer con esas paginas el htacces tiene muchas configuraciones lo hae muy rapido la carga de neustro grupo .
(function() {
  var method;
  var noop = function () {};
  var methods = [
    'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
    'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
    'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
    'timeline', 'timelineEnd', 'timeStamp', 'trace', 'warn'
  ];
  var length = methods.length;
  var console = (window.console = window.console || {});

  while (length--) {
    method = methods[length];

    // Only stub undefined methods.
    if (!console[method]) {
      console[method] = noop;
    }
  }
}());

// Place any jQuery/helper plugins in here.  --> mejor tener por separados los plugin

//1. se elcciona y se agrega el metodo que dispara todas las funciones del plugien tiene n por lo general el mismo nombre ver la documentacoion 
