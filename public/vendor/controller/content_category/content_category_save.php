<?php
/**
 * Created by MyCode
 * user: KEVEN
 * Date: 01/06/2020
 * Time: 13:20
 *
 */

/** Realizo a importação de classes **/
use \vendor\model\Main;
use \vendor\model\ContentCategory;

/** Instânciamento das classes importadas **/
$main = new Main();
$contentCategory = new ContentCategory();

try {

    /** Capturo meus campos envios por json **/
    $inputs = json_decode(file_get_contents('php://input'), true);

    /** Parâmetros de entrada **/
    $content_category_id  = isset($inputs['inputs']['content_category_id']) ? (int)$main->antiInjection($inputs['inputs']['content_category_id']) : 0;
    $user_id              = isset($inputs['inputs']['user_id'])             ? (int)$main->antiInjection($inputs['inputs']['user_id'])             : $_SESSION['MYSUPPORT-USER-ID'];
    $situation_id         = isset($inputs['inputs']['situation_id'])        ? (int)$main->antiInjection($inputs['inputs']['situation_id'])        : 1;
    $name                 = isset($inputs['inputs']['name'])                ? (string)$main->antiInjection($inputs['inputs']['name'])             : '';
    $description          = isset($inputs['inputs']['description'])         ? (string)$main->antiInjection($inputs['inputs']['description'])      : '';
    $date_register        = isset($inputs['inputs']['date_register'])       ? (string)$main->antiInjection($inputs['inputs']['date_register'])    : date("y-m-d h:m:s");
    $date_update          = isset($inputs['inputs']['date_update'])         ? (string)$main->antiInjection($inputs['inputs']['date_update'])      : date("y-m-d h:m:s");

    /** Controle de Erros **/
    $message = array();

    /** Validação de campos obrigatórios **/
    /** Verifico se o campo situation_id foi preenchido **/
    if ($content_category_id < 0) {
        array_push($message, '$situation_id - O seguinte campo deve ser preenchido/selecionado');
    }
    /** Verifico se o campo situation_id foi preenchido **/
    if ($user_id < 0) {
        array_push($message, '$situation_id - O seguinte campo deve ser preenchido/selecionado');
    }
    /** Verifico se o campo situation_id foi preenchido **/
    if ($situation_id < 0) {
        array_push($message, '$situation_id - O seguinte campo deve ser preenchido/selecionado');
    }
    /** Verifico se o campo name foi preenchido **/
    if (empty($name)) {
        array_push($message, '$name - O seguinte campo deve ser preenchido/selecionado');
    }
    /** Verifico se o campo description foi preenchido **/
    if (empty($description)) {
        array_push($message, '$description - O seguinte campo deve ser preenchido/selecionado');
    }
    /** Verifico se o campo date_register foi preenchido **/
    if (empty($date_register)) {
        array_push($message, '$date_register - O seguinte campo deve ser preenchido/selecionado');
    }
    /** Verifico se o campo date_update foi preenchido **/
    if (empty($date_update)) {
        array_push($message, '$date_update - O seguinte campo deve ser preenchido/selecionado');
    }

    /** Verifico a existência de erros **/
    if (count($message) > 0) {

        /** Preparo o formulario para retorno **/
        $result = array(
            "cod" => 0,
            "message" => $message
        );
    } else {
        $contentCategory->save($content_category_id, $user_id, $situation_id, $name, $description, $date_register, $date_update);

        /** Result **/
        $result = array(
            "cod" => 1,
            "message" => "Informações atualizadas com sucesso!"
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
        "message" => $e->getMessage()
    );

    /** Envio **/
    echo json_encode($result);

    /** Paro o procedimento **/
    exit;
}
