<?php
/**
 * Created by MyCode
 * user: KEVEN
 * Date: 01/06/2020
 * Time: 13:20
 *
 */

/** Importo as classes que irei utilizar **/
use \vendor\model\ContentCategory;
use \vendor\model\ArrayUtf8Encode;

/** Instânciamento das classes **/
$contentCategory = new ContentCategory();
$arrayUtf8Encode = new ArrayUtf8Encode();

try {

    /** Result **/
    $result = array(
        "result" => $arrayUtf8Encode->utf8Converter($contentCategory->all())
    );

    /** Envio **/
    echo json_encode($result);

    /** Paro o procedimento **/
    exit;
} catch (Exception $e) {

    /** Preparo o formulario para retorno **/
    $result = array(
        "cod" => 0,
        "message" => $e->getMessage()
    );

    /** Envio **/
    echo json_encode($result);

    /** Paro o procedimento **/
    exit;
}
