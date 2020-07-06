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
use \vendor\model\Content;

/** Instânciamento das classes importadas **/
$main = new Main();
$content = new Content();

try {

    /** Capturo meus campos envios por json **/
    $inputs = json_decode(file_get_contents('php://input'), true);

    /** Parâmetros de entrada **/
    $content_id = isset($inputs['inputs']['content_id']) ? (int)$main->antiInjection($inputs['inputs']['content_id']) : 0;

    /** Controle de erros **/
    $message = array();

    /** Validação de campos obrigatórios **/
    /** Verifico se o campo class_id foi preenchido **/
    if ($content_id <= 0) {
        array_push($message, '$content_id - O seguinte campo deve ser preenchido/selecionado');
    }

    /** Verifico se existem erros **/
    if (count($message) > 0) {

        /** Preparo o formulario para retorno **/
        $result = array(

            "cod" => 0,
            "message" => $message

        );

        /**Envio*/
        echo json_encode($result);

        /**Para o procedimento*/
        exit;
    } else {

        /** Busco o registro solicitado **/
        $row = $content->get($content_id);

        /** Verifico se existe o registro **/
        if (isset($row)) {

            /** Verfico se o registro é válido **/
            if ($row->content_id > 0) {

                /** Executo o método de exclusão **/
                if ($content->delete($row->content_id)) {
                    array_push($message, "Registro Excluído com Sucesso!");

                    /** Result **/
                    $result = array(

                        "cod" => 1,
                        "message" => $message

                    );
                } else {
                    array_push($message, "Erro ao executar método");

                    /** Result **/
                    $result = array(

                        "cod" => 0,
                        "message" => $message

                    );
                }
            } else {
                array_push($message, "Registro inválido");

                /** Result **/
                $result = array(

                    "cod" => 0,
                    "message" => $message

                );
            }
        } else {
            array_push($message, "Não foi possível localizar o registro");

            /** Result **/
            $result = array(

                "cod" => 0,
                "message" => $message

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
        "message" => $e->getMessage(),

    );

    /** Envio **/
    echo json_encode($result);

    /** Paro o procedimento **/
    exit;
}
