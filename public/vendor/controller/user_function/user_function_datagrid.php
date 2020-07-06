<?php
/**
 * Created by MyCode
 * user: KEVEN
 * Date: 01/06/2020
 * Time: 13:20
 **/

/** Importo as classes que irei utilizar **/
use \vendor\model\UserFunction;
use \vendor\model\ArrayUtf8Encode;

/** Instânciamento das classes **/
$userFunction = new UserFunction();
$arrayUtf8Encode = new ArrayUtf8Encode();

try {

    /** Result **/
    $result = array(

        "cod" => 1,
        "result" => $arrayUtf8Encode->utf8Converter($userFunction->all())

    );

    /** Envio **/
    echo json_encode($result);

    /** Paro o procedimento **/
    exit;
} catch (Exception $e) {

   /** Preparo o formulario para retorno **/
    $result = array(

       "cod" => 0,
       "msg" => $e->getMessage()

   );

    /** Envio **/
    echo json_encode($result);

    /** Paro o procedimento **/
    exit;
}
