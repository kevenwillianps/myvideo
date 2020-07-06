<?php
/**
 * Created by MyCode
 * user: KEVEN
 * Date: 04/06/2020
 * Time: 10:49
 *
 */

/** Importação das classes que iremos utilizar **/
use \vendor\model\Main;
use \vendor\model\ContentSub;
use \vendor\model\ArrayUtf8Encode;

/** Instânciamento das classes **/
$main = new Main();
$contentSub = new ContentSub();
$arrayUtf8Encode = new ArrayUtf8Encode();

try {

    /** Capturo meus campos envios por json **/
    $inputs = json_decode(file_get_contents('php://input'), true);

    /** Parâmetros de entrada  **/
    $content_sub_id = isset($inputs['inputs']['content_sub_id']) ? (int)$main->antiInjection($inputs['inputs']['content_sub_id']) : 0;

    /** Controle de erros **/
    $message = array();

    /** Verifico se o campo é válido **/
    if ($content_sub_id <= 0) {
        array_push($message, 'O campo "ContentSubID", deve ser preenchido');
    }

    /** Verifico se existem erros **/
    if (count($message) > 0) {

        /** Result **/
        $result = array(
            "cod" => 0,
            "result" => $message
        );
    } else {

        /** Result **/
        $result = array(
            "cod" => 1,
            "result" => $arrayUtf8Encode->utf8Converter($contentSub->getContent($content_sub_id))
        );
    }

    /** Envio **/
    echo json_encode($result);

    /** Paro o procedimento **/
    exit;
} catch (Exception $e) {

    /** Preparo o formulario para retorno **/
    $result = array(
        "cod" => 0,
        "message" => $e->getMessage() ,
        "title" => "Atenção"
    );

    /** Envio **/
    echo json_encode($result);

    /** Paro o procedimento **/
    exit;
}
