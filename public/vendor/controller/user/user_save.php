<?php
/**
 * Created by MyCode
 * user: KEVEN
 * Date: 01/06/2020
 * Time: 13:20
 **/

/** Importo as classes que irei utilizar **/
use \vendor\model\Main;
use \vendor\model\User;
use \vendor\model\ArrayUtf8Encode;

/** Instânciamento das classes importadas **/
$main = new Main();
$user = new User();
$arrayUtf8Encode = new ArrayUtf8Encode();

try {

   /** Capturo meus campos envios por json **/
    $inputs = json_decode(file_get_contents('php://input'), true);

    /** Parâmetros de entrada **/
    $user_id          = isset($inputs['inputs']['user_id'])          ? (int)$main->antiInjection($inputs['inputs']['user_id'])          : 0;
    $user_function_id = isset($inputs['inputs']['user_function_id']) ? (int)$main->antiInjection($inputs['inputs']['user_function_id']) : 1;
    $situation_id     = isset($inputs['inputs']['situation_id'])     ? (int)$main->antiInjection($inputs['inputs']['situation_id'])     : 1;
    $name             = isset($inputs['inputs']['name'])             ? (string)$main->antiInjection($inputs['inputs']['name'])          : '';
    $email            = isset($inputs['inputs']['email'])            ? (string)$main->antiInjection($inputs['inputs']['email'])         : '';
    $date_birth       = isset($inputs['inputs']['date_birth'])       ? (string)$main->antiInjection($inputs['inputs']['date_birth'])    : $user->get($user_id)->date_birth;
    $access_first     = isset($inputs['inputs']['access_first'])     ? (string)$main->antiInjection($inputs['inputs']['access_first'])  : date("y-m-d h:m:s");
    $access_last      = isset($inputs['inputs']['access_last'])      ? (string)$main->antiInjection($inputs['inputs']['access_last'])   : date("y-m-d h:m:s");
    $access_log       = isset($inputs['inputs']['access_log'])       ? (string)$main->antiInjection($inputs['inputs']['access_log'])    : '';
    $password         = isset($inputs['inputs']['password'])         ? (string)$main->antiInjection(md5($inputs['inputs']['password'])) : $user->get($user_id)->password;
    $date_register    = isset($inputs['inputs']['date_register'])    ? (string)$main->antiInjection($inputs['inputs']['date_register']) : date("y-m-d h:m:s");
    $date_update      = isset($inputs['inputs']['date_update'])      ? (string)$main->antiInjection($inputs['inputs']['date_update'])   : date("y-m-d h:m:s");

    /** Controle de Erros **/
    $message = array();

    /** Validação de campos obrigatórios **/
    /** Verifico se o campo user_id foi preenchido **/
    if ($user_id < 0) {
        array_push($message, "O campo '', deve ser preenchido");
    }
    /** Verifico se o campo user_function_id foi preenchido **/
    if ($user_function_id < 0) {
        array_push($message, "O campo '', deve ser preenchido");
    }
    /** Verifico se o campo situation_id foi preenchido **/
    if ($situation_id < 0) {
        array_push($message, "O campo '', deve ser preenchido");
    }
    /** Verifico se o campo name foi preenchido **/
    if (empty($name)) {
        array_push($message, "O campo '', deve ser preenchido");
    }
    /** Verifico se o campo email foi preenchido **/
    if (empty($email)) {
        array_push($message, "O campo '', deve ser preenchido");
    }
    /** Verifico se o campo date_birth foi preenchido **/
    if (empty($date_birth)) {
        array_push($message, "O campo '', deve ser preenchido");
    }
    /** Verifico se o campo date_register foi preenchido **/
    if (empty($date_register)) {
        array_push($message, "O campo '', deve ser preenchido");
    }
    /** Verifico se o campo date_update foi preenchido **/
    if (empty($date_update)) {
        array_push($message, "O campo '', deve ser preenchido");
    }

    if (count($message) > 0) {

       /** Preparo o formulario para retorno **/
        $result = array(

           "cod" => 0,
           "message" => $message

       );
    } else {
        $user->save($user_id, $user_function_id, $situation_id, $name, $email, $date_birth, $access_first, $access_last, $access_log, $password, $date_register, $date_update);

        /** Result **/
        $result = array(

           "cod" => 1,
           "user_id" => ($user_id > 0 ? $user_id : $user->getLast()->user_id),
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
