<?php
/**
 * Created by MyCode
 * user: KEVEN
 * Date: 01/06/2020
 * Time: 17:29
 *
 */

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

    /** Parâmetros de entrada  **/
    $email = isset($inputs['inputs']['email']) ? (string)$main->antiInjection($inputs['inputs']['email']) : '';
    $password = isset($inputs['inputs']['password']) ? (string)$main->antiInjection($inputs['inputs']['password']) : '';

    /** Controle de Erros **/
    $message = array();

    /** Verifico se o campo name foi preenchido **/
    if (empty($email)) {
        array_push($message, ' - Email - O seguinte campo deve ser preenchido');
    }
    /** Verifico se o campo email foi preenchido **/
    if (empty($password)) {
        array_push($message, ' - Senha - O seguinte campo deve ser preenchido');
    }

    /** Verifico se existem erros **/
    if (count($message) > 0) {

        /** Preparo o formulario para retorno **/
        $result = array(
            "cod" => 405,
            "message" => $message
        );
    } else {

        /** Carrego o meu registro  **/
        $row = $user->access($email, md5($password));

        /** Verfico se Foi Localizado o usuário **/
        if (isset($row)) {

            /** Converto Minha Array **/
            $row = $arrayUtf8Encode->utf8Converter($row);

            /** Defino os Valores da Sessão **/
            $_SESSION['MYSUPPORT-USER-ID'] = $row->user_id;
            $_SESSION['MYSUPPORT-USER-NAME'] = $row->user_name;
            $_SESSION['MYSUPPORT-EMAIL'] = $row->email;
            $_SESSION['MYSUPPORT-ACCESS-FIRST'] = $row->access_first;
            $_SESSION['MYSUPPORT-ACCESS-LAST'] = $row->access_last;
            $_SESSION['MYSUPPORT-DATE-REGISTER'] = $row->date_register;
            $_SESSION['MYSUPPORT-DATE-UPDATE'] = $row->date_update;
            $_SESSION['MYSUPPORT-USER-FUNCTION-ID'] = $row->user_function_id;
            $_SESSION['MYSUPPORT-FUNCTION-NAME'] = $row->function_name;
            $_SESSION['MYSUPPORT-C-EXECUTE'] = $row->c_execute;
            $_SESSION['MYSUPPORT-R-EXECUTE'] = $row->r_execute;
            $_SESSION['MYSUPPORT-U-EXECUTE'] = $row->u_execute;
            $_SESSION['MYSUPPORT-D-EXECUTE'] = $row->d_execute;

            /** Result **/
            $result = array(
                "cod" => 1
            );
        } else {
            array_push($message, 'Não foi possivel localizar o usuário. Verifique email e senha');

            /** Result **/
            $result = array(
                "cod" => 404,
                'message' => $message
            );
        }
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
