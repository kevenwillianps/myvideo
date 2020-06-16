<?php
try{

    /**
     * Created by MyCode
     * User: KEVEN
     * Date: 01/06/2020
     * Time: 17:29
     **/

    /** Capturo meus campos envios por json **/
    $inputs = json_decode(file_get_contents('php://input'), true);

    /** Instânciamento da classe Projects  **/
    $User            = $Main->LoadClass('User');
    $ArrayUtf8Encode = $Main->LoadClass('ArrayUtf8Encode');

    /** Parâmetros de entrada  **/
    $email    = isset($inputs['inputs']['email'])    ? (string)$Main->anti_injection($inputs['inputs']['email'])    : '';
    $password = isset($inputs['inputs']['password']) ? (string)$Main->anti_injection($inputs['inputs']['password']) : '';

    /** Controle de Erros **/
    $error   = 0;
    $message = array();

    /** Verifico se o campo name foi preenchido **/
    if(empty($email)){

        $error++;
        $message[0] = $error. ' - Email - O seguinte campo deve ser preenchido';

    }
    /** Verifico se o campo email foi preenchido **/
    if(empty($password)){

        $error++;
        $message[1] = $error. ' - Senha - O seguinte campo deve ser preenchido';

    }

    if($error > 0){

        /** Preparo o formulario para retorno **/
        $result = array("cod" => 405, "message" => $message);

        /**pause*/
        sleep(1);

        /**Envio*/
        echo json_encode($result);

        /**Para o procedimento*/
        exit;

    }else{

        /** Carrego o meu registro  **/
        $row = $User->Access($email, md5($password));

        /** Verfico se Foi Localizado o usuário **/
        if (isset($row)){

            /** Converto Minha Array **/
            $row  = $ArrayUtf8Encode->utf8_converter($row);

            /** Defino os Valores da Sessão **/
            $_SESSION['MYSUPPORT-USER-ID']          = $row->user_id;
            $_SESSION['MYSUPPORT-USER-NAME']        = $row->user_name;
            $_SESSION['MYSUPPORT-EMAIL']            = $row->email;
            $_SESSION['MYSUPPORT-ACCESS-FIRST']     = $row->access_first;
            $_SESSION['MYSUPPORT-ACCESS-LAST']      = $row->access_last;
            $_SESSION['MYSUPPORT-DATE-REGISTER']    = $row->date_register;
            $_SESSION['MYSUPPORT-DATE-UPDATE']      = $row->date_update;
            $_SESSION['MYSUPPORT-USER-FUNCTION-ID'] = $row->user_function_id;
            $_SESSION['MYSUPPORT-FUNCTION-NAME']    = $row->function_name;
            $_SESSION['MYSUPPORT-C-EXECUTE']        = $row->c_execute;
            $_SESSION['MYSUPPORT-R-EXECUTE']        = $row->r_execute;
            $_SESSION['MYSUPPORT-U-EXECUTE']        = $row->u_execute;
            $_SESSION['MYSUPPORT-D-EXECUTE']        = $row->d_execute;

            /** Result **/
            $result = array("cod" => 1);

            /** Pause **/
            sleep(1);

            /** Envio **/
            echo json_encode($result);

            /** Paro o procedimento **/
            exit;

        }else{

            $message[0] = 'Não foi possivel localizar o usuário. Verifique email e senha';

            /** Result **/
            $result = array("cod" => 404, 'message' => $message);

            /** Pause **/
            sleep(1);

            /** Envio **/
            echo json_encode($result);

            /** Paro o procedimento **/
            exit;

        }

    }

}catch(Exception $e){

    /** Preparo o formulario para retorno **/
    $result = array("cod" => 0, "message" => $e->getMessage(), "title" => "Atenção");

    /** Pause **/
    sleep(1);

    /** Envio **/
    echo json_encode($result);

    /** Paro o procedimento **/
    exit;

}
