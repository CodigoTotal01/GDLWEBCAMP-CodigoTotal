<?php
//Cuando manejamos informacion que se contiene en una array (Selectoes como ejemplo), asi que emplearemos el paso por referencias donde nuestros satos se mantengan donde tomara los valores originales, amperson significa paso por referencia 
function productos_json(&$boletos, &$camisas = 0, &$etiquetas = 0)
{


    //FUNCION PARA UNIR ARRAY, los boletos son la cantidad de cuantos se halla n comprado 
    $dias = array(
        0 => "un_dia",
        1 => "pase_completo",
        2 => "pase_2dias"
    );

    //un set elemina la cantidad de elmentos deun arreglo 
    unset($boletos["un_dia"]["precio"]);
    unset($boletos["completo"]["precio"]);
    unset($boletos["2dias"]["precio"]);
    $total_boletos = array_combine($dias, $boletos); //arreglo asociativo con llave dias y valor de boletos


    //añadir a neustr oarreglo asossiativo json ala cnatidad de cmisas y etqiuetas 
    $camisas = (int) $camisas;
    if($camisas>0){
        $total_boletos["camisas"] = $camisas;
    }

    $etiquetas = (int) $etiquetas;
    if($etiquetas>0){
        $total_boletos["etiquetas"] = $etiquetas;
    }

    //Luego retornamos un json (que convierte un array a json xd)
//var_dump($json); //array(3) { ["un_dia"]=> int(1) ["pase_completo"]=> int(2) ["pase_2dias"]=> int(3) }
//json objetos parecidos a los de java escrip que cuenta con uan llave y cvalor 
    return json_encode($total_boletos);

}

function eventos_json(&$eventos){
    //cuando solo se nos entrega en un solo valor de los tantos agregar un nuevo corchetete 
$eventos_json=array();
    foreach($eventos as $evento){
        //arerglo asociatibo multidimencional
        $eventos_json["eventos"] []= $evento;
    }
    return json_encode($eventos_json);
}
//Ahroa usamremos los prepatre statement previenen ataques de inyeccion sql  
