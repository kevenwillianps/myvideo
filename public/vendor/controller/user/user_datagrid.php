<?php
/**
 * Created by MyCode
 * user: KEVEN
 * Date: 01/06/2020
 * Time: 13:20
 *
 */

/** Importo as classes que irei utilizar **/
use \vendor\model\User;
use \vendor\model\ArrayUtf8Encode;

/** Instânciamento das classes **/
$user = new User();
$arrayUtf8Encode = new ArrayUtf8Encode();

try {

    /** Result **/
    $result = array(

        "result" => $arrayUtf8Encode->utf8Converter($user->all())

    );

    /** Envio **/
    echo json_encode($result);

    /** Paro o procedimento **/
    exit;
} catch (Exception $e) {

    /** Preparo o formulario para retorno **/
    $result = array(

        "cod" => 0,
        "message" => $e->getMessage() ,

    );

    /** Envio **/
    echo json_encode($result);

    /** Paro o procedimento **/
    exit;
}
