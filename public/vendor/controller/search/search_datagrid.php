<?php
/**
 * Created by MyCode
 * user: KEVEN
 * Date: 01/06/2020
 * Time: 13:20
 *
 */

/** Importo as classes que irei utilizar **/
use \vendor\model\Main;
use \vendor\model\User;
use \vendor\model\Content;
use \vendor\model\ContentSub;
use \vendor\model\ArrayUtf8Encode;

/** Instânciamento das classes importadas **/
$main = new Main();
$user = new User();
$content = new Content();
$contentSub = new ContentSub();
$arrayUtf8Encode = new ArrayUtf8Encode();

try {

    /** Capturo meus campos envios por json **/
    $inputs = json_decode(file_get_contents('php://input'), true);

    /** Parâmetros de entrada  **/
    $search = isset($inputs['inputs']['search']) ? (string)$main->antiInjection($inputs['inputs']['search']) : '';

    /** Controle de erros **/
    $message = array();

    /** Verifico se o campo é válido **/
    if (empty($search)) {
        array_push($message, "O campo 'Busca', deve ser preenchido");
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
            "result_user" => $arrayUtf8Encode->utf8Converter($user->search($search)) ,
            "result_content" => $arrayUtf8Encode->utf8Converter($content->search($search)) ,
            "result_content_sub" => $arrayUtf8Encode->utf8Converter($contentSub->search($search))

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

    );

    /** Envio **/
    echo json_encode($result);

    /** Paro o procedimento **/
    exit;
}
