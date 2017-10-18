<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\Application;

$app->before(function (Request $request) {
    if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
        $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : array());
    }
});


$app->get('/preguntas', function(){
    $i=1;
    //$tareas = R::findAll('preguntas');
    $respuestas=R::getAll('SELECT respuestas.id,respuestas.opc_respuesta,respuestas.opc_verdadera,respuestas.preguntas_id,preguntas.pre_pregunta FROM respuestas INNER JOIN preguntas on preguntas.id=respuestas.preguntas_id ORDER BY preguntas_id ASC' );
    
    $pregunta = array();
    $respuesta = array();
    //print_r($respuestas);
    foreach ($respuestas as $r) {

        $res=array(
            'opc_id'=>$r['id'],
            'opc_respuesta'=>$r['opc_respuesta'],
            'opc_verdadera'=>$r['opc_verdadera']);
        $respuesta[]= $res;

        if ($i==3) {
            $pre=array(
                'preguntas_id'=>$r['preguntas_id'],
                'pre_pregunta'=>$r['pre_pregunta'],
                'opcionesList'=>$respuesta);
            $pregunta[] = $pre;
            $i=0;
            $respuesta = array();
        }
        $i++;
        
    }
    
    //print_r(Response(json_encode($pregunta), 200)) ;
    $myJSON = json_encode($pregunta);

    echo $myJSON;
    //print_r($pregunta);
});

$app->post('/preguntas', function(Request $request){
    
    $pregunta = R::dispense('preguntas');
    $pregunta -> pre_pregunta = $request->get('pre_pregunta');
    $opcionesList = $request->get('opcionesList');
    foreach ($opcionesList as $o) {
        $opcion = R::dispense( 'respuestas' );
        $opcion -> opc_respuesta =$o['opc_respuesta'];
        $opcion -> opc_verdadera = $o['opc_verdadera'];
        $pregunta->ownOpcionList[] = $opcion;
    }
    R::store($pregunta);
    return new Response(json_encode($pregunta),201);
});

return $app;