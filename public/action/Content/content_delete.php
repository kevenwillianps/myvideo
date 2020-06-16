<?php
try{

    /**
     * Created by MyCode
     * User: KEVEN
     * Date: 01/06/2020
     * Time: 13:20
     **/

    /** Instânciamento da classe Classes  **/
    $Content    = $Main->LoadClass('Content');

    /** Capturo meus campos envios por json **/
    $inputs     = json_decode(file_get_contents('php://input'), true);

    /** Parâmetros de entrada **/
    $content_id = isset($inputs['inputs']['content_id']) ? (int)$Main->anti_injection($inputs['inputs']['content_id']) : 0;

    /** Controle de erros **/
    $error    = 0;
    $message  = array();

    /** Validação de campos obrigatórios **/
    /** Verifico se o campo class_id foi preenchido **/
    if($content_id <= 0){

        $error++;
        $message[0] = $error. '- UserID - O seguinte campo deve ser preenchido/selecionado';

    }

    if($error > 0){

        /** Preparo o formulario para retorno **/
        $result = array("cod" => 0, "message" => $message);

        /**pause*/
        sleep(1);

        /**Envio*/
        echo json_encode($result);

        /**Para o procedimento*/
        exit;

    }else{

        /** Busco o registro solicitado **/
        $row = $Content->Get($content_id);

        /** Verifico se existe o registro **/
        if(isset($row)){

            /** Verfico se o registro é válido **/
            if($row->content_id > 0){

                /** Executo o método de exclusão **/
                if($Content->Delete($row->content_id)){

                    /** Result **/
                    $result = array("cod" => 1, "message" => $message[0] = array("Registro Excluído com Sucesso!"));

                    /** Pause **/
                    sleep(1);

                    /** Envio **/
                    echo json_encode($result);

                    /** Paro o procedimento **/
                    exit;

                }
                else
                {

                    /** Result **/
                    $result = array("cod" => 0, "message" => $message[0] = array("Erro ao executar método"));

                    /** Pause **/
                    sleep(1);

                    /** Envio **/
                    echo json_encode($result);

                    /** Paro o procedimento **/
                    exit;

                }

            }
            else
            {

                /** Result **/
                $result = array("cod" => 0, "message" => $message[0] = array("Registro inválido"));

                /** Pause **/
                sleep(1);

                /** Envio **/
                echo json_encode($result);

                /** Paro o procedimento **/
                exit;

            }

        }
        else
        {

            /** Result **/
            $result = array("cod" => 0, "message" => $message[0] = array("Não foi possível localizar o registro"));

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
    $result = array("cod"   => 0,
        "msg"   => $e->getMessage(),
        "title" => "Atenção");

    /** Pause **/
    sleep(1);

    /** Envio **/
    echo json_encode($result);

    /** Paro o procedimento **/
    exit;

}
