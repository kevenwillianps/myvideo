<?php
/**
 * Created by MyCode
 * user: KEVEN
 * Date: 01/06/2020
 * Time: 13:20
 **/

/** Importação das classes que iremos utilizar **/
use \vendor\model\Main;
use \vendor\model\ContentSub;

/** Instânciamento das classes **/
$main = new Main();
$contentSub = new ContentSub();

try {

   /** Capturo meus campos envios por json **/
    $inputs = json_decode(file_get_contents('php://input'), true);

    /** Parâmetros de entrada **/
    $content_sub_id           = isset($inputs['inputs']['content_sub_id'])           ? (int)$main->antiInjection($inputs['inputs']['content_sub_id'])                 : 0;
    $content_id               = isset($inputs['inputs']['content_id'])               ? (int)$main->antiInjection($inputs['inputs']['content_id'])                     : 0;
    $content_sub_auxiliary_id = isset($inputs['inputs']['content_sub_auxiliary_id']) ? (string)$main->antiInjection($inputs['inputs']['content_sub_auxiliary_id'])    : '';
    $user_id                  = isset($inputs['inputs']['user_id'])                  ? (int)$main->antiInjection($inputs['inputs']['user_id'])                        : $_SESSION['MYSUPPORT-USER-ID'];
    $situation_id             = isset($inputs['inputs']['situation_id'])             ? (int)$main->antiInjection($inputs['inputs']['situation_id'])                   : 1;
    $menu_position            = isset($inputs['inputs']['menu_position'])            ? (int)$main->antiInjection($inputs['inputs']['menu_position'])                  : 1;
    $highlighter_id           = isset($inputs['inputs']['highlighter_id'])           ? (int)$main->antiInjection($inputs['inputs']['highlighter_id'])                 : 1;
    $url                      = isset($inputs['inputs']['url'])                      ? (string)$main->antiInjection($inputs['inputs']['url'])                         : 'NÃO INFORMADO';
    $title                    = isset($inputs['inputs']['title'])                    ? (string)$main->antiInjection($inputs['inputs']['title'])                       : 'NÃO INFORMADO';
    $title_menu               = isset($inputs['inputs']['title_menu'])               ? (string)$main->antiInjection($inputs['inputs']['title_menu'])                  : 'NÃO INFORMADO';
    $description              = isset($inputs['inputs']['description'])              ? (string)$main->antiInjection($inputs['inputs']['description'])                 : 'NÃO INFORMADO';
    $content_resume           = isset($inputs['inputs']['content_resume'])           ? (string)$main->antiInjection($inputs['inputs']['content_resume'])              : 'NÃO INFORMADO';
    $content_complete         = isset($inputs['inputs']['content_complete'])         ? (string)$main->antiInjection($inputs['inputs']['content_complete'], 'S') : '';
    $date_register            = isset($inputs['inputs']['date_register'])            ? (string)$main->antiInjection($inputs['inputs']['date_register'])               : date("y-m-d h:m:s");
    $date_update              = isset($inputs['inputs']['date_update'])              ? (string)$main->antiInjection($inputs['inputs']['date_update'])                 : date("y-m-d h:m:s");

    /** Controle de erros **/
    $message = array();

    /** Validação de campos obrigatórios **/
    /** Verifico se o campo content_sub_id foi preenchido **/
    if ($content_sub_id < 0) {
        array_push($message, 'O campo "$content_sub_id", deve ser preenchido');
    }
    /** Verifico se o campo content_sub_id foi preenchido **/
    if ($content_id <= 0) {
        array_push($message, 'O campo "$content_id", deve ser preenchido');
    }
    /** Verifico se o campo user_id foi preenchido **/
    if ($user_id <= 0) {
        array_push($message, 'O campo "$user_id", deve ser preenchido');
    }
    /** Verifico se o campo situation_id foi preenchido **/
    if ($situation_id <= 0) {
        array_push($message, 'O campo "$situation_id", deve ser preenchido');
    }
    /** Verifico se o campo menu_position foi preenchido **/
    if ($menu_position <= 0) {
        array_push($message, 'O campo "$menu_position", deve ser preenchido');
    }
    /** Verifico se o campo highlighter_id foi preenchido **/
    if ($highlighter_id <= 0) {
        array_push($message, 'O campo "$highlighter_id", deve ser preenchido');
    }
    /** Verifico se o campo date_register foi preenchido **/
    if (empty($date_register)) {
        array_push($message, 'O campo "$date_register", deve ser preenchido');
    }
    /** Verifico se o campo date_update foi preenchido **/
    if (empty($date_update)) {
        array_push($message, 'O campo "$date_update", deve ser preenchido');
    }

    /** Verifico se existem erros **/
    if (count($message) > 0) {

       /** Preparo o formulario para retorno **/
        $result = array(

           "cod" => 0,
           "message" => $message

       );
    } else {
        try {

           /** Executo o método **/
            if ($contentSub->save($content_sub_id, $content_id, $content_sub_auxiliary_id, $user_id, $situation_id, $highlighter_id, $menu_position, $url, $title, $title_menu, $description, $content_resume, $content_complete, $date_register, $date_update)) {
                $result = array(

                   "cod" => 1,
                   "content_sub_id" => ($content_sub_id > 0 ? $content_sub_id : $contentSub->getLast()->content_sub_id),
                   "message" => "Informações atualizadas com sucesso!"

               );
            }
        } catch (Exception $exception) {

           /** Result **/
            $result = array(

               "cod" => 0,
               "message" => $exception->getMessage(),

           );
        }
    }

    /** Envio **/
    echo json_encode($result);

    /**Para o procedimento*/
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
